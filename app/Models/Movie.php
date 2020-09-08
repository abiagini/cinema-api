<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Movie extends Model
{
    public const TABLE = 'movies';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'description',
        'rating',
        'image_url'
    ];

    protected $casts = [
        'title'       => 'string',
        'description' => 'string',
        'rating'      => 'int',
        'image_url'   => 'string'
    ];
}
