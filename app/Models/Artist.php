<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Artist extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';
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
        'navigart_id',
        'artist_name',
        'artist_type',
        'artist_gender',
        'artist_birth',
        'artist_death',
        'artist_nationality',
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
        'uuid' => 'uuid',
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
    public function hasArtworks()
    {
        return $this->hasMany(
            'App\Models\Artwork',
            'artist_uuid',
            'uuid'
        );
    }

    /**
     * Get all the artworks for a specific artist.
     */
    public function hasNationality()
    {
        return $this->hasOne(
            'App\Models\Country',
            'cca3',
            'artist_nationality'
        );
    }

    /**
     * Get all the objects for a specific artist.
     */
    public function hasWorkedFor()
    {
        return $this->hasManyThrough(
            'App\Models\Movement',
            'App\Models\ArtistMovement',
            'artist_uuid',
            'uuid',
            'uuid',
            'movement_uuid',
        );
    }
}
