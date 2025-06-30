<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class TestDatabaseConnection extends Command
{
    protected $signature = 'db:test-connection';
    protected $description = 'Test connection to the configured database';

    public function handle()
    {
        $this->info('Testing database connection...');

        try {
            $databaseName = DB::connection()->getDatabaseName();
            $host = config('database.connections.mysql.host');
            $port = config('database.connections.mysql.port');

            DB::connection()->getPdo();

            $this->info("✅ Successfully connected to database: {$databaseName}");
            $this->line("Host: {$host}");
            $this->line("Port: {$port}");
        } catch (Exception $e) {
            $this->error("❌ Failed to connect to database.");
            $this->line("Error: " . $e->getMessage());
        }
    }
}
