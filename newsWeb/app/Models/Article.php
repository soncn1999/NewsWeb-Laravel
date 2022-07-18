<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    use SoftDeletes;
    //
    protected $guarded = []; //all field accepted insert to DB

    public function category() {
        return $this -> belongsTo(Category::class,'category_id');
    }

    public function article_image() {
        return $this->hasMany(Article_Image::class, 'article_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'article_tag','article_id','tag_id')->withTimestamps();
    }
}
