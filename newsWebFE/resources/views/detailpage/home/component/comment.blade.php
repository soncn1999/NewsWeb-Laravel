<section class="mb-5">
    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            @if (Route::has('login'))
                @auth
                    <form class="mb-4">
                        @csrf
                        <label for=""><h5>Bình luận <a href="">(@.{{ Auth::user()->name }})</a></h5></label>
                        <textarea class="form-control contents"
                                  name="contents"
                                  rows="3">
                        </textarea>
                        <button type="submit"
                                class="btn btn-success mt-2 send-comment">Gửi bình luận
                        </button>
                    </form>
                @else
                    <label for="" class="mb-3"><h5>Bạn phải đăng nhập để bình luận nội dung này!</h5></label>
                @endauth
            @endif
            {{-- Show Comment--}}
            <form>
                @csrf
                <input type="hidden"
                       name="comment_article_id"
                       class="comment_article_id"
                       value="{{ $article->id }}">
                <div id="comment_show">

                </div>
            </form>
        </div>
    </div>
</section>
