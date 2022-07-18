@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/article/index/list.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection
@section('header')
    @include('partials.header')
@endsection


@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'article', 'key' => 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('article.create') }}" class="btn btn-success float-right m-2">Add New
                            Article</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Short Description</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($articles as $article)
                                <tr>
                                    <th scope="row">{{ $article->id  }}</th>
                                    <td style="width: 400px">{{ $article->title }}</td>
                                    <td style="width: 500px">{{ $article->shortdesc }}</td>
                                    <td>
                                        <img class="article_image_150_100" src= {{ $article->thumbnail }}  alt="">
                                    </td>
                                    <td>{{ optional($article->category)->name }}</td>
                                    <td>
                                        <a href="{{ route('article.edit', ['id' => $article->id]) }}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{ route('article.delete', ['id' => $article->id]) }}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12" style="display: flex; justify-content: space-between">
                        <div class="pagination">
                            {{ $articles->appends($_GET)->links() }}
                        </div>
                        <div class="restore-btn">
                            <a href="{{ route('article.restore') }}"
                               class="btn btn-danger mr-5">
                                <i class="far fa-trash-alt"></i>
                                &nbsp;
                                Recycle Bin
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

