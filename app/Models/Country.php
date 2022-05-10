<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Country extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    protected $primaryKey = 'uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_common_eng',
        'name_common_fra',
        'name_official_eng',
        'name_official_fra',
        'cca2',
        'cca3',
        'region',
        'subregion',
        'lat',
        'lng',
        'flag',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'laravel_through_key',
    ];

    /**
     * The attributes that are visible for arrays.
     *
     * @var array
     */
    protected $visible = [
        'uuid',
        'name_common_eng',
        'name_common_fra',
        'name_official_eng',
        'name_official_fra',
        'cca2',
        'cca3',
        'region',
        'subregion',
        'lat',
        'lng',
        'flag',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * Get all the artworks for a specific artist.
     */
    public function hasArtists(): hasMany
    {
        return $this->hasMany(
            Artist::class,
            'artist_nationality',
            'cca3'
        );
    }
}
