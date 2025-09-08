<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Demografi
 *
 * @property int $id
 * @property int $desa_id
 * @property int $total_penduduk
 * @property int $laki_laki
 * @property int $perempuan
 * @property int $usia_0_14
 * @property int $usia_15_64
 * @property int $usia_65_plus
 * @property string|null $agama_mayoritas
 * @property int $islam
 * @property int $kristen
 * @property int $katolik
 * @property int $hindu
 * @property int $buddha
 * @property int $konghucu
 * @property int $tidak_sekolah
 * @property int $sd
 * @property int $smp
 * @property int $sma
 * @property int $diploma
 * @property int $sarjana
 * @property int $petani
 * @property int $pedagang
 * @property int $pns
 * @property int $swasta
 * @property int $tidak_bekerja
 * @property int $tahun_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi query()
 * @method static \Database\Factories\DemografiFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Demografi extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'desa_id',
        'total_penduduk',
        'laki_laki',
        'perempuan',
        'usia_0_14',
        'usia_15_64',
        'usia_65_plus',
        'agama_mayoritas',
        'islam',
        'kristen',
        'katolik',
        'hindu',
        'buddha',
        'konghucu',
        'tidak_sekolah',
        'sd',
        'smp',
        'sma',
        'diploma',
        'sarjana',
        'petani',
        'pedagang',
        'pns',
        'swasta',
        'tidak_bekerja',
        'tahun_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun_data' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the desa that owns the demografi.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}