<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Database\Seeders\SystemData\PermissionSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class CleanCache
 *
 * Clear all caches of the application
 *
 * @package App\Console\Commands
 */
class UpdatePermissionSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update permission seeder';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * return self
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_permissions')->truncate();
        DB::table('user_permissions')->truncate();
        Permission::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $seeder = new PermissionSeeder();
        $seeder->run();

        $this->info('All set! :)');
    }
}
