<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'post_id',
        'user_id',
        'status',
    ];
}
