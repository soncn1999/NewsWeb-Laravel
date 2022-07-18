<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    public function article () {
        return $this ->hasMany(Article::class,'category_id');
    }

    protected $fillable = ['name', 'parent_id','slug'];
}
