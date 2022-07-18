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

    <div class="card mb-4">
        <div class="card-header">Tìm kiếm nhanh theo tags</div>
        <div class="card-body-resize">
            <div class="row">
                <div class="tag-list">
                    @foreach($tags as $tag)
                        <a href="{{ route('tagcontroller.show',['id' => $tag->id]) }}" class="btn btn-info mt-2">{{ $tag->name }}</a> &nbsp;
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @foreach($category_sidebars as $categorySidebarItem)
        <div class="card mb-4">
            <div class="card-header category-sidebar-container">
                <div class="category-sidebar-header">
                    <a href="{{ route('categorycontroller.show',['id'=>$categorySidebarItem->id]) }}" class=""><h5>{{ $categorySidebarItem->name }}</h5></a>
                </div>
                <ul class="category-sidebar-list">
                    @php
                        $categoryChidrent = $categorySidebarItem->categoryChildrent()->get();
                        $category_id = $categorySidebarItem->id;
                    @endphp
                    @foreach($categoryChidrent as $categoryChidrentItem)
                    <li class="category-sidebar-item">
                        <a href="{{ route('categorycontroller.show',['id'=>$categoryChidrentItem->id]) }}">{{ $categoryChidrentItem->name }}</a>&nbsp; <span class="category-sidebar-item-separate">|</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body-sidebar">
                <div class="row">
                    @php
                        $articleSidebar = App\Models\Article::where('category_id',$categorySidebarItem->id)->where('deleted_at',null)->limit(2)->get();
                    @endphp
                    @if($articleSidebar->count() !== 0)
                        @foreach($articleSidebar as $articleSidebarItem)
                            <div class="card-body-sidebar">
                                <h6 class="card-title h5">
                                    <a href="{{ route('articlecontroller.show',['id'=>$articleSidebarItem->id]) }}" style="color: #000">
                                        {{ $articleSidebarItem->title }}
                                    </a>
                                </h6>
                                <p class="card-text">{{$articleSidebarItem->shortdesc}}</p>
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
    @endforeach
</div>
