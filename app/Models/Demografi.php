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
 * @property int $usia_0_2
 * @property int $usia_0_5
 * @property int $usia_17_plus
 * @property string $agama
 * @property string $pendidikan_terakhir
 * @property string $pekerjaan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Desa $desa
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereAgama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereDesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereLakiLaki($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi wherePekerjaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi wherePendidikanTerakhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi wherePerempuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereTotalPenduduk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereUsia02($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereUsia05($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereUsia17Plus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Demografi withoutTrashed()
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
        'usia_0_2',
        'usia_0_5',
        'usia_17_plus',
        'agama',
        'pendidikan_terakhir',
        'pekerjaan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'desa_id' => 'integer',
        'total_penduduk' => 'integer',
        'laki_laki' => 'integer',
        'perempuan' => 'integer',
        'usia_0_2' => 'integer',
        'usia_0_5' => 'integer',
        'usia_17_plus' => 'integer',
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