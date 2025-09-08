<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Desa
 *
 * @property int $id
 * @property int $kabupaten_id
 * @property int $kecamatan_id
 * @property string $nama_desa
 * @property string|null $alamat
 * @property string|null $kode_pos
 * @property string|null $telepon
 * @property string|null $nama_kepala_desa
 * @property float|null $luas_wilayah
 * @property int|null $jumlah_penduduk
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Kabupaten $kabupaten
 * @property-read Kecamatan $kecamatan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Demografi> $demografis
 * @property-read int|null $demografis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Umkm> $umkms
 * @property-read int|null $umkms_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa query()
 * @method static \Database\Factories\DesaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Desa extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kabupaten_id',
        'kecamatan_id',
        'nama_desa',
        'alamat',
        'kode_pos',
        'telepon',
        'nama_kepala_desa',
        'luas_wilayah',
        'jumlah_penduduk',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'luas_wilayah' => 'decimal:2',
        'jumlah_penduduk' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the kabupaten that owns the desa.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    /**
     * Get the kecamatan that owns the desa.
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get the users for the desa.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the demografis for the desa.
     */
    public function demografis(): HasMany
    {
        return $this->hasMany(Demografi::class);
    }

    /**
     * Get the umkms for the desa.
     */
    public function umkms(): HasMany
    {
        return $this->hasMany(Umkm::class);
    }

    /**
     * Get the fasilitas umums for the desa.
     */
    public function fasilitasUmums(): HasMany
    {
        return $this->hasMany(FasilitasUmum::class);
    }

    /**
     * Get the pendidikans for the desa.
     */
    public function pendidikans(): HasMany
    {
        return $this->hasMany(Pendidikan::class);
    }

    /**
     * Get the kesehatans for the desa.
     */
    public function kesehatans(): HasMany
    {
        return $this->hasMany(Kesehatan::class);
    }

    /**
     * Get the pariwisata budayas for the desa.
     */
    public function pariwisataBudayas(): HasMany
    {
        return $this->hasMany(PariwisataBudaya::class);
    }
}