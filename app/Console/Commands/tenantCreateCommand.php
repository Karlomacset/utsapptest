<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\tenant;
use Illuminate\Support\Facades\Artisan;
use PDO;
use PDOException;
use Auth;

class tenantCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create {dbname} {--force} {--seed} {--sample} {--init}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this Command is used to create the tenant databases from migrations path and seeding path on config.tenancy';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->migratePath = config('tenancy.migrationPath');
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
        $force = $this->option('force');
        $seed = $this->option('seed');
        $sample = $this->option('sample');
        $init = $this->option('init');

        $tenant = tenant::where('subdomain',$dbname)->get();

        if($tenant == null){
            $this->error('no database name was passed. Aborting run');
            activity('CreateTenant')->log('No database name was passed - no tenancy was created');
            return;
        }

        // try{
            config(['database.connections.tenant_db.database'=>$dbname]);
            config(['database.default'=>'tenant_db']);

            $this->info('Creating tables for tenant subdomain: '.$dbname);
 //           activity('CreateTenant')->log('Creating Tables for tenant subdomain:'.$dbname.' using path '.$this->migratePath);

            $migrate = Artisan::call('migrate',[
//                '--database'=>'tenant_db',
                '--path'=>$this->migratePath,
                '--force'=>$force,
            ]);
            $this->line(Artisan::output());

            for($x = 0; $x < 1000; $x++){
                //delay until the next job
            }

            if($seed){
                $seederCommand = 'php ../utsapp/artisan db:seed';
                $seeder = Artisan::call('db:seed',[
//                    '--database'=>'tenant_db',
                ]);

                $this->line(Artisan::output());
//                activity('CreateTenant')
  //                  ->log('Seeding using seeder command: '.$seederCommand);
            };

            for($x = 0; $x < 1000; $x++){
                //delay until the next job
            }

            if($init){
 //               activity('InitTenant')
   //             ->log('Tenant being initialised for the first run. ');

                Artisan::call('tenant:init',[
                    'dbname'=>$dbname,
                    '--seed'=>false,
                    '--force'=>true
                ]);
            }

            Config('database.default','mysql');
    }
}
