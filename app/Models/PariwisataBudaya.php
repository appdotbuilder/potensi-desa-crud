<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PariwisataBudaya
 *
 * @property int $id
 * @property int $desa_id
 * @property string $nama_objek
 * @property string $jenis
 * @property string|null $deskripsi
 * @property string|null $lokasi
 * @property int|null $pengunjung_tahunan
 * @property float|null $potensi_pendapatan
 * @property string|null $foto
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PariwisataBudaya newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PariwisataBudaya newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PariwisataBudaya query()
 * @method static \Illuminate\Database\Eloquent\Builder|PariwisataBudaya active()
 * @method static \Database\Factories\PariwisataBudayaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PariwisataBudaya extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'nama_objek',
        'jenis',
        'deskripsi',
        'lokasi',
        'pengunjung_tahunan',
        'potensi_pendapatan',
        'foto',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pengunjung_tahunan' => 'integer',
        'potensi_pendapatan' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the pariwisata budaya.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Scope a query to only include active pariwisata budaya.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }
}