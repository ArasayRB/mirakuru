
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <link  rel="icon"   href="{{ asset('images/img/favicon.ico') }}" type="image/ico" />
    <!--Required Meta taggs-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hostal MIRAKURU Gran Familia') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie-edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('vendor/css/fontawesome.min.css') }}"><!--Galeria CSS Page-->
    <link rel="stylesheet" href="{{ asset('vendor/lightbox2-dev/css/lightbox.min.css') }}"><!--Galeria CSS Page-->
    <link rel="stylesheet" href="{{ asset('vendor/css/animate.min.css') }}"><!--Animate CSS Page-->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
  </head>
  <body class="bg-light">
<div id="app">
<div id="container-fluid" class="container-fluid col-12 pb-5">
  <div class="row" id="home" name="home">
    <div class="col-12">
      @section('sidebar')
    <header>
      <img src="{{ asset('images/img/topeheader.jpg') }}" class="img-fluid mx-auto d-block">
    </header>
    <nav class="navbar sticky-top navbar-expand-md bg-primary navbar-dark">
  <a href="#" class="navbar-brand"><img src="/images/img/favicon_white.ico" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="uno">
       <ul class="navbar-nav">
        <li class="nav-item"><a href="#home" class="nav-link text-light">Home</a></li>
        <li class="nav-item"><a href="#nosotros" class="nav-link text-light">Nosotros</a></li>
        <li class="nav-item"><a href="#servicios" class="nav-link text-light">Servicios</a></li>
        <li class="nav-item"><a href="#blog" class="nav-link text-light">Blog</a></li>
        <li class="nav-item"><a href="#galeria" class="nav-link text-light">Galeria</a></li>
        <li class="nav-item"><a href="#contacto" class="nav-link text-light">Contacto</a></li>

        @guest
            <li class="nav-item">
                <a class="nav-link text-light" href="#" id="show-modal" @click="ventanaLogin = true">{{ __('Login') }}</a>
            </li>


            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-light" href="#" id="show-register-modal" @click="ventanaRegister = true">{{ __('Register') }}</a>
                </li>

            @endif
        @else
        <li class="nav-item"><a href="#reserva" class="nav-link text-light">Reserva</a></li>

          <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-light" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout {{ Auth::user()->name }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @if ((Auth::user()->hasRole('admin')==true)||(Auth::user()->hasRole('review-content')==true)||(Auth::user()->hasRole('writer-content')==true)||(Auth::user()->hasRole('public-content')==true))
                            <li class="nav-item"><a href="/admin" class="nav-link text-light">Dashboard</a></li>

                        @endif



        @endguest
        <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
      @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <ul class="navbar-nav ml-auto">
                       <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle text-light"  id="dropdownMenuLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                           {{__('Language')}}
                         </a>
                         <div class="dropdown-menu">
                           @foreach (array_keys(config('locale.languages')) as $lang)
                               @if ($lang != App::getLocale())
                                   <a class="dropdown-item" href="{!! route('language.select', $lang) !!}">
                                           {!! $lang !!} <small>{!! $lang !!}</small>
                                   </a>
                               @endif
                           @endforeach
                         </div>
                       </li>
                     </ul>
                @endif




        </div>
       </ul>
    </nav>
  @show
   <div class="clearfix"></div>

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

        <h6 class="text-center text-primary font-weight-bold"> Hostal MIRAKURU Gran Familia.</h6>
        <h6 class="text-center font-weight-bold">&copy; {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</h6>
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
           </script>
         </html>
