<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function article_images()
    {
        return $this->hasMany(Article_Image::class,'article_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id')->withTimestamps();
    }

    public function users() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function comments() {
        return $this->hasMany(Comment::class,'article_id');
    }
}
