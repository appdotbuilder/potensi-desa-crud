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
 * @property string|null $alamat
 * @property string|null $kode_pos
 * @property string|null $telepon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Kecamatan> $kecamatans
 * @property-read int|null $kecamatans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Desa> $desas
 * @property-read int|null $desas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten query()
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

    /**
     * Get the users for the kabupaten.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}