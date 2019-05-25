<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'imgUrl', 'category_id'];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
