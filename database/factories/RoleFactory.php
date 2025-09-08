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
            'name' => fake()->unique()->randomElement(['super_admin', 'admin_desa', 'admin_kecamatan', 'admin_kabupaten']),
            'display_name' => fake()->jobTitle(),
            'description' => fake()->sentence(),
        ];
    }

    /**
     * Super Admin role state.
     */
    public function superAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'super_admin',
            'display_name' => 'Super Administrator',
            'description' => 'Full access to all features and data management',
        ]);
    }

    /**
     * Admin Desa role state.
     */
    public function adminDesa(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_desa',
            'display_name' => 'Admin Desa',
            'description' => 'Can manage data for assigned village only',
        ]);
    }

    /**
     * Admin Kecamatan role state.
     */
    public function adminKecamatan(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_kecamatan',
            'display_name' => 'Admin Kecamatan',
            'description' => 'Can view reports from villages under their district',
        ]);
    }

    /**
     * Admin Kabupaten role state.
     */
    public function adminKabupaten(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'admin_kabupaten',
            'display_name' => 'Admin Kabupaten',
            'description' => 'Can view all district and village reports',
        ]);
    }
}