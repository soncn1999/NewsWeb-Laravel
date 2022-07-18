<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($id) {
        $categories = Category::all();
        $category_menu = Category::where('parent_id',0)->get();
        $tags = Tag::latest()->limit(5)->get();
        $tag_search = Tag::find($id);
        $articles = $tag_search->articles()->where('deleted_at',null)->paginate();
        $category_sidebars = Category::where('id','>',13)->where('parent_id',0)->limit(3)->get();
        return view('homepage.home.home',compact('articles','tags','tag_search','categories','category_menu','category_sidebars'));
    }
}
