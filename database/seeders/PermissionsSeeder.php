<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list trusts']);
        Permission::create(['name' => 'view trusts']);
        Permission::create(['name' => 'create trusts']);
        Permission::create(['name' => 'update trusts']);
        Permission::create(['name' => 'delete trusts']);

        Permission::create(['name' => 'list outbounds']);
        Permission::create(['name' => 'view outbounds']);
        Permission::create(['name' => 'create outbounds']);
        Permission::create(['name' => 'update outbounds']);
        Permission::create(['name' => 'delete outbounds']);

        Permission::create(['name' => 'list testtypes']);
        Permission::create(['name' => 'view testtypes']);
        Permission::create(['name' => 'create testtypes']);
        Permission::create(['name' => 'update testtypes']);
        Permission::create(['name' => 'delete testtypes']);

        Permission::create(['name' => 'list keydates']);
        Permission::create(['name' => 'view keydates']);
        Permission::create(['name' => 'create keydates']);
        Permission::create(['name' => 'update keydates']);
        Permission::create(['name' => 'delete keydates']);

        Permission::create(['name' => 'list patients']);
        Permission::create(['name' => 'view patients']);
        Permission::create(['name' => 'create patients']);
        Permission::create(['name' => 'update patients']);
        Permission::create(['name' => 'delete patients']);

        Permission::create(['name' => 'list campaigns']);
        Permission::create(['name' => 'view campaigns']);
        Permission::create(['name' => 'create campaigns']);
        Permission::create(['name' => 'update campaigns']);
        Permission::create(['name' => 'delete campaigns']);

        Permission::create(['name' => 'list libraries']);
        Permission::create(['name' => 'view libraries']);
        Permission::create(['name' => 'create libraries']);
        Permission::create(['name' => 'update libraries']);
        Permission::create(['name' => 'delete libraries']);

        Permission::create(['name' => 'list patientmessages']);
        Permission::create(['name' => 'view patientmessages']);
        Permission::create(['name' => 'create patientmessages']);
        Permission::create(['name' => 'update patientmessages']);
        Permission::create(['name' => 'delete patientmessages']);

        Permission::create(['name' => 'list patientcampaigns']);
        Permission::create(['name' => 'view patientcampaigns']);
        Permission::create(['name' => 'create patientcampaigns']);
        Permission::create(['name' => 'update patientcampaigns']);
        Permission::create(['name' => 'delete patientcampaigns']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
