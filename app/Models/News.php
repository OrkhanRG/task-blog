<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'tags',
        'short_description',
        'description',
        'status',
        'image',
        'publish_date',
    ];

    public function getUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function getCategory(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
