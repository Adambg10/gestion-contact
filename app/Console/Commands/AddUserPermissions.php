<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddUserPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ladmin:add-user-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user management permissions to L-Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $permissions = [
            [
                'name' => 'ladmin.user.index',
                'title' => 'View Users',
                'description' => 'User can view users list',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ladmin.user.create',
                'title' => 'Create New User',
                'description' => 'User can create new user account',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ladmin.user.edit',
                'title' => 'Update User',
                'description' => 'User can update user account',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ladmin.user.delete',
                'title' => 'Delete User',
                'description' => 'User can delete user account',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name']],
                $permission
            );
        }

        $this->info('User permissions added successfully!');
    }
}
