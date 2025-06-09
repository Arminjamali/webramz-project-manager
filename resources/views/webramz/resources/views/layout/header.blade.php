<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/boxicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="{{asset('js/font-awesome.min.js')}}"></script>
{{--    <script src="{{asset('js/feather.min.js')}}"></script>--}}
    @yield('link')

</head>
<body class="nav-fixed">

<div id="layoutSidenav">
    @include('layout.navbar')
    @include('layout.sidebar')
    <div id="layoutSidenav_content">
        <main class="is-rtl">

