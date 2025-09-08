<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FasilitasUmum
 *
 * @property int $id
 * @property int $desa_id
 * @property string $jenis_fasilitas
 * @property string $nama_fasilitas
 * @property int $jumlah
 * @property string $kondisi
 * @property string|null $lokasi
 * @property int|null $tahun_dibangun
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|FasilitasUmum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FasilitasUmum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FasilitasUmum query()
 * @method static \Database\Factories\FasilitasUmumFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class FasilitasUmum extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'jenis_fasilitas',
        'nama_fasilitas',
        'jumlah',
        'kondisi',
        'lokasi',
        'tahun_dibangun',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah' => 'integer',
        'tahun_dibangun' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the fasilitas umum.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}