
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
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!--Tags Style-->
    <link href="{{ asset('vendor/css/tagsstyle.css') }}" rel="stylesheet">
  </head>
@show
  <body class="bg-light">
<div id="app">
<div id="container-fluid" class="container-fluid col-12 pb-5">
  <div  id="home" name="home">
    <div class="col-12">
      @section('sidebar')
    <header>
      <img src="{{ asset('images/img/topeheader.jpg') }}" class="img-fluid mx-auto d-block">
    </header>
    <div class="sticky-top">
    <nav class="navbar navbar-expand-md bg-primary navbar-dark">
  <a href="{!! route('hostal',$hostal[0]->slug) !!}/" class="navbar-brand"><img src="/images/img/favicon_white.ico" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="uno">
       <ul class="navbar-nav">
        <li class="nav-item"><a href="#home" class="nav-link text-light">{{__('Home')}}</a></li>
        <li class="nav-item"><a href="#nosotros" class="nav-link text-light">{{__('About us')}}</a></li>
        <li class="nav-item"><a href="#servicios" class="nav-link text-light">{{__('Services')}}</a></li>
        <li class="nav-item" id="blog-menu"><a href="#blog" class="nav-link text-light">{{__('Blog')}}</a></li>
        <li class="nav-item"><a href="#galeria" class="nav-link text-light">{{__('Galery')}}</a></li>
        <li class="nav-item"><a href="#contacto" class="nav-link text-light">{{__('Contact')}}</a></li>

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
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ __('Books') }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#reserva">
                    {{ __('Reserve') }}
                </a>
                  <a class="dropdown-item" href="{{ route('active-books',['user_id'=>Auth::user()->id]) }}">
                      {{ __('Actives') }}
                  </a>

              </div>
          </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <a class="dropdown-item" href="{{ route('user-perfil') }}">
                    {{ __('Perfil') }}
                </a>
            </div>
        </li>

                        @cannot('client')
                            <li class="nav-item"><a href="/admin" class="nav-link text-light">{{__('Dashboard')}}</a></li>

                        @endcannot



        @endguest
        <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
      @if (config('locale.status') && count(config('locale.languages')) > 1)
                       <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle text-light"  id="dropdownMenuLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                           {{__('Languages')}}
                         </a>
                         <div class="dropdown-menu">
                           @foreach (array_keys(config('locale.languages')) as $lang)
                               @if ($lang != App::getLocale())
                                   <a class="dropdown-item" href="{!! route('language.select', $lang) !!}">
                                        <img src="{{ asset('images/lang/'.$lang.'.ico') }}"/>   {!! $lang !!}
                                   </a>
                               @endif
                           @endforeach
                         </div>
                       </li>
                @endif




        </div>
       </ul>
    </nav>
    @auth
    <msg-make-review-component>
    </msg-make-review-component>
    @endauth

    </div>
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
