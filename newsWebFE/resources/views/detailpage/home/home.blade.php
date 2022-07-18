@php
    //$baseUrl = config('app.base_url');
    $baseUrl = 'http://localhost:8081';
@endphp

@extends('detailpage.layouts.master')

@section('title')
    <title>{{ $article->title }}</title>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <div class="time-category" style="display: flex; justify-content: space-between">
                            <div>
                                @php 
                                    $articleCategory = $article->category()->where('id',$article->category_id)->get();
                                @endphp
                                <span><a href="http://localhost:8000">KMA News</a> / 
                                    @foreach($articleCategory as $articleCategoryItem)
                                        <a href="{{ route('categorycontroller.show',['id'=>$articleCategoryItem->id]) }}">{{ $articleCategoryItem->name }}</a> 
                                    @endforeach
                                </span>
                            </div>
                            <div class="text-muted fst-italic mb-2">Đăng tải ngày: {{ $article->created_at }}</div>
                        </div>

                        <h1 class="fw-bolder mb-1">{{ $article->title }}</h1>
                    </header>

                    <figure class="mb-5">
                        @foreach($article->article_images as $articleImageItem)
                            <img class="img-fluid rounded re_size_detail"
                                 src="{{ $baseUrl. $articleImageItem->image_path }}"
                                 alt="..."/>
                            <p class="picture_desc">{{ $articleImageItem ->desc }}</p>
                        @endforeach
                    </figure>

                    <section class="mb-5">
                        {!! $article->content !!}
                    </section>

                    <div class="mb-5 article_author">
                        <h5>{{ $article->users->name }}</h5>
                    </div>
                    <h5>Tin có liên quan</h5>&nbsp;
                    <div class="mb-3">
                        @foreach($article_expansion as $articleExpansionItem)
                            <a href="{{ route('articlecontroller.show',['id' => $articleExpansionItem->id]) }}"> <h6>{{ $articleExpansionItem->title }}</h6> </a> <br />
                        @endforeach
                    </div>
                    <div class="mb-5">
                        Từ khóa tìm kiếm:
                        @foreach($article->tags as $tagItem)
                                <a class="badge bg-info text-decoration-none link-light mt-3"
                                href="{{ route('tagcontroller.show',['id'=>$tagItem->id]) }}">{{ $tagItem->name }}</a>
                        @endforeach
                    </div>
                </article>
                @include('detailpage.home.component.comment')
            </div>
            @include('detailpage.components.sidebar')
        </div>
    </div>
@endsection


