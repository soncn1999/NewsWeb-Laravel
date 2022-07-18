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
        @include('partials.content-header', ['name' => 'recycle', 'key' => 'Article'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($message))
                            <div class="alert alert-warning" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Short Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($articles as $article)
                                <tr>
                                    <th scope="row">{{ $article->id  }}</th>
                                    <td style="width: 500px">{{ $article->title }}</td>
                                    <td style="width: 600px">{{ $article->shortdesc }}</td>
                                    <td>
                                        <a href="{{ route('article.restoreArticle', ['id' => $article->id]) }}"
                                           class="btn btn-info mt-2">
                                            <i class="fas fa-redo"></i>
                                            &nbsp;
                                            Restore
                                        </a>
                                        <a href="{{ route('article.forceDelete', ['id' => $article->id]) }}"
                                           class="btn btn-danger mt-2">
                                            <i class="fas fa-trash"></i>
                                            &nbsp;
                                            Permanent Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $articles->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

