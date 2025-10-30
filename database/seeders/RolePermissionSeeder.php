<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Event permissions
            'view-events',
            'create-events',
            'edit-events',
            'delete-events',
            
            // Registration permissions
            'view-registrations',
            'create-registrations',
            'edit-registrations',
            'delete-registrations',
            'export-registrations',
            
            // Gallery permissions
            'view-gallery',
            'create-gallery',
            'edit-gallery',
            'delete-gallery',
            
            // Partner permissions
            'view-partners',
            'create-partners',
            'edit-partners',
            'delete-partners',
            
            // User permissions
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'assign-roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $editorRole = Role::create(['name' => 'Editor']);
        $editorRole->givePermissionTo([
            'view-events',
            'create-events',
            'edit-events',
            'view-registrations',
            'create-registrations',
            'edit-registrations',
            'export-registrations',
            'view-gallery',
            'create-gallery',
            'edit-gallery',
            'view-partners',
            'create-partners',
            'edit-partners',
        ]);

        $viewerRole = Role::create(['name' => 'Visualizador']);
        $viewerRole->givePermissionTo([
            'view-events',
            'view-registrations',
            'view-gallery',
            'view-partners',
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@boradebike.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Admin');
    }
}
