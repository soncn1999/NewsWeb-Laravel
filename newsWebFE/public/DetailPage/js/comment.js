$(document).ready(function () {
    loadComment();

    function loadComment() {
        var article_id = $('.comment_article_id').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "/load_comment",
            method: "POST",
            data: {article_id: article_id, _token: _token},
            success: function (data) {
                $('#comment_show').html(data);
            }
        });
    }

    $('.send-comment').click(function (event) {
        event.preventDefault();
        var article_id = $('.comment_article_id').val();
        var contents = $('.contents').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "/send_comment",
            method: "POST",
            data: {article_id: article_id, contents: contents, _token: _token},
            success: function (data) {
                loadComment();
            }
        });
    });
});
