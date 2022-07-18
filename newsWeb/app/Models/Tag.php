<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Tag extends Model
{
    protected $guarded = [];

    public function articles() {
        return $this->belongsToMany(Article::class,'article_tags','tag_id','article_id');
    }
}
