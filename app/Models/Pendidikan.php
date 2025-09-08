<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Pendidikan
 *
 * @property int $id
 * @property int $desa_id
 * @property string $jenis_sekolah
 * @property string $nama_sekolah
 * @property int $jumlah_siswa
 * @property int $jumlah_guru
 * @property int $jumlah_ruang_kelas
 * @property string $kondisi_bangunan
 * @property string|null $fasilitas
 * @property string|null $alamat
 * @property int|null $tahun_berdiri
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Pendidikan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pendidikan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pendidikan query()
 * @method static \Database\Factories\PendidikanFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Pendidikan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'jenis_sekolah',
        'nama_sekolah',
        'jumlah_siswa',
        'jumlah_guru',
        'jumlah_ruang_kelas',
        'kondisi_bangunan',
        'fasilitas',
        'alamat',
        'tahun_berdiri',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_siswa' => 'integer',
        'jumlah_guru' => 'integer',
        'jumlah_ruang_kelas' => 'integer',
        'tahun_berdiri' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the pendidikan.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}