<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'gallery_name',
        'gallery_type',
        'gallery_img',
        'user_id'
    ];
    protected $casts = [
        'gallery_img' => 'array',
    ];
}
