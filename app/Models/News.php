<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'tags',
        'short_description',
        'description',
        'status',
        'image',
        'publish_date',
    ];
}
