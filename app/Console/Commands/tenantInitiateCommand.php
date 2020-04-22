<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Ixudra\Curl\Facades\Curl;

use App\Mail\sendCustomerTrialApproval;
use App\Tenant;
use App\User;

class tenantInitiateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:init {dbname} {--seed} {--sample} {--force} {--nodns}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to initialize the tables on a new tenant';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->seedPath = config('tenancy.seedPath');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dbname = $this->argument('dbname');
        $seed = $this->option('seed');
        $force = $this->option('force');
        $sample = $this->option('sample');
        $nodns = $this->option('nodns');

        config(['database.default'=>'mysql']);

        $tenant = tenant::where('subdomain',$dbname)->first();

        if($tenant != null){
            config(['database.connections.tenant_db.database'=>$dbname]);
            $this->info('Initializing tenant tables for tenant subdomain: '.$dbname);
            activity('TenantInit')->log('Initiatizing tenant tables for subdomain:'.$dbname);

            config(['database.default'=>'tenant_db']);
            
            if($seed){
                $init = Artisan::call('db:seed',[
                    '--class'=>'PermissionsTableSeeder',
                    '--database'=>'tenant_db',
                    '--force'=>$force,
                ]);
                $this->line(Artisan::output().' Roles');
    
                $init = Artisan::call('db:seed',[
                    '--class'=>'RolesTableSeeder',
                    '--database'=>'tenant_db',
                    '--force'=>$force,
                ]);
                $this->line(Artisan::output().' Permissions');
                Activity('TenantInit')->log('Tenant seeding for Roles and Permission is complete');
    
            }


            if($sample){
                $sam = Artisan::call('db:seed',[
                    '--class'=>'LaratrustSeeder',
                    '--database'=>'tenant_db',
                    '--force'=>$force,
                ]);
                $this->line(Artisan::output());
                activity('TenantInit')->log('Tenant seeding using Laratrust is complete');

            }else{
                //create the primary admin for the tenant
                $sa = new User();
                //$sa->setConnection('tenant_db');
                $sa->name='SuperAdmin';
                $sa->email = 'superadmin@adm.utsapp.test';
                $sa->password=bcrypt('blueriver00');
                $sa->save();

                $sa->assignRole('administrator');
                $this->line('created Super Admin with administrator role');
                activity('TenantInit')->log('Created Super Admin with full administrator role');

                $la = User::create([
                    'name'=>'Local Admin',
                    'email'=>'localadmin@adm.utsapp.test',
                    'password'=>bcrypt('redriver00'),
                ]);

                $la->assignRole('supervisor');
                $this->line('created Local Admin with supervisor role');
                activity('TenantInit')->log('Created Local Admin and supervisor Roles');

            }

            //copy the tenant info to the new tenant as default
            $newtenant = new tenant();
            $newtenant->name = $tenant->name;
            $newtenant->email = $tenant->email;
            $newtenant->subdomain = $tenant->subdomain;
            $newtenant->alias_domain = $tenant->alias_domain;
            $newtenant->admin_id  = $tenant->admin_id;
            $newtenant->company_id = $tenant->company_id;
            $newtenant->connection = $tenant->connection;
            $newtenant->save();
            activity('TenantInit')->log('Created Initial Tenant entry for '.$dbname);


            //copy the tenant info to the utsapp to link the tenancy
            $newtenant = new tenant();
            $newtenant->name = $tenant->name;
            $newtenant->email = $tenant->email;
            $newtenant->subdomain = $tenant->subdomain;
            $newtenant->alias_domain = $tenant->alias_domain;
            $newtenant->admin_id  = $tenant->admin_id;
            $newtenant->company_id = $tenant->company_id;
            $newtenant->connection = $tenant->connection;
            $newtenant->exists = false;
            $newtenant->setConnection('tenancy')->save();
            $newtenant->setConnection('mysql');

            activity('TenantInit')->log('Created New Tenant entry in UTSAPP for '.$dbname);

            Config('database.default','mysql');
            
            $this->info('Completed Tenant Initialization');

            //create the dns entry for the domain under utsapp.test
            if( env('TN_BASE_DB') == 'prod' ){

                $data = [
                    'type'=>'A',
                    'name'=>$tenant->subdomain,
                    'content'=>env('TN_BASE_IP'),
                //    'proxied'=>true,
                ];

                $response = Curl::to(env('TN_CLOUDFLARE_EP_NEW_DOMAIN'))
                    ->withHeader('X-Auth-Email: ')
                    ->withHeader('X-Auth-Key: ')
                    ->withData($data)
                    ->asJson()
                    ->post();

                activity('TenantDNS')->log('Created the tenant dns using '.$tenant->alias_domain);

            }elseif( env('TN_BASE_DB') == 'stage'){

                $data = [
                    'type'=>'A',
                    'name'=>$tenant->subdomain,
                    'content'=>env('TN_BASE_STAGE_IP'),
                //    'proxied'=>true,
                ];

                $response = Curl::to(env('TN_CLOUDFLARE_EP_STAGE_NEW_DOMAIN'))
                    ->withHeader('X-Auth-Email: ')
                    ->withHeader('X-Auth-Key: ')
                    ->withData($data)
                    ->asJson()
                    ->post();

                activity('TenantDNS')->log('Created the tenant STAGE dns using '.$tenant->alias_domain);
                activity('DNSResponse')->log(json_encode($response));
            }else{

                $this->error('Alias Domain does not contain utsapp.test or TN_BASE_DB property was not set in ENV.  Please create manually');
                activity('TenantDNS')->log('Alias Domain does not contain utsapp.test or TN_BASE_DB is not set.  Please create manually');
            };

            //notify the user that the registration was approved 
            Mail::to($tenant->email)->send(new sendCustomerTrialApproval($tenant));

            return true;
        }

        $this->error('no valid tenant subdomain was found! Aborting command.');
        activity('TenantInit')->log('No valid tenant subdomain of '.$dbname.' was found!');
    }
}
