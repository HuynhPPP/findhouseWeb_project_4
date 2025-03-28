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
        'features',
        'video_url',
    ];

    public function getFullAddressAttribute()
    {
        $addressParts = array_filter([
            $this->house_number,
            $this->street,
            $this->ward,
            $this->district,
            $this->province
        ]);

        return implode(', ', $addressParts);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category :: class, 'category_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id', 'id');
    }
}
