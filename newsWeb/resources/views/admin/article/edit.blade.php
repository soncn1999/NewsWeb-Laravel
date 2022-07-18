@extends('layouts.admin')

@section('title')
    <title>Edit Article</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/article/add/add.css') }}" rel="stylesheet"/>
@endsection



@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'article', 'key' => 'Edit'])
        <form action="{{ route('article.update', ['id' => $article->id]) }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">

                            @csrf
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       placeholder="Article Title"
                                       value="{{ $article->title }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Short Description: </label>
                                <input type="text"
                                       class="form-control"
                                       name="shortdesc"
                                       placeholder="Article Short Description"
                                       value="{{ $article->shortdesc }}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Thumbnail: </label>
                                <input type="file"
                                       class="form-control-file"
                                       name="thumbnail"
                                >
                                <div class="col-md-4 img_thumbnail_container">
                                    <div class="row">
                                        <img class="img_thumbnail" src="{{ $article->thumbnail }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Detail Image: </label>
                                <input type="file"
                                       multiple
                                       class="form-control-file"
                                       name="image_path[]"
                                >
                                <div class="col-md-12 container_image_detail">
                                    <div class="row">
                                        @foreach($article->article_image as $articleImageItem)
                                            <div class="col-md-3">
                                                <img class="img_detail_article"
                                                     src="{{ $articleImageItem->image_path }}" alt="">
                                            </div>
                                            <div class="col-md-3">
                                                <p>{{ $articleImageItem->desc }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Picture Detail Description: </label>
                                <input type="text"
                                       class="form-control @error('desc') is-invalid @enderror"
                                       name="desc"
                                       placeholder="Picture Detail Description"
                                >
                            </div>


                            <div class="form-group">
                                <label>Category: </label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Category</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tags: </label>
                                <select name="tags[]" class="form-control tags_select2_choose" multiple="multiple">
                                    @foreach($article->tags as $tagItem )
                                        <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content: </label>
                                <textarea name="contents" class="form-control tinymce_editor_init"
                                          rows="8">{{ $article->content }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('admins/article/add/add.js') }}"></script>

@endsection
