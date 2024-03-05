<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Cashier Permission
        Permission::create(['name' => 'list bookings']);
        Permission::create(['name' => 'view bookings']);
        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'list menus']);
        Permission::create(['name' => 'view menus']);
        Permission::create(['name' => 'list stocks']);
        Permission::create(['name' => 'view stocks']);
        Permission::create(['name' => 'list tables']);
        Permission::create(['name' => 'view tables']);
        Permission::create(['name' => 'list types']);
        Permission::create(['name' => 'view types']);

        Permission::create(['name' => 'list transactions']);
        Permission::create(['name' => 'view transactions']);
        Permission::create(['name' => 'create transactions']);
        Permission::create(['name' => 'update transactions']);
        Permission::create(['name' => 'delete transactions']);

        Permission::create(['name' => 'list transactiondetails']);
        Permission::create(['name' => 'view transactiondetails']);
        Permission::create(['name' => 'create transactiondetails']);
        Permission::create(['name' => 'update transactiondetails']);
        Permission::create(['name' => 'delete transactiondetails']);


        // // Create user role and assign existing permissions
        // $currentPermissions = Permission::all();
        // $userRole = Role::create(['name' => 'user']);
        // $userRole->givePermissionTo($currentPermissions);

        $currentPermissions = Permission::all();
        $cashierRole = Role::create(['name' => 'cashier']);
        $cashierRole->givePermissionTo($currentPermissions);

        // Create default permissions

        Permission::create(['name' => 'create bookings']);
        Permission::create(['name' => 'update bookings']);
        Permission::create(['name' => 'delete bookings']);


        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);


        Permission::create(['name' => 'create menus']);
        Permission::create(['name' => 'update menus']);
        Permission::create(['name' => 'delete menus']);

        Permission::create(['name' => 'create stocks']);
        Permission::create(['name' => 'update stocks']);
        Permission::create(['name' => 'delete stocks']);


        Permission::create(['name' => 'create tables']);
        Permission::create(['name' => 'update tables']);
        Permission::create(['name' => 'delete tables']);



        Permission::create(['name' => 'create types']);
        Permission::create(['name' => 'update types']);
        Permission::create(['name' => 'delete types']);



        //booker permimission

        $bookerRole = Role::create(['name' => 'booker']);

        $bookerPermission = [
            'list bookings',
            'view bookings',
            'create bookings',
            'update bookings',
            'delete bookings',

            'list tables',
            'view tables',

        ];

        $bookerRole->givePermissionTo($bookerPermission);





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
        $bookerUser = \App\Models\User::whereEmail('booker@booker.com')->first()->assignRole($bookerRole);
        $cashierUser = \App\Models\User::whereEmail('cashier@cashier.com')->first()->assignRole($cashierRole);

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
