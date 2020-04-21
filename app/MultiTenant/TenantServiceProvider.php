<?php

namespace App\MultiTenant;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class TenantServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bindIf('App\MultiTenant\Contracts\TenantContract', function()
        {
            return new Tenant();
        }, true);

        $this->app->singleton('tenant', function($app)
        {
            $tenant = app('App\MultiTenant\Contracts\TenantContract');
            return new TenantResolver($app, $tenant, app('db'));
        });

        $this->commands([
            \App\Console\Commands\MigrateTenantCommand::class
        ]);

    }

    public function boot()
    {
        $resolver = app('tenant');
        $resolver->resolveTenant();
    }
}
