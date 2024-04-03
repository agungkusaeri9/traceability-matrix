<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'superadmin'
        ]);

        $qa = Role::create([
            'name' => 'Quality Assurance'
        ]);
        $qa->givePermissionTo(['Repository Index', 'Repository Show', 'Project Index', 'Project Create', 'Project Edit', 'Project Delete', 'Fitur Index', 'Fitur Create', 'Fitur Edit', 'Fitur Delete', 'Skenario Index', 'Skenario Create', 'Skenario Edit', 'Skenario Delete', 'Test Case Index', 'Test Case Create', 'Test Case Edit', 'Test Case Delete', 'Test Step Index', 'Test Step Create', 'Test Step Edit', 'Test Step Delete', 'Bug Report Index', 'Bug Report Create', 'Bug Report Edit', 'Bug Report Delete', 'Dashboard']);
        $dev =  Role::create([
            'name' => 'Tim Developer'
        ]);
        $dev->givePermissionTo(['Bug Report Index', 'Bug Report Edit', 'Dashboard']);
        $pc = Role::create([
            'name' => 'Project Coordinator'
        ]);
        $pc->givePermissionTo(['Project Index', 'Project Create', 'Project Edit', 'Project Delete', 'Repository Index', 'Repository Create', 'Repository Edit', 'Repository Delete', 'Profile Edit', 'User Index', 'User Create', 'User Edit', 'User Delete', 'Role Index', 'Role Create', 'Role Edit', 'Role Delete', 'Permission Index', 'Permission Create', 'Permission Edit', 'Permission Delete', 'Bug Report Index', 'Bug Report Edit', 'Dashboard']);
    }
}
