<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tenant;
use Illuminate\Support\Str;

use App\Mail\customerRegistration;
use App\Mail\sendCustomerTrialApproval;
use App\Mail\sendNewCustomerTrialRequest;


class RegManagerController extends Controller
{
    public function registerNewClient(Request $request)
    {
        //validate Entries
        $validated = $request->validate([
            'companyName'=>'required',
            'email'=>'required|email',
            'firstName'=>'required',
            'lastName'=>'required'
        ]);

        //create a new client
        $client = Client::create($request->all());
        if($client){
            $client->approvalToken = Str::random(16);
            $client->status_id = 1;
            $client->save();
        }

        $to = explode(',',env('MAIL_BCC_TO'));
        Mail::to($client->email)->send(new customerRegistration($client));
        Mail::to($to)->send(new sendNewCustomerTrialRequest($client));

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function verify($id)
    {
        $client = Client::where('approvalToken',$id)->get()->first();

        if($client){
            //token is found create tenancy
            $newTenantSubDomain = strtolower(substr(str_replace(' ','',$client->companyName),0,6));
            $tenant = Tenant::where('subdomain',$newTenantSubDomain)->get()->first();
            if($tenant != null){
                $newTenantSubDomain = strtolower($newTenantSubDomain.str_pad(strval($client->id),3,'0',STR_PAD_LEFT));
                $newCompanyName = $client->companyName.' '.str_pad(strval($client->id),3,'0',STR_PAD_LEFT);
            }else{
                $newCompanyName = $client->companyName;
            }            
        }

        $tenant = new Tenant();
        $tenant->name = $newCompanyName;
        $tenant->email = $client->email;
        $tenant->subdomain = $newTenantSubDomain;
        $tenant->alias_domain = $newTenantSubDomain.'.utsapp.test';
        $tenant->connection = 'tenant_db';
        $tenant->company_id= $client->id;
        $tenant->save();

        //submit the activity to the queue worker
        $makedb = Artisan::call('db:create',['dbname'=>$newTenantSubDomain]);
        if($makedb == 0){
            Artisan::queue('tenant:create',[
                'dbname'=>$newTenantSubDomain,
                '--force'=>true
            ]);

            Artisan::queue('db:seed',[
                '--database'=>'tenant_db'
            ]);
            
            Artisan::queue('tenant:init',[
                'dbname'=>$newTenantSubDomain,
                '--seed'=>true,
                '--force'=>true
            ]);

            //change the approvtoken to disable the approval trigger
            $client->approvalToken = Str::random(16);
            $client->status_id = 2;
            $client->save();

            return view('tenant.approval',['ag'=>$client,'bg'=>'approve']);
        }
        return view('tenant.notverified',['ag'=>$client,'bg'=>'Failed to create DB - contact admin']);
    }


}
