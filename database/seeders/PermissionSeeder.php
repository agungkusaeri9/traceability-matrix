<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'Dashboard'
        ]);

        Permission::create([
            'name' => 'Role Index'
        ]);
        Permission::create([
            'name' => 'Role Create'
        ]);
        Permission::create([
            'name' => 'Role Edit'
        ]);
        Permission::create([
            'name' => 'Role Delete'
        ]);

        Permission::create([
            'name' => 'Permission Index'
        ]);
        Permission::create([
            'name' => 'Permission Create'
        ]);
        Permission::create([
            'name' => 'Permission Edit'
        ]);
        Permission::create([
            'name' => 'Permission Delete'
        ]);

        Permission::create([
            'name' => 'User Index'
        ]);
        Permission::create([
            'name' => 'User Create'
        ]);
        Permission::create([
            'name' => 'User Edit'
        ]);
        Permission::create([
            'name' => 'User Delete'
        ]);

        Permission::create([
            'name' => 'Project Index'
        ]);
        Permission::create([
            'name' => 'Project Create'
        ]);
        Permission::create([
            'name' => 'Project Edit'
        ]);
        Permission::create([
            'name' => 'Project Delete'
        ]);
        Permission::create([
            'name' => 'Project Report'
        ]);
        Permission::create([
            'name' => 'Fitur Index'
        ]);
        Permission::create([
            'name' => 'Fitur Create'
        ]);
        Permission::create([
            'name' => 'Fitur Edit'
        ]);
        Permission::create([
            'name' => 'Fitur Delete'
        ]);
        Permission::create([
            'name' => 'Skenario Index'
        ]);
        Permission::create([
            'name' => 'Skenario Create'
        ]);
        Permission::create([
            'name' => 'Skenario Edit'
        ]);
        Permission::create([
            'name' => 'Skenario Delete'
        ]);
        Permission::create([
            'name' => 'Test Case Index'
        ]);
        Permission::create([
            'name' => 'Test Case Create'
        ]);
        Permission::create([
            'name' => 'Test Case Edit'
        ]);
        Permission::create([
            'name' => 'Test Case Delete'
        ]);
        Permission::create([
            'name' => 'Test Step Index'
        ]);
        Permission::create([
            'name' => 'Test Step Create'
        ]);
        Permission::create([
            'name' => 'Test Step Edit'
        ]);
        Permission::create([
            'name' => 'Test Step Delete'
        ]);
        Permission::create([
            'name' => 'Bug Report Index'
        ]);
        Permission::create([
            'name' => 'Bug Report Create'
        ]);
        Permission::create([
            'name' => 'Bug Report Edit'
        ]);
        Permission::create([
            'name' => 'Bug Report Delete'
        ]);
        Permission::create([
            'name' => 'Repository Index'
        ]);
        Permission::create([
            'name' => 'Repository Create'
        ]);
        Permission::create([
            'name' => 'Repository Edit'
        ]);
        Permission::create([
            'name' => 'Repository Delete'
        ]);
        Permission::create([
            'name' => 'Repository Show'
        ]);
        Permission::create([
            'name' => 'Profile Edit'
        ]);
    }
}
