<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Employee;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'create']);
        // create specific user permissions
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'user-show']);
        Permission::create(['name' => 'user-create']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'supervisor']);
        $role->givePermissionTo('edit');
        $role->givePermissionTo('create');
        $role->givePermissionTo('delete');
        $role->givePermissionTo('show');

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('show');
        $role->givePermissionTo('create');
        $role->givePermissionTo('edit');

        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo(Permission::all());

        //create first administrator account

        $admin = User::create([
            'name' => 'Super User',
            'email'=> 'super@app.ismarttms.io',
            'password' => bcrypt('BlueRock00')
        ]);

        //associate user to the administrator role

        $admin->assignRole('administrator');

        //create profile for administrator - required so login will be completed without error
        $agent = employee::create([
            'user_id' => $admin->id,
            'firstName'=>'Super',
            'lastName'=> 'Admin',
            'companyName'=>'iSmartTMS.io',
            'email'=>$admin->email,
        ]);

    }
}
