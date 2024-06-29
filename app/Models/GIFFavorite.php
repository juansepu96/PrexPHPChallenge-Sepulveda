<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GIFFavorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'gif_id',
        'alias',
        'user_id',
    ];

    protected $table = 'favorite_gifs';

}
