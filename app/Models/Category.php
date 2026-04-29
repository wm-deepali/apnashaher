<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'tags',
        'is_popular',
        'status',
        'parent_id',
        'icons',
        'title',
        'short_description',
        'detail_content'
    ];

    public function institutes()
    {
        return $this->hasMany(Institute::class, 'category_id')->where('status', 'approved');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
