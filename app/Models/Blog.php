<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
   protected $fillable = [

      'title',
      'slug',
      'image',
      'content',
      'meta_title',
      'meta_description',
      'meta_keywords',
      'status'
   ];

   protected $casts = [
   'status' => 'boolean'
   ];

}