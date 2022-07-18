@extends('layouts.admin')

@section('title')
    <title>Add Article</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/article/add/add.css') }}" rel="stylesheet"/>
@endsection



@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'article', 'key' => 'Add'])
        <div class="col-md-12">
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
        <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">

                            @csrf
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       name="title"
                                       placeholder="Article Title"
                                       value="{{ old('title') }}"
                                >
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Short Description: </label>
                                <input type="text"
                                       class="form-control @error('shortdesc') is-invalid @enderror"
                                       name="shortdesc"
                                       placeholder="Article Short Description"
                                       value="{{ old('shortdesc') }}"
                                >
                                @error('shortdesc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Thumbnail: </label>
                                <input type="file"
                                       class="form-control-file"
                                       name="thumbnail"
                                >
                                @error('thumbnail')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
{{--                            Add to Article_Images--}}
                            <div class="form-group">
                                <label>Image Detail: </label>
                                <input type="file"
                                       multiple
                                       class="form-control-file mb-2 preview_image_detail"
                                       name="image_path[]"
                                >
                                <div class="row image_detail_wrapper">

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Picture Detail Description: </label>
                                <input type="text"
                                       class="form-control @error('desc') is-invalid @enderror"
                                       name="desc"
                                       placeholder="Picture Detail Description"
                                       value="{{ old('desc') }}"
                                >
                            </div>
{{--                            Add to Article_Images--}}
                            <div class="form-group">
                                <label>Select Category: </label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    <option value=""></option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                @php
                                    $tagHinds = \App\Models\Tag::all();
                                @endphp
                                <label>Add Tags: </label>
                                <select name="tags[]"
                                        class="form-control tags_select2_choose"
                                        multiple="multiple">
                                        @foreach($tagHinds as $tagHindItem)
                                            <option value="{{ $tagHindItem->name }}">{{ $tagHindItem->name }}</option>
                                        @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content: </label>
                                <textarea
                                    name="contents"
                                    class="@error('contents')
                                        is-invalid @enderror form-control tinymce_editor_init"
                                    rows="20">{{ old('contents') }}</textarea>
                                @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
