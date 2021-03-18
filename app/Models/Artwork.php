<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Artwork extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artworks';
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
        'department_uuid',
        'artist_uuid',
        'navigart_id',
        'object_inventory',
        'object_title',
        'object_date',
        'object_type',
        'object_technique',
        'object_height',
        'object_width',
        'object_depth',
        'object_weight',
        'object_copyright',
        'object_visibility',
        'acquisition_type',
        'acquisition_date',
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
        'department_uuid' => 'uuid',
        'artist_uuid' => 'uuid',
        'art_movement' => 'uuid',
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
     * Get all the artists for a specific artwork.
     */
    public function hasArtists()
    {
        return $this->hasMany(
            'App\Models\Artist',
            'uuid',
            'artist_uuid'
        );
    }

    /**
     * Get all the objects for a specific artist.
     */
    public function acquiredBy()
    {
        return $this->hasOne(
            'App\Models\Acquisition',
            'uuid',
            'acquisition_uuid'
        );
    }

    /**
     * Get the department for a specific artwork.
     */
    public function inDepartement()
    {
        return $this->hasOne(
            'App\Models\Department',
            'uuid',
            'department_uuid'
        );
    }

    /**
     * Get all the art movements for a specific artwork.
     */
    public function inMovements()
    {
        return $this->hasManyThrough(
            'App\Models\Movement',
            'App\Models\ArtworkMovement',
            'artwork_uuid',
            'uuid',
            'uuid',
            'movement_uuid'
        );
    }
}
