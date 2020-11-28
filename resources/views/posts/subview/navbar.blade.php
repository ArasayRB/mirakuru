<header>
  <img src="{{ asset('/storage/img_web/posts_img/'.$post->img_url) }}" class="img-fluid mx-auto d-block">
</header>
<nav class="navbar sticky-top navbar-expand-md bg-primary navbar-dark">
<a href="#" class="navbar-brand"><img src="/images/img/favicon_white.ico" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="uno">
   <ul class="navbar-nav">
    <li class="nav-item"><a href="/#home" class="nav-link text-light">{{__('Home')}}</a></li>
    <li class="nav-item"><a href="/#nosotros" class="nav-link text-light">{{__('About us')}}</a></li>
    <li class="nav-item"><a href="/#servicios" class="nav-link text-light">{{__('Services')}}</a></li>
    <li class="nav-item"><a href="/#blog" class="nav-link text-light">{{__('Blog')}}</a></li>
    <li class="nav-item"><a href="/#galeria" class="nav-link text-light">{{__('Galery')}}</a></li>
    <li class="nav-item"><a href="/#contacto" class="nav-link text-light">{{__('Contact')}}</a></li>

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
    <li class="nav-item"><a href="#reserva" class="nav-link text-light">{{__('Book')}}</a></li>

      <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-light" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{__('Logout')}} {{ Auth::user()->name }}</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @if ((Auth::user()->hasRole('admin')==true)||(Auth::user()->hasRole('review-content')==true)||(Auth::user()->hasRole('writer-content')==true)||(Auth::user()->hasRole('public-content')==true))
                        <li class="nav-item"><a href="/admin" class="nav-link text-light">{{__('Dashboard')}}</a></li>

                    @endif



    @endguest
    <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
  @if (config('locale.status') && count(config('locale.languages')) > 1)
                <ul class="navbar-nav ml-auto">
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
                 </ul>
            @endif




    </div>
   </ul>
</nav>
