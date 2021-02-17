@auth
  <div class="alert alert-primary" id='mensage'>
    <ul>
      @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif
      <li>{{ __('You are logged in!') }}</li>
    </ul>
  </div>

@endauth
@if (isset($message))
  <div class="alert alert-success">
    <ul>
      <li>{{$message}}</li>
    </ul>
  </div>
@endif


<section class="section-ppal pb-5" id="nosotros" name="nosotros"><!--Section Nosotros-->
  <div class="box"><h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn">{{ __('Searching hostal') }}</h1></div>
  <p class="text-justify mx-2 my-2">{{__('Do you know what differentiates us from the rest of the great community of hostels that exist in Trinidad? Surely you will think that there we go with new old women that everyone says')}} &#128545;!
    {{__('Well no, let me tell you in a few lines what we believe in a lot that differentiates us from the rest. First of all, we charge a price very similar to the rest, with the difference that in many cases we put an added value that can range from a simple')}} <mark>{{__('BREAKFAST')}}</mark> {{ __('included up to a') }} <mark>{{ __('TOUR') }}</mark> {{ __('through the main places of our city,') }}, <mark>{{ __('ALL FOR THE SAME VALUE') }}</mark>.
    {{__('In addition, among our offers we want to include')}} <mark>{{__('THE EXCHANGE, yes, you have read very well, we know that we find ourselves in very difficult situations in the world economy, and ')}} <mark>{{ __('WHAT BETTER') }}</mark> {{ __('than being able to obtain accommodation thanks to the exchange of objects that you no longer use, it is They find it in good condition and it is difficult for us to obtain someone like us in our markets, although it also happens that they can bring us what costs us in our country 3 times the value that you in yours, such as personal hygiene, food, etc. . Let us do one thing then, I invite you to that if any of these offers interest you') }}
    <mark><a href="#contacto" class="text-dark">{{ __('CONTACT US') }}</a></mark> {{ __('for more information and / or keep visiting our website periodically where we will put the current offers according to the special dates of our house, although you can also') }} <a href="#suscripcion" class="text-dark">{{ __('SUBSCRIBE') }}</a>
     {{ __('to be able to receive our latest news and offers first-hand, especially if you already have a future travel date to our country, and if you found this website by chance and') }} <mark>{{ __('YOU DID NOT THINK TO VISIT TRINIDAD') }}</mark> {{ __('i invite you to read') }} <mark>{{ __('REASONS TO VISIT THE ISLAND MUSEUM OF THE CARIBBEAN') }}</mark>, {{ __('you will see that if it did not have it in its destinations, it will include it of all. He saw that in a few lines I managed to catch his attention (At least I hope so') }} &#128591;)!! {{ __('Don not forget the') }} <mark><a href="#suscripcion" class="text-dark">{{__('SUBSCRIPTION')}}</a></mark>.</p>
<div class="clearfix"></div>
<div class="row pb-5 pt-5">
  <div id="fac_plac" class="panel panel-primary col-xs-12 col-md-6 animate__animated animate__slideInLeft">
    <div class="bg-primary rounded container pt-2"><img src="/images/img/facilidades.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2"><h3 class="text-center text-uppercase text-light">{{ __('Facilities') }}</h3></div>
  <section class="border border-primary rounded">
    @for ($i=0; $i < count($hostal[0]->facilities); $i++)
      <p class="mr-2 h6 font-weight-bold text-center"><i class="fas fa-asterisk pl-2"></i> {{$hostal[0]->facilities[$i]->name}} |
        @if ($hostal[0]->facilities[$i]->pivot->price===0.00)
          {{ __('Incluid') }}
          @else
          {{$hostal[0]->facilities[$i]->pivot->price}} {{ __('Price') }} USD
        @endif
        | {{$hostal[0]->facilities[$i]->description}}

      </p><br>
    @endfor
  </section>
  </div>
  <div id="plac_fac" class="panel panel-primary col-xs-12 col-md-6 animate__animated animate__slideInRight">
    <div class="bg-primary rounded container pt-2"><img src="/images/img/Lugares.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2"><h3 class="text-center text-uppercase text-light">{{ __('CLose Places') }}</h3></div>
  <section class="border border-primary rounded">
    @for ($i=0; $i < count($hostal[0]->closePlaces); $i++)
      <p class="mr-2 h6 font-weight-bold text-center"><i class="fas fa-asterisk pl-2"></i> {{$hostal[0]->closePlaces[$i]->name}} | {{$hostal[0]->closePlaces[$i]->pivot->distance_km}} {{ __('Distance') }} Km</p><br>
    @endfor

  </section>
  </div>
</div>
</section><!--END Section Nosotros-->
<div class="row" id="galeria" name="galeria"><!--Section Galeria-->
<section class="galeria pt-5">
  <h1 id="galer" class="text-center text-uppercase text-light pt-5 animate__animated animate__slideInRight">{{ __('Know our places') }}</h1>


    <div class="gallery-container">
      @if (count($hostal->pictures)>6)
        @for ($i=0; $i < 6; $i++)
      <div class="gallery-card">
        <a href="{!! asset('/storage/hostales/'.$hostal[0]->slug.'/'.$hostal->pictures[$i]->area_picture.'/'.$hostal->pictures[$i]->img_url) !!}" data-lightbox="roadtrip">
          <img src="{!! asset('/storage/hostales/'.$hostal[0]->slug.'/'.$hostal->pictures[$i]->area_picture.'/'.$hostal->pictures[$i]->img_url) !!}" alt="">
        </a>
      </div>
  @endfor
  @else
    @for ($i=0; $i < count($hostal->pictures); $i++)
  <div class="gallery-card">
    <a href="{!! asset('/storage/hostales/'.$hostal[0]->slug.'/'.$hostal->pictures[$i]->area_picture.'/'.$hostal->pictures[$i]->img_url) !!}" data-lightbox="roadtrip">
      <img src="{!! asset('/storage/hostales/'.$hostal[0]->slug.'/'.$hostal->pictures[$i]->area_picture.'/'.$hostal->pictures[$i]->img_url) !!}" alt="">
    </a>
  </div>
  @endfor
@endif


  </br>
</br>
    <div class="">
      <a href="{{route('gallery',['hostal'=>$hostal[0]->slug])}}" class="btn w-20 rounded btn-warning btn-lg mt-5 text-dark">{{__('More Pictures')}}</a>
    </div>
  </div>
</section>
</div><!--END Section Galeria-->
<div class="row pb-5" id="servicios" name="servicios"><!--Section Servicios-->
<section class="container services pb-5 pt-5">
<h1 id="services" class="col-xs-12 text-center text-uppercase pt-5 px-2 animate__animated animate__bounceIn">{{ __('Services') }}</h1>
<div class="clearfix"></div>
<div class="row">
<div id="alimen" class="panel panel-primary col-xs-12 col-md-6 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/cenas.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">{{ __('Foods') }}</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">{{ __('Our house offers you quality services with fresh and totally natural products.') }}</p></section>
</div>
<div id="excurs" class="panel panel-primary col-xs-12 col-md-6 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/excursiones.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">{{ __('Excursions') }}</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">{{ __('We provide you with several excursions, from included in your reservation price to others with an additional price, in different languages where you will know various attractions of the city.') }}</p></section>
</div>
<div id="transp" class="panel panel-primary col-xs-12 col-md-12 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/transporte.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">{{ __('Transportation') }}</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">{{ __('Wherever you plan to go, we can help you manage your transfer from low prices to more specialized prices depending on the comfort and safety with which you like to travel.') }}</p></section>
</div>
</div>
</section>
</div><!--END Section Servicios-->
<!--SECTION TESTIMONIOS-->
<comentario-hostal-component>
</comentario-hostal-component>
<!--Fin SECTION TESTIMONIOS-->
@if ( isset($posts) && $posts>0)
<section class="container-fluid col-12 pt-5" id="blog" name="blog"><h1 id="post" class="text-center pb-2 pt-5 text-uppercase animate__animated animate__zoomIn">{{ __('Posts') }}</h1><!--Section Blog-->
  <post-ppal-tab-component>
  </post-ppal-tab-component>

</section><!--END Section Blog-->
@endif
<section class="mb-5 mt-5 pt-5 pb-5" id="contacto" name="contacto"><!--Section Contacto-->
  <div class="text-center container" id="containermap">
    <div id="map-mirak">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3704.5133468314734!2d-79.98591988563838!3d21.79908798558619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f2ae45daa922d5f%3A0x26f3b3fd9ea784e7!2sHostal%20MIRAKURU%20Gran%20Familia!5e0!3m2!1ses!2scu!4v1598546597306!5m2!1ses!2scu" width="1200" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <div id="form-contact" class="container">
      <div class="row align-items-center">
        <div class="col d-block w-30"></div>
        <div class="col w-30"><img src="/images/img/contact1.png" alt="" type="button" class="btn bg-danger rounded-circle px-5 py-5 wow animate__animated animate__heartBeat animate__infinite" @click="ventanaContact = true"></div>
        <div class="col d-block w-40"></div>
      </div>
    </div>
  </div>
  <contacto-hostal-component hostal_id="{{$hostal[0]->id}}" v-if="ventanaContact" @close="ventanaContact = false">
  </contacto-hostal-component>
</section><!--END Section Contacto-->
@include('forms.loginForm')
@include('forms.registerForm')
@include('forms.resetEmailForm')
<section class="mt-5 pt-5" id="suscripcion" name="suscripcion"><!--Section Newsletter-->
      <newsletter-component locale="{{ App::getLocale() }}"></newsletter-component>
</section><!--END Section Newsletter-->
@auth
    <section id="reserva" name="reserva" class="mt-5 pt-5 bg-primary pb-5 mb-5"><!--Section Reserva-->
<reservar-hostal-component hostal_id="{{$hostal[0]->id}}" email="{{Auth::user()->email}}" locale="{{ App::getLocale() }}"></reservar-hostal-component>
</section><!--END Section Reserva-->
@endauth
