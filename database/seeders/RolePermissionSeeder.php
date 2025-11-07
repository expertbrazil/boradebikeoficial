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

            // WhatsApp permissions
            'view-whatsapp',
            'manage-whatsapp',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $editorRole->syncPermissions([
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
            'view-whatsapp',
            'manage-whatsapp',
        ]);

        $viewerRole = Role::firstOrCreate(['name' => 'Visualizador']);
        $viewerRole->syncPermissions([
            'view-events',
            'view-registrations',
            'view-gallery',
            'view-partners',
            'view-whatsapp',
        ]);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@boradebike.com'],
            ['name' => 'Administrador', 'password' => bcrypt('password')]
        );
        $admin->syncRoles(['Admin']);
    }
}
