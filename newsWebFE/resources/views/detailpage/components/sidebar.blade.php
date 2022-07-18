<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Tìm kiếm</div>
        <div class="card-body">
            <form action="">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Tìm kiếm chủ đề ... "
                           id="article-search" />
                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                </div>

                <div id="resultList">

                </div>
            </form>
        </div>
    </div>

    <!-- Categories widget-->
    <div class="card-body-sidebar">
        <div class="card-header">Tin có liên quan </div>
        <div class="row">
            @php
                if($category_parent_id->parent_id !== 0){
                    $articleCategoryParent = App\Models\Article::where('category_id',$category_parent_id->parent_id)->where('deleted_at',null)->limit(3)->get();
                }else{
                    $articleCategoryParent = App\Models\Article::where('category_id',$category_parent_id->id)->where('id','<>',$article->id)->where('deleted_at',null)->limit(3)->get();
                }    
            @endphp
            @if($articleCategoryParent->count() !== 0)
                @foreach($articleCategoryParent as $articleCategoryParentItem)
                    <div class="card-body-sidebar">
                            @foreach($articleCategoryParentItem->article_images as $articleCategoryParentImageItem)
                                <a href="{{ route('articlecontroller.show',['id'=>$articleCategoryParentItem->id]) }}">
                                    <img class="img-fluid rounded"
                                    src="{{ $baseUrl. $articleCategoryParentImageItem->image_path }}"
                                    alt="..."/>
                                </a>
                            @endforeach
                            <h6 class="card-title h5">
                                <a href="{{ route('articlecontroller.show',['id'=>$articleCategoryParentItem->id]) }}" style="color: #000">
                                    {{ $articleCategoryParentItem->title }}
                                </a>
                            </h6>
                        <p class="card-text">{{$articleCategoryParentItem->shortdesc}}</p>
                        <div id="line-separate"></div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-6">
                    <img src="{{ asset('HomePage/assets/404.png') }}" alt="" style="height: 235px">
                </div>
            @endif
        </div>
    </div>
</div>
