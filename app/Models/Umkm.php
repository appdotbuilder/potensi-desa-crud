<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Umkm
 *
 * @property int $id
 * @property int $desa_id
 * @property string $nama_usaha
 * @property string $jenis_usaha
 * @property int $jumlah_pekerja
 * @property string $omset_tahunan
 * @property string|null $alamat
 * @property string $pemilik
 * @property string|null $kontak
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereJenisUsaha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereJumlahPekerja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereKontak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereNamaUsaha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereOmsetTahunan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm wherePemilik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Umkm withoutTrashed()
 * @method static \Database\Factories\UmkmFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Umkm extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'nama_usaha',
        'jenis_usaha',
        'jumlah_pekerja',
        'omset_tahunan',
        'alamat',
        'pemilik',
        'kontak',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'jumlah_pekerja' => 'integer',
        'omset_tahunan' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the umkm.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}