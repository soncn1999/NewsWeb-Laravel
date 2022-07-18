<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">KMA News</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (Route::has('login'))
                    <li class="top-right links" style="display: flex">
                        @auth
                            <div class="nav-item"><a class="nav-link active" href="">Xin chào! {{ Auth::user()->name }}
                                    .</a></div>

                            <div class="nav-item"><a class="nav-link active btn btn-secondary" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất</a></div>
                            @php
                                $user = \App\User::find(Auth::user()->id);
                            @endphp
                            @if($user->isAdmin == 1)
                                <div class="nav-item ml-3">
                                    <a class="nav-link active btn btn-success"
                                                              href="{{ url($baseUrl.'/login') }}">
                                        <i class="fas fa-user-shield"></i>
                                        Trang quản trị
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="nav-item"><a class="nav-link active btn btn-danger" aria-current="page"
                                                     href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập</a></div>

                            @if (Route::has('register'))
                                <div class="nav-item"><a class="nav-link active btn" aria-current="page"
                                                         href="{{ route('register') }}">Đăng Kí</a></div>
                            @endif
                        @endauth
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<header class="py-5s bg-light border-bottom mb-4 re_size">
    <div class="container">
        <div class="header-navbar">
            <ul id="nav">
                @foreach($category_menu as $categoryMenuItem)
                    <li>
                        <a href="{{ route('categorycontroller.show',['id'=>$categoryMenuItem->id]) }}">{{ $categoryMenuItem->name }}</a>
                        <ul class="subnav">
                            @foreach($categoryMenuItem->categoryChildrent as $categoryChildrentItem)
                                <li><a href="{{ route('categorycontroller.show',['id'=>$categoryChildrentItem->id]) }}">{{ $categoryChildrentItem->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        @if(isset($category_search))
            <div class="category-result">
                <h4>Bài viết chủ đề: "{{ $category_search->name }}"</h4>
            </div>
        @endif

        @if(isset($tag_search))
            <div class="category-result">
                <h4>Bài viết có dán nhãn: "{{ $tag_search->name }}"</h4>
            </div>
        @endif
    </div>
</header>
