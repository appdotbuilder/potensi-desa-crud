<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
                'description' => 'Full system access and user management'
            ],
            [
                'name' => 'admin_kabupaten',
                'display_name' => 'Admin Kabupaten',
                'description' => 'Read-only access to all regency data'
            ],
            [
                'name' => 'admin_kecamatan',
                'display_name' => 'Admin Kecamatan', 
                'description' => 'Read-only access to district villages data'
            ],
            [
                'name' => 'admin_desa',
                'display_name' => 'Admin Desa',
                'description' => 'Full access to assigned village data'
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}