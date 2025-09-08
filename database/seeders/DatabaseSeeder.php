<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Demografi;
use App\Models\Umkm;
use App\Models\FasilitasUmum;
use App\Models\Pendidikan;
use App\Models\Kesehatan;
use App\Models\PariwisataBudaya;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles first
        $superAdminRole = Role::factory()->superAdmin()->create();
        $adminDesaRole = Role::factory()->adminDesa()->create();
        $adminKecamatanRole = Role::factory()->adminKecamatan()->create();
        $adminKabupatenRole = Role::factory()->adminKabupaten()->create();

        // Create geographic hierarchy
        $kabupaten = Kabupaten::factory()->create([
            'nama_kabupaten' => 'Kabupaten Contoh'
        ]);

        $kecamatan1 = Kecamatan::factory()->create([
            'kabupaten_id' => $kabupaten->id,
            'nama_kecamatan' => 'Kecamatan Tengah'
        ]);
        
        $kecamatan2 = Kecamatan::factory()->create([
            'kabupaten_id' => $kabupaten->id,
            'nama_kecamatan' => 'Kecamatan Timur'
        ]);

        $desa1 = Desa::factory()->create([
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan1->id,
            'nama_desa' => 'Desa Makmur'
        ]);
        
        $desa2 = Desa::factory()->create([
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan1->id,
            'nama_desa' => 'Desa Sejahtera'
        ]);
        
        $desa3 = Desa::factory()->create([
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan2->id,
            'nama_desa' => 'Desa Maju'
        ]);

        // Create Super Admin user
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $superAdminRole->id,
            'status' => 'active',
        ]);

        // Create Admin Kabupaten user
        User::factory()->create([
            'name' => 'Admin Kabupaten',
            'email' => 'kabupaten@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $adminKabupatenRole->id,
            'kabupaten_id' => $kabupaten->id,
            'status' => 'active',
        ]);

        // Create Admin Kecamatan users
        User::factory()->create([
            'name' => 'Admin Kecamatan Tengah',
            'email' => 'kecamatan.tengah@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $adminKecamatanRole->id,
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan1->id,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Admin Kecamatan Timur',
            'email' => 'kecamatan.timur@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $adminKecamatanRole->id,
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan2->id,
            'status' => 'active',
        ]);

        // Create Admin Desa users
        User::factory()->create([
            'name' => 'Admin Desa Makmur',
            'email' => 'desa.makmur@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $adminDesaRole->id,
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan1->id,
            'desa_id' => $desa1->id,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Admin Desa Sejahtera',
            'email' => 'desa.sejahtera@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $adminDesaRole->id,
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan1->id,
            'desa_id' => $desa2->id,
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Admin Desa Maju',
            'email' => 'desa.maju@potensi-desa.com',
            'password' => bcrypt('password'),
            'role_id' => $adminDesaRole->id,
            'kabupaten_id' => $kabupaten->id,
            'kecamatan_id' => $kecamatan2->id,
            'desa_id' => $desa3->id,
            'status' => 'active',
        ]);

        // Create sample data for each desa
        foreach ([$desa1, $desa2, $desa3] as $desa) {
            // Demographic data
            Demografi::factory(2)->create([
                'desa_id' => $desa->id,
            ]);

            // UMKM data
            Umkm::factory(5)->active()->create([
                'desa_id' => $desa->id,
            ]);

            // Public facilities
            $fasilitasTypes = ['balai_desa', 'masjid', 'pos_ronda', 'lapangan_olahraga'];
            foreach ($fasilitasTypes as $type) {
                FasilitasUmum::factory()->create([
                    'desa_id' => $desa->id,
                    'jenis_fasilitas' => $type,
                ]);
            }

            // Education facilities
            $sekolahTypes = ['sd', 'smp'];
            foreach ($sekolahTypes as $type) {
                Pendidikan::factory()->create([
                    'desa_id' => $desa->id,
                    'jenis_sekolah' => $type,
                ]);
            }

            // Health facilities
            Kesehatan::factory()->create([
                'desa_id' => $desa->id,
                'jenis_fasilitas' => 'posyandu',
            ]);

            // Tourism and culture
            PariwisataBudaya::factory(3)->create([
                'desa_id' => $desa->id,
            ]);
        }
    }
}