<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Migration Path Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database migration path below you wish
    | to use as your default connection for all tenancy work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'migrationPath' => env('TN_MIGRATEPATH', '../bcms-stage/database/migrations'),

    /*
    |--------------------------------------------------------------------------
    | Default Seeding Path Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database Seeding path below you wish
    | to use as your default seeding  for all tenancy work. Of course
    | you may use many seeding s at once using the Database library.
    |
    */

    'seedPath' => env('TN_SEEDPATH','../utsapp/database/seeds'),

    /*
    |--------------------------------------------------------------------------
    | Default Sample Seeding Path Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database Seeding path below you wish
    | to use as your default seeding  for all tenancy work. Of course
    | you may use many seeding s at once using the Database library.
    |
    */

    'sampleSeedPath' => env('TN_SAMPLESEEDPATH','../utsapp/database/seeds/sample'),

    /*
    |--------------------------------------------------------------------------
    | Default Seeding Path Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database Seeding path below you wish
    | to use as your default seeding  for all tenancy work. Of course
    | you may use many seeding s at once using the Database library.
    |
    */

    'tenancyRoute' => env('TN_BASE_DB','prod'),

];

