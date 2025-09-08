<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisUsaha = fake()->randomElement(['perdagangan', 'jasa', 'manufaktur', 'kuliner', 'kerajinan', 'pertanian']);
        
        $namaUsaha = match($jenisUsaha) {
            'perdagangan' => 'Toko ' . fake()->lastName(),
            'jasa' => 'Jasa ' . fake()->word(),
            'manufaktur' => 'Pabrik ' . fake()->word(),
            'kuliner' => 'Warung ' . fake()->firstName(),
            'kerajinan' => 'Kerajinan ' . fake()->word(),
            'pertanian' => 'Koperasi ' . fake()->word(),
            default => 'Usaha ' . fake()->word(),
        };

        return [
            'desa_id' => Desa::factory(),
            'nama_usaha' => $namaUsaha,
            'jenis_usaha' => $jenisUsaha,
            'pemilik' => fake()->name(),
            'alamat' => fake()->address(),
            'jumlah_pekerja' => fake()->numberBetween(1, 20),
            'omset_tahunan' => fake()->randomFloat(2, 10000000, 500000000),
            'produk_utama' => fake()->words(3, true),
            'status' => fake()->randomElement(['aktif', 'tidak_aktif']),
            'keterangan' => fake()->sentence(),
        ];
    }

    /**
     * Active UMKM state.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'aktif',
        ]);
    }
}