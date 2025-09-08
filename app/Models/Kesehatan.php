<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Kesehatan
 *
 * @property int $id
 * @property int $desa_id
 * @property string $jenis_fasilitas
 * @property string $nama_fasilitas
 * @property int $jumlah_tenaga_medis
 * @property string|null $peralatan
 * @property string $kondisi
 * @property string|null $alamat
 * @property string|null $jam_operasional
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kesehatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesehatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesehatan query()
 * @method static \Database\Factories\KesehatanFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Kesehatan extends Model
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
        'jumlah_tenaga_medis',
        'peralatan',
        'kondisi',
        'alamat',
        'jam_operasional',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_tenaga_medis' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the kesehatan.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}