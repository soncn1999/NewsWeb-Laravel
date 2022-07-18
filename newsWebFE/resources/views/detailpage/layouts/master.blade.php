<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    @yield('title')
    <link rel="icon" type="image/x-icon" href="{{ asset('DetailPage/assets/favicon.ico') }}"/>
    <link href="{{ asset('DetailPage/css/styles.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('DetailPage/css/Detail.css') }} ">
    <link rel="stylesheet" href="{{ asset('HomePage/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('DetailPage/plugin/fontawesome/css/all.min.css') }} ">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('DetailPage/js/comment.js') }}"></script>
    <script src="{{ asset('DetailPage/js/search.js') }}"></script>
</head>

<body>
<!-- Responsive navbar-->
@include('detailpage.components.header')
<!-- Page content-->
@yield('content')
<!-- Footer-->
@include('detailpage.components.footer')
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('DetailPage/js/scripts.js') }} "></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
</body>

</html>
