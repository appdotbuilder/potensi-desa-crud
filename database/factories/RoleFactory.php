<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['super_admin', 'admin_kabupaten', 'admin_kecamatan', 'admin_desa']),
            'display_name' => fake()->words(2, true),
            'description' => fake()->sentence(),
        ];
    }

    /**
     * Indicate that the role is super admin.
     */
    public function superAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'super_admin',
            'display_name' => 'Super Administrator',
            'description' => 'Full system access and user management',
        ]);
    }

    /**
     * Indicate that the role is admin kabupaten.
     */
    public function adminKabupaten(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_kabupaten',
            'display_name' => 'Admin Kabupaten',
            'description' => 'Read-only access to all regency data',
        ]);
    }

    /**
     * Indicate that the role is admin kecamatan.
     */
    public function adminKecamatan(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_kecamatan',
            'display_name' => 'Admin Kecamatan',
            'description' => 'Read-only access to district villages data',
        ]);
    }

    /**
     * Indicate that the role is admin desa.
     */
    public function adminDesa(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_desa',
            'display_name' => 'Admin Desa',
            'description' => 'Full access to assigned village data',
        ]);
    }
}