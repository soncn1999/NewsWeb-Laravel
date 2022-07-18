<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        //List Bai viet + menu The loai + tag tim kiem
        $articles = Article::where('category_id','<',17)->where('deleted_at',null)->latest()->paginate(10);
        $category_menu = Category::where('parent_id', 0)->limit(10)->get();
        $tags = Tag::where('id','<',10)->limit(8)->get();
        //List sidebar: Kinh doanh, giai tri
        $category_sidebars = Category::where('id','>',13)->where('parent_id',0)->limit(3)->get();
        return view('homepage.home.home', compact('articles', 'category_menu', 'tags','category_sidebars'));
    }

    public function getDetail($id)
    {
        $article = Article::find($id);
        $category_menu = Category::where('parent_id', 0)->get();
        $article_expansion = Article::where('category_id', $article->category_id)->where('id', '<>', $id)->where('deleted_at',null)->paginate(2);
        $category_parent_id = $article->category()->find($article->category_id);
        $tags = Tag::latest()->limit(10)->get();
        return view('detailpage.home.home', compact('article', 'category_menu', 'article_expansion', 'tags','category_parent_id'));
    }

    public function sendComment(Request $request)
    {
        $article_id = $request->article_id;
        $name = Auth::user()->name;
        $contents = $request->contents;
        $comment = Comment::create([
            'article_id' => $article_id,
            'name' => $name,
            'content' => $contents,
        ]);
    }

    public function loadComment(Request $request)
    {
        $article_id = $request->article_id;
        $comments = Comment::where('article_id', $article_id)->get();
        $output = '';
        foreach ($comments as $key => $comment) {
            $output .= '
                 <div class="d-flex">
                     <div class="flex-shrink-0">
                         <i class="fas fa-user-circle" style="font-size: 30px"></i>
                     </div>
                     <div class="ms-3">
                         <div class="fw-bold">' . $comment->name . '</div>
                            ' . $comment->content . '
                     </div>
                 </div> <br /> ';
        }
        echo $output;
    }

    public function getSearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Article::where('title','LIKE',"%{$query}%")->get();
            $output = "<ul class='dropdown' style='display: block; position: relative; list-style-type: none; padding-left: 0'>";
            foreach ($data as $row) {
                $output .= '
               <li class="mt-2"><a href="http://localhost:8000/show/' . $row->id . '"> <h6>' . $row->title . '</h6></a></li>
               ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
