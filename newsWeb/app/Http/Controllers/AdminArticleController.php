<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ArticleAddRequest;
use App\Models\Article_Image;
use App\Models\Article_Tag;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class AdminArticleController extends Controller
{
    use StorageImageTrait;

    private $category;
    private $article;
    private $tag;
    private $articleTag;
    private $articleImage;

    public function __construct(
        Category      $category,
        Article       $article,
        Article_Image $articleImage,
        Tag           $tag,
        Article_Tag   $articleTag)
    {
        $this->category = $category;
        $this->article = $article;
        $this->articleImage = $articleImage;
        $this->tag = $tag;
        $this->articleTag = $articleTag;
    }

    public function index()
    {
        $articles = $this->article->latest()->paginate(5);
        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.article.add', compact('htmlOption'));
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    public function store(ArticleAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataArticleCreate = [
                'title' => $request->title,
                'shortdesc' => $request->shortdesc,
                'content' => $request->contents,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
            ];
            $dataUploadThumbnail = $this->storageTraitUpload($request, 'thumbnail', 'article');
            if (!empty($dataUploadThumbnail)) {
                $dataArticleCreate['thumbnail_name'] = $dataUploadThumbnail['file_name'];
                $dataArticleCreate['thumbnail'] = $dataUploadThumbnail['file_path'];
            }
            $article = $this->article->create($dataArticleCreate);

            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataArticleImageDetail = $this->storageTraitUploadMultiple($fileItem, 'article');
                    $article->article_image()->create([
                        'image_path' => $dataArticleImageDetail['file_path'],
                        'image_name' => $dataArticleImageDetail['file_name'],
                        'desc' => $request->desc,
                    ]);
                }
            }

            //insert tags to article_tags
            foreach ($request->tags as $tagItem) {
                $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                $tagIds[] = $tagInstance->id;
            }
            $article->tags()->attach($tagIds);

            DB::commit();
            return redirect()->route('article.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . ' line' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $article = $this->article->find($id);
        $htmlOption = $this->getCategory($article->category_id);
        return view('admin.article.edit', compact('htmlOption', 'article'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataArticleUpdate = [
                'title' => $request->title,
                'shortdesc' => $request->shortdesc,
                'content' => $request->contents,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
            ];
            $dataUploadThumbnail = $this->storageTraitUpload($request, 'thumbnail', 'article');
            if (!empty($dataUploadThumbnail)) {
                $dataArticleUpdate['thumbnail_name'] = $dataUploadThumbnail['file_name'];
                $dataArticleUpdate['thumbnail'] = $dataUploadThumbnail['file_path'];
            }
            $this->article->find($id)->update($dataArticleUpdate);
            $article = $this->article->find($id);

            if ($request->hasFile('image_path')) {
                $this->articleImage->where('article_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataArticleImageDetail = $this->storageTraitUploadMultiple($fileItem, 'article');
                    $article->article_image()->create([
                        'image_path' => $dataArticleImageDetail['file_path'],
                        'image_name' => $dataArticleImageDetail['file_name'],
                        'desc' => $request->desc,
                    ]);
                }
            }

            //insert tags to article_tags
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $article->tags()->sync($tagIds);

            DB::commit();
            return redirect()->route('article.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . ' line' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        try {
            $this->article->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function restore() {
        $articles = DB::table('articles')->whereNotNull('deleted_at')->latest()->paginate(5);
        return view('admin.article.restore',compact('articles'));
    }

    public function forceDelete($id) {
        $article = DB::table('articles')->where('id',$id)->get();
        if(count($article) !== 0) {
            DB::table('articles')->where('id',$id)->delete();
            $message = 'Delete Success, Record is Permanently Deleted';
        } else {
            $message = "Delete Failed! Can't find any record suitable in DB!";
        }
        $articles = DB::table('articles')->whereNotNull('deleted_at')->latest()->paginate(5);
        return view('admin.article.restore', compact('articles','message'));
    }

    public function restoreArticle($id) {
        $article = DB::table('articles')->where('id',$id)->get();
        if(count($article) !== 0) {
            DB::table('articles')->where('id',$id)->update(['deleted_at' => null]);
            $message = 'Restore Success! Please return List Article to check the result.';
        } else {
            $message = "Restore Failed! Can't find any record suitable in DB!";
        }
        $articles = DB::table('articles')->whereNotNull('deleted_at')->latest()->paginate(5);
        return view('admin.article.restore', compact('articles','message'));
    }
}
