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
 * @property int $kabupaten_id
 * @property string $nama_kecamatan
 * @property string|null $alamat
 * @property string|null $kode_pos
 * @property string|null $telepon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read Kabupaten $kabupaten
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Desa> $desas
 * @property-read int|null $desas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan query()
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
        'kabupaten_id',
        'nama_kecamatan',
        'alamat',
        'kode_pos',
        'telepon',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
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

    /**
     * Get the users for the kecamatan.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}