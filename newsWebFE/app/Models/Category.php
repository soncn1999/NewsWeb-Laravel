<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public function article () {
        return $this ->hasMany(Article::class,'category_id');
    }

    public function categoryChildrent() {
        return $this->hasMany(Category::class,'parent_id');
    }
}
