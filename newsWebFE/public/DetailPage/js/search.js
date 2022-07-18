$(document).ready(function(){
    $('#article-search').keyup(function(){
        var query = $(this).val();
        console.log(query);
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"/search_name",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#resultList').fadeIn();
                    $('#resultList').html(data);
                }
            });
        }
    });

    $(document).on('click', 'li', function(){
        $('#article-search').val($(this).text());
        $('#resultList').fadeOut();
    });

});
