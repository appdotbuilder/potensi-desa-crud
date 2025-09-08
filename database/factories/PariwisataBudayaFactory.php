<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PariwisataBudaya>
 */
class PariwisataBudayaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis = fake()->randomElement([
            'pariwisata_alam', 'pariwisata_budaya', 'pariwisata_religi', 
            'budaya_adat', 'seni_tradisional'
        ]);

        $namaObjek = match($jenis) {
            'pariwisata_alam' => fake()->randomElement([
                'Air Terjun ' . fake()->word(),
                'Pantai ' . fake()->word(),
                'Bukit ' . fake()->word(),
                'Hutan ' . fake()->word()
            ]),
            'pariwisata_budaya' => fake()->randomElement([
                'Candi ' . fake()->word(),
                'Museum ' . fake()->word(),
                'Rumah Adat ' . fake()->word()
            ]),
            'pariwisata_religi' => fake()->randomElement([
                'Makam ' . fake()->name(),
                'Masjid Bersejarah ' . fake()->word(),
                'Petilasan ' . fake()->word()
            ]),
            'budaya_adat' => fake()->randomElement([
                'Upacara ' . fake()->word(),
                'Ritual ' . fake()->word(),
                'Tradisi ' . fake()->word()
            ]),
            'seni_tradisional' => fake()->randomElement([
                'Tarian ' . fake()->word(),
                'Kerajinan ' . fake()->word(),
                'Musik ' . fake()->word()
            ]),
            default => 'Objek ' . fake()->word(),
        };

        return [
            'desa_id' => Desa::factory(),
            'nama_objek' => $namaObjek,
            'jenis' => $jenis,
            'deskripsi' => fake()->paragraph(3),
            'lokasi' => fake()->address(),
            'pengunjung_tahunan' => fake()->numberBetween(100, 5000),
            'potensi_pendapatan' => fake()->randomFloat(2, 5000000, 100000000),
            'foto' => null,
            'status' => fake()->randomElement(['aktif', 'tidak_aktif', 'dalam_pengembangan']),
        ];
    }

    /**
     * Active tourism/culture state.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'aktif',
        ]);
    }
}