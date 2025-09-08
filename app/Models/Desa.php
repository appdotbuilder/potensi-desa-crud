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
 * @property string $nama_desa
 * @property int $kecamatan_id
 * @property int $kabupaten_id
 * @property string|null $alamat
 * @property string|null $kode_pos
 * @property string $kepala_desa
 * @property string $luas_wilayah_total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kecamatan $kecamatan
 * @property-read \App\Models\Kabupaten $kabupaten
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereKabupatenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereKecamatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereKepalaDesaDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereKodePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereLuasWilayahTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereNamaDesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Desa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Desa withoutTrashed()
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
        'nama_desa',
        'kecamatan_id',
        'kabupaten_id',
        'alamat',
        'kode_pos',
        'kepala_desa',
        'luas_wilayah_total',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'kecamatan_id' => 'integer',
        'kabupaten_id' => 'integer',
        'luas_wilayah_total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the kecamatan that owns the desa.
     */
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get the kabupaten that owns the desa.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    /**
     * Get the users for the desa.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}