<?php

use Illuminate\Database\Seeder;
use App\Tenant;

class SeedFirstTenant extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this will seed the first tenant in the tenant table, which is this app
        $tenant = Tenant::create([
            'name'=>'UTS App Default',
            'email'=>'super@adb.utsapp.test',
            'subdomain'=>'utsapp',
            'alias_domain'=>'utsapp.test',
            'connection'=>'tenant_db',
            'admin_id'=> 1
        ]);
        
    }
}
