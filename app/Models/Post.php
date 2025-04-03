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

    protected $guarded = [];

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

    public function savedPost()
    {
        return $this->hasMany(SavedPost::class, 'post_id');
    }

    public function isSavedByUser($user)
    {
        if (!$user) {
            return false; // Nếu không có user (chưa đăng nhập), trả về false
        }

        return $this->savedPost()->where('user_id', $user->id)->exists();
    }
}
