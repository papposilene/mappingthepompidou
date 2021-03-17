<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Movement extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movements';
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
        'movement_name',
        'movement_slug',
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
     * Get all the objects for a specific artist.
     */
    public function hasArtworks()
    {
        return $this->hasManyThrough(
            'App\Models\Artwork',
            'App\Models\ArtworkMovement',
            'movement_uuid',
            'uuid',
            'uuid',
            'artwork_uuid',
        );
    }

    /**
     * Get all the objects for a specific artist.
     */
    public function hasInspired()
    {
        return $this->hasManyThrough(
            'App\Models\Artist',
            'App\Models\ArtistMovement',
            'movement_uuid',
            'uuid',
            'uuid',
            'artist_uuid'
        );
    }
}
