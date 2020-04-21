<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;
use DB;

class DatabaseCreateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new tenant ';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'db:create {dbname}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$database = env('DB_DATABASE', false);
        $database = $this->argument('dbname');

        if (! $database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');
            activity('CreateDb')->log('Skipping creation of database as env(DB_DATABASE) is empty');
            return;
        }

        try {
            //$pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), env('DB_USERNAME'), env('DB_PASSWORD'));
            $pdo = DB::connection()->getPdo();

            $pdo->exec('CREATE DATABASE IF NOT EXISTS '.$database);
            // $pdo->exec("GRANT ALL PRIVILEGES ON ".$database." To 'bcmsadmin'@'%' IDENTIFIED BY 'redrock00'");
            // $pdo->exec("GRANT ALL PRIVILEGES ON ".$database." To 'bcmsprodadmin'@'%' IDENTIFIED BY 'RedRock00!'");

            $this->info(sprintf('Successfully created %s database', $database));
            activity('CreateDB')->log('Successfully Created '.$database);

        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database, $exception->getMessage()));
            activity('CreateDb')->log('Failed to create %s database, %s'. $exception->getMessage());
        }
    }

    /**
     * @param  string $host
     * @param  integer $port
     * @param  string $username
     * @param  string $password
     * @return PDO
     */
    private function getPDOConnection($host, $port, $username, $password)
    {
        return new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
    }
}
