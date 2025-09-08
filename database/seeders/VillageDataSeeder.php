<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Demografi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Role;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VillageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Kabupaten
        $kabupaten1 = Kabupaten::create([
            'nama_kabupaten' => 'Kabupaten Bandung',
            'ibukota_kabupaten' => 'Soreang',
            'jumlah_kecamatan' => 3,
            'deskripsi' => 'Kabupaten Bandung adalah sebuah kabupaten di provinsi Jawa Barat'
        ]);

        $kabupaten2 = Kabupaten::create([
            'nama_kabupaten' => 'Kabupaten Garut',
            'ibukota_kabupaten' => 'Garut',
            'jumlah_kecamatan' => 2,
            'deskripsi' => 'Kabupaten Garut terkenal dengan dodol dan wisata alamnya'
        ]);

        // Create Kecamatan
        $kecamatan1 = Kecamatan::create([
            'nama_kecamatan' => 'Kecamatan Baleendah',
            'kabupaten_id' => $kabupaten1->id,
            'ibukota_kecamatan' => 'Baleendah',
            'jumlah_desa' => 2,
            'deskripsi' => 'Kecamatan Baleendah terletak di bagian selatan Kabupaten Bandung'
        ]);

        $kecamatan2 = Kecamatan::create([
            'nama_kecamatan' => 'Kecamatan Bojongsoang',
            'kabupaten_id' => $kabupaten1->id,
            'ibukota_kecamatan' => 'Bojongsoang',
            'jumlah_desa' => 2,
            'deskripsi' => 'Kecamatan Bojongsoang berbatasan dengan Kota Bandung'
        ]);

        $kecamatan3 = Kecamatan::create([
            'nama_kecamatan' => 'Kecamatan Tarogong',
            'kabupaten_id' => $kabupaten2->id,
            'ibukota_kecamatan' => 'Tarogong',
            'jumlah_desa' => 1,
            'deskripsi' => 'Kecamatan Tarogong adalah pusat pemerintahan Kabupaten Garut'
        ]);

        // Create Desa
        $desa1 = Desa::create([
            'nama_desa' => 'Desa Andir',
            'kecamatan_id' => $kecamatan1->id,
            'kabupaten_id' => $kabupaten1->id,
            'alamat' => 'Jl. Raya Baleendah No. 123',
            'kode_pos' => '40375',
            'kepala_desa' => 'Bapak Andi Setiawan',
            'luas_wilayah_total' => 250.50
        ]);

        $desa2 = Desa::create([
            'nama_desa' => 'Desa Malakasari',
            'kecamatan_id' => $kecamatan1->id,
            'kabupaten_id' => $kabupaten1->id,
            'alamat' => 'Jl. Malakasari Raya No. 45',
            'kode_pos' => '40375',
            'kepala_desa' => 'Bapak Dedi Kurniawan',
            'luas_wilayah_total' => 180.25
        ]);

        $desa3 = Desa::create([
            'nama_desa' => 'Desa Bojongsoang',
            'kecamatan_id' => $kecamatan2->id,
            'kabupaten_id' => $kabupaten1->id,
            'alamat' => 'Jl. Bojongsoang No. 67',
            'kode_pos' => '40287',
            'kepala_desa' => 'Ibu Sari Dewi',
            'luas_wilayah_total' => 320.75
        ]);

        // Get roles
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminDesaRole = Role::where('name', 'admin_desa')->first();
        $adminKecamatanRole = Role::where('name', 'admin_kecamatan')->first();
        $adminKabupatenRole = Role::where('name', 'admin_kabupaten')->first();

        // Create Users
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'super@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->roles()->attach($superAdminRole->id);

        $adminDesa1 = User::create([
            'name' => 'Admin Desa Andir',
            'email' => 'admin.andir@desa.id',
            'password' => Hash::make('password'),
            'desa_id' => $desa1->id,
            'email_verified_at' => now(),
        ]);
        $adminDesa1->roles()->attach($adminDesaRole->id);

        $adminDesa2 = User::create([
            'name' => 'Admin Desa Malakasari', 
            'email' => 'admin.malakasari@desa.id',
            'password' => Hash::make('password'),
            'desa_id' => $desa2->id,
            'email_verified_at' => now(),
        ]);
        $adminDesa2->roles()->attach($adminDesaRole->id);

        $adminKecamatan = User::create([
            'name' => 'Admin Kecamatan Baleendah',
            'email' => 'admin.baleendah@kec.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $adminKecamatan->roles()->attach($adminKecamatanRole->id);

        $adminKabupaten = User::create([
            'name' => 'Admin Kabupaten Bandung',
            'email' => 'admin.bandung@kab.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $adminKabupaten->roles()->attach($adminKabupatenRole->id);

        // Create sample demographic data
        Demografi::create([
            'desa_id' => $desa1->id,
            'total_penduduk' => 1250,
            'laki_laki' => 625,
            'perempuan' => 625,
            'usia_0_2' => 45,
            'usia_0_5' => 120,
            'usia_17_plus' => 850,
            'agama' => 'Islam',
            'pendidikan_terakhir' => 'SMA',
            'pekerjaan' => 'Petani'
        ]);

        Demografi::create([
            'desa_id' => $desa2->id,
            'total_penduduk' => 980,
            'laki_laki' => 490,
            'perempuan' => 490,
            'usia_0_2' => 35,
            'usia_0_5' => 95,
            'usia_17_plus' => 720,
            'agama' => 'Islam',
            'pendidikan_terakhir' => 'SD',
            'pekerjaan' => 'Pedagang'
        ]);

        // Create sample UMKM data
        Umkm::create([
            'desa_id' => $desa1->id,
            'nama_usaha' => 'Warung Makan Bu Ati',
            'jenis_usaha' => 'Kuliner',
            'jumlah_pekerja' => 3,
            'omset_tahunan' => 45000000,
            'alamat' => 'Jl. Raya Andir No. 23',
            'pemilik' => 'Ibu Ati Suhartini',
            'kontak' => '0812-3456-7890'
        ]);

        Umkm::create([
            'desa_id' => $desa1->id,
            'nama_usaha' => 'Toko Kelontong Pak Budi',
            'jenis_usaha' => 'Perdagangan',
            'jumlah_pekerja' => 2,
            'omset_tahunan' => 75000000,
            'alamat' => 'Jl. Andir Tengah No. 12',
            'pemilik' => 'Bapak Budi Santoso',
            'kontak' => '0813-4567-8901'
        ]);

        Umkm::create([
            'desa_id' => $desa2->id,
            'nama_usaha' => 'Konveksi Malaka Jaya',
            'jenis_usaha' => 'Manufaktur',
            'jumlah_pekerja' => 8,
            'omset_tahunan' => 120000000,
            'alamat' => 'Jl. Malakasari No. 56',
            'pemilik' => 'Bapak Jajang Nurjaman',
            'kontak' => '0814-5678-9012'
        ]);

        $this->command->info('Village data seeded successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Super Admin: super@admin.com / password');
        $this->command->info('Admin Desa Andir: admin.andir@desa.id / password');
        $this->command->info('Admin Desa Malakasari: admin.malakasari@desa.id / password');
        $this->command->info('Admin Kecamatan: admin.baleendah@kec.id / password');
        $this->command->info('Admin Kabupaten: admin.bandung@kab.id / password');
    }
}