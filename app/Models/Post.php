<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'features' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }

    public function videos()
    {
        return $this->hasOne(Video::class, 'post_id');
    }
}
