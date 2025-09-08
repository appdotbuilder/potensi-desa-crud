<?php

namespace Tests\Feature;

use App\Models\Demografi;
use App\Models\Desa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VillageDataSystemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
    }

    /** @test */
    public function super_admin_can_access_dashboard()
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $user = User::factory()->create();
        $user->roles()->attach($superAdminRole->id);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->has('stats')
                ->where('userRole', 'super_admin')
        );
    }

    /** @test */
    public function admin_desa_can_view_their_village_dashboard()
    {
        $adminDesaRole = Role::where('name', 'admin_desa')->first();
        $desa = Desa::factory()->create();
        $user = User::factory()->create(['desa_id' => $desa->id]);
        $user->roles()->attach($adminDesaRole->id);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->has('stats.desa')
                ->where('userRole', 'admin_desa')
        );
    }

    /** @test */
    public function admin_desa_can_create_demografi_data()
    {
        $adminDesaRole = Role::where('name', 'admin_desa')->first();
        $desa = Desa::factory()->create();
        $user = User::factory()->create(['desa_id' => $desa->id]);
        $user->roles()->attach($adminDesaRole->id);

        $demografiData = [
            'desa_id' => $desa->id,
            'total_penduduk' => 1000,
            'laki_laki' => 500,
            'perempuan' => 500,
            'usia_0_2' => 50,
            'usia_0_5' => 100,
            'usia_17_plus' => 800,
            'agama' => 'Islam',
            'pendidikan_terakhir' => 'SMA',
            'pekerjaan' => 'Petani',
        ];

        $response = $this->actingAs($user)->post('/demografi', $demografiData);

        $response->assertRedirect('/demografi');
        $this->assertDatabaseHas('demografis', [
            'desa_id' => $desa->id,
            'total_penduduk' => 1000,
            'agama' => 'Islam',
        ]);
    }

    /** @test */
    public function welcome_page_loads_successfully()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function demografi_index_page_displays_data()
    {
        $adminDesaRole = Role::where('name', 'admin_desa')->first();
        $desa = Desa::factory()->create();
        $user = User::factory()->create(['desa_id' => $desa->id]);
        $user->roles()->attach($adminDesaRole->id);
        
        // Create some demographic data
        Demografi::factory()->create(['desa_id' => $desa->id]);

        $response = $this->actingAs($user)->get('/demografi');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('demografi/index')
                ->has('demografis.data', 1)
                ->where('userRole', 'admin_desa')
        );
    }
}