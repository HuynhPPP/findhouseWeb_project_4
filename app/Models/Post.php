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

    protected $fillable = [
        'user_id',     
        'category_id',
        'title',
        'post_slug',
        'description',
        'price',
        'area',
        'address',
        'province',
        'district',
        'ward',
        'street',
        'house_number',
        'name_poster',
        'email_poster',
        'phone_poster',
        'features',
    ];

    public function category()
    {
        return $this->belongsTo(Category :: class, 'category_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id', 'id');
    }

    public function videos()
    {
        return $this->hasOne(Video::class, 'post_id', 'id');
    }
}
