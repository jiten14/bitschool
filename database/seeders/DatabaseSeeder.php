<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name'  =>  'Admin User',
            'password' => bcrypt( 'admin123' ),
        ]);
        $this->command->info('Admin user created.');

        $this->command->warn(PHP_EOL . 'Creating New Role...');
        $adminRole = Role::create(['name' => 'admin']);
        $this->command->info('Role created.');

        $this->command->warn(PHP_EOL . 'Assigning Roles...');
        $adminUser->assignRole($adminRole);
        $this->command->info('Role Assigned.');
    }
}
