<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link  rel="icon"   href="{{ asset('images/img/favicon.ico') }}" type="image/ico" />
    <!--Required Meta taggs-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <title>{{ config('app.name', 'Hostal MIRAKURU Gran Familia') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--CSS-->
  	<link rel="stylesheet" href="{{ asset('css/all.css') }}">
  </head>
  <body class="bg-light">
<div id="container-fluid" class="container-fluid col-12 pb-5">
  <div class="row" id="home" name="home">
    <div class="col-12 bg-dark">
    <header>
      <img src="{{ asset('images/img/logomirakurublue.png') }}" class="img-fluid mx-auto d-block mt-5 pb-3">
    </header>

   <div class="clearfix"></div>

        <main>
            @yield('content')
        </main>
      </div>
    </div>
   </div>
   <!--JS-->
   <script src="{{ asset('js/mirakuru.min.js') }}"></script><!--Mirakuru JS-->
     </body>
   </html>
