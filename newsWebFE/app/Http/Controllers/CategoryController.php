<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id){
        $categories = Category::all();
        $category_search = Category::find($id);
        $articles = $category_search->article()->where('deleted_at',null)->paginate();
        $category_menu = Category::where('parent_id',0)->get();
        $tags = Tag::latest()->limit(5)->get();
        $category_sidebars = Category::where('id','>',13)->where('parent_id',0)->limit(3)->get();
        return view('homepage.home.home',compact('articles','categories','category_search','category_menu','tags','category_sidebars'));
    }
}
