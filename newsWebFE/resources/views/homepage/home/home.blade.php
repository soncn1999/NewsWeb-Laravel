@php
    //$baseUrl = config('app.base_url');
    $baseUrl = 'http://localhost:8081';
@endphp

@extends('homepage.layouts.master')

@section('title')
    <title>Home Page</title>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <div class="row">
                    @if($articles->count() !== 0)
                        <!--Old code-->
                        @foreach($articles as $article)
                            <div class="col-lg-12 mt-2" style="min-height: 200px">
                                <div class="mb-8" style="display: flex">
                                    <div class="card-image">
                                        <a href="{{ route('articlecontroller.show',['id'=>$article->id]) }}"><img
                                            class="card-img-top re_size_image"
                                            src="{{ $baseUrl . $article->thumbnail }}"
                                            alt="..."/></a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title h5">
                                            <a href="{{ route('articlecontroller.show',['id'=>$article->id]) }}" style="color: #000">
                                                {{ $article->title }}
                                            </a>
                                        </h5>
                                        <p class="card-text">{{$article->shortdesc}}</p>
                                        <div class="read-comment-item" style="display: flex; justify-content: space-between">
                                            <a class="btn btn-primary"
                                            href="{{ route('articlecontroller.show',['id'=>$article->id]) }}">Đọc ngay →</a>
                                            <div class="comment-item">
                                                @php
                                                    $comments = App\Models\Comment::where('article_id',$article->id)->get();
                                                @endphp
                                                @if($comments->count() !== 0)
                                                    <i class="far fa-comment"></i>
                                                    <span>{{ $comments->count() }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-separate"></div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <img src="{{ asset('HomePage/assets/404.png') }}" alt="" style="height: 500px">
                        </div>
                    @endif
                </div>

                <div class="row mt-5">
                    <div class="col-lg-8" style="margin: 0 auto">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
            <!-- Side widgets-->
            @include('homepage.components.sidebar')
        </div>
    </div>
@endsection


