@extends('layouts.app')
@section('head')
  <head>
    <link  rel="icon"   href="{{ asset('images/img/favicon.ico') }}" type="image/ico" />
    <!--Required Meta taggs-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />

    <!--Author-->
    <meta name="author" content="ARBASTAPP" />

    <!--Description app-->
    <meta name="description" content="{{__('The MIRAKURU Gran Familia Hostal is part of the cultural patrimony of the Trinidad city in Cuba')}}" />

    <meta name="generator" content="Laravel 8.0" />

    <meta name="keywords" content="hostal en Trinidad, hostal mirakuru gran familia, cuba, turismo" />

    <!--App name-->
    <meta name="application-name" content="{{ config('app.name') }}" />
    <title>{{ config('app.name', 'Hostal MIRAKURU Gran Familia') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie-edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--CSS-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/fontawesome.min.css') }}"><!--Galeria CSS Page-->
    <link rel="stylesheet" href="{{ asset('vendor/lightbox2-dev/css/lightbox.min.css') }}"><!--Galeria CSS Page-->
    <link rel="stylesheet" href="{{ asset('vendor/css/animate.min.css') }}"><!--Animate CSS Page-->
    <link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
    <!--Tags Style-->
    <link href="{{ asset('vendor/css/tagsstyle.css') }}" rel="stylesheet">
  </head>
@endsection
@section('sidebar')  
    @include('subview.navbar')
@endsection
@section('content')
   @include('subview.galeria')
   @endsection
