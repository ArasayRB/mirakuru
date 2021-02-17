
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <link rel="stylesheet" href="{{ asset('css/welcome.min.css') }}">
    <!--Tags Style-->
    <link href="{{ asset('vendor/css/tagsstyle.css') }}" rel="stylesheet">
  </head>
@show
  <body class="bg-light">
<div id="app">
<div id="container-fluid" class="container-fluid col-12 pb-5">
  <div  id="home" name="home">
    <div class="col-12">

        <main>
            @yield('content')
        </main>
      </div>
    </div>
   </div>
        <div class="container-fluid col-12 pt-5">
          <div class="clearfix"></div>
          <div class="col-12 row">
           <footer class="foot pt-5">
             <div class="col-xs-12">
               <img src="{{ asset('images/img/logomirakurublue.png') }}" class="mx-auto d-block">
             </div>
             <div class="text-center">
               <img src="{{ asset('images/img/ico-facebook.png') }}" class="mx-2 my-2 img-foot">
               <img src="{{ asset('images/img/ico-instagram.png') }}" class="mx-2 my-2 img-foot">
               <img src="{{ asset('images/img/ico-twitter.png') }}" class="mx-2 my-2 img-foot">
             </div>

        <h6 class="text-center text-primary font-weight-bold"> {{ config('app.name') }}.</h6>
        <h6 class="text-center font-weight-bold">&copy; {{ date('Y') }} . @lang('All rights reserved.')</h6>
           </footer>
          </div>
        </div>
        </div>


           </body>
           <!--JS-->
           <script src="{{ asset('vendor/lightbox2-dev/js/lightbox-plus-jquery.min.js') }}"></script><!--Galeria JS-->
           <script src="{{ asset('vendor/lightbox2-dev/js/lightbox.min.js') }}"></script><!--END Galeria JS-->
           <script src="{{ asset('js/mirakuru.min.js') }}"></script><!--Mirakuru JS-->

           <script type="text/javascript">
             window.CSRF_TOKEN = '{{ csrf_token() }}';
             @auth
                window.Permissions = {!! json_encode(Auth::user()->permissions, true) !!};
                window.UserId = {!! json_encode(Auth::user(), true) !!};
             @else
                window.Permissions = [];
                window.UserId =[];
             @endauth
           </script>
         </html>
