<?php

namespace App\Console\Commands;

use Illuminate\Database\Console\Migrations\MigrateCommand as BaseCommand;
use App\MultiTenant\Traits\MigrationChanges;

class MigrateTenantCommand extends BaseCommand
{

    use MigrationChanges;

}