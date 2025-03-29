<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  protected $guarded = [];
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }
  public function images()
  {
    return $this->hasMany(Image::class, 'post_id', 'id');
  }
  public function firstImage()
  {
    return $this->hasOne(Image::class, 'post_id')->oldest();
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
  protected $casts = [
    'features' => 'array',
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
}
