<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Kecamatan
 *
 * @property int $id
 * @property string $nama_kecamatan
 * @property int $kabupaten_id
 * @property string $ibukota_kecamatan
 * @property int $jumlah_desa
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kabupaten $kabupaten
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Desa> $desas
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereIbukotaKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereJumlahDesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereKabupatenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereNamaKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan withoutTrashed()
 * @method static \Database\Factories\KecamatanFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Kecamatan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_kecamatan',
        'kabupaten_id',
        'ibukota_kecamatan',
        'jumlah_desa',
        'deskripsi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'kabupaten_id' => 'integer',
        'jumlah_desa' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the kabupaten that owns the kecamatan.
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    /**
     * Get the desas for the kecamatan.
     */
    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class);
    }
}