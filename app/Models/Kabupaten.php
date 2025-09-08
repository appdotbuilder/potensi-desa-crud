<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Kabupaten
 *
 * @property int $id
 * @property string $nama_kabupaten
 * @property string $ibukota_kabupaten
 * @property int $jumlah_kecamatan
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kecamatan> $kecamatans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Desa> $desas
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereIbukotaKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereJumlahKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereNamaKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten withoutTrashed()
 * @method static \Database\Factories\KabupatenFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Kabupaten extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_kabupaten',
        'ibukota_kabupaten',
        'jumlah_kecamatan',
        'deskripsi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_kecamatan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the kecamatans for the kabupaten.
     */
    public function kecamatans(): HasMany
    {
        return $this->hasMany(Kecamatan::class);
    }

    /**
     * Get the desas for the kabupaten.
     */
    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class);
    }
}