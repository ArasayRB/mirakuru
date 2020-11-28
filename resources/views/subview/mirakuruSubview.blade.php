@auth
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('Dashboard') }}</div>

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      {{ __('You are logged in!') }}
                  </div>
              </div>
          </div>
      </div>
  </div>
@endauth
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
  <section class="border border-primary rounded"><p>Facilities</p></section>
  </div>
  <div id="plac_fac" class="panel panel-primary col-xs-12 col-md-6 animate__animated animate__slideInRight">
    <div class="bg-primary rounded container pt-2"><img src="/images/img/Lugares.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2"><h3 class="text-center text-uppercase text-light">{{ __('CLose Places') }}</h3></div>
  <section class="border border-primary rounded"><p>CLose Places</p></section>
  </div>
</div>
</section><!--END Section Nosotros-->
<div class="row" id="galeria" name="galeria"><!--Section Galeria-->
<section class="galeria pt-5">
  <h1 id="galer" class="text-center text-uppercase text-light pt-5 animate__animated animate__slideInRight">{{ __('Know our places') }}</h1>
  <div class="gallery-container">
    <div class="gallery-card">
      <a href="/images/images_galery/Amanecer Terraza.jpg" data-lightbox="roadtrip">
        <img src="/images/images_galery/Amanecer Terraza.jpg" alt="">
      </a>
    </div>
    <div class="gallery-card">
      <a href="/images/images_galery/Frente New.jpg" data-lightbox="roadtrip">
        <img src="/images/images_galery/Frente New.jpg" alt="">
      </a>
    </div>
    <div class="gallery-card">
      <a href="/images/images_galery/Habitacion_Azul-1.jpg" data-lightbox="roadtrip">
        <img src="/images/images_galery/Habitacion_Azul-1.jpg" alt="">
      </a>
    </div>
    <div class="gallery-card">
      <a href="/images/images_galery/Habitacion_Azul-2.jpg" data-lightbox="roadtrip">
        <img src="/images/images_galery/Habitacion_Azul-2.jpg" alt="">
      </a>
    </div>
    <div class="gallery-card">
      <a href="/images/images_galery/Habitacion_Verde-1.jpg" data-lightbox="roadtrip">
        <img src="/images/images_galery/Habitacion_Verde-1.jpg" alt="">
      </a>
    </div>
    <div class="gallery-card">
      <a href="/images/images_galery/Terraza.jpg" data-lightbox="roadtrip">
        <img src="/images/images_galery/Terraza.jpg" alt="">
      </a>
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
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">Nuestra casa pone a su disposición los servicios de cena y desayuno con productos frescos y totalmente naturales</p></section>
</div>
<div id="excurs" class="panel panel-primary col-xs-12 col-md-6 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/excursiones.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">{{ __('Excursions') }}</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">Le proporcionamos a usted varias excursiones, desde incluidas en su precio de reserva hasta otras con precio adicional, en diferentes idiomas donde conocerán varios atractivos de la ciudad</p></section>
</div>
<div id="transp" class="panel panel-primary col-xs-12 col-md-12 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/transporte.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">{{ __('Transportation') }}</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">Donde quiera que usted piense ir nosotros podremos ayudar a gestionar su traslado desde precios económicos hasta precios más especializados dependiendo del confort y seguridad con el que guste viajar.</p></section>
</div>
</div>
</section>
</div><!--END Section Servicios-->
<div class="contenedor-testimonios"><!--SECTION TESTIMONIOS-->
  <div class="contenedor-slider-testimonios">
    <div class="testimonial-slider">
      <div class="slider-overflow"><h1 class="text-center text-light text-uppercase">{{ __('Testimonials') }}</h1>
        <div class="slider-carousel">
<div class="carousel slide" id="demo" data-ride="carousel">
  <!--Indicadores-->
  <ul class="carousel-indicators">
    <li data-target="demo" data-slide-to="0" class="active"></li>
    <li data-target="demo" data-slide-to="1" ></li>
    <li data-target="demo" data-slide-to="2" ></li>
  </ul>
  <!--Imagenes-->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <form class="text-center" id="form">
<p class="clasificacion">
<input id="radio1" type="radio" name="estrellas" value="5" disabled checked><!--
--><label for="radio1">★</label><!--
--><input id="radio2" type="radio" name="estrellas" value="4"><!--
--><label for="radio2">★</label><!--
--><input id="radio3" type="radio" name="estrellas" value="3"><!--
--><label for="radio3">★</label><!--
--><input id="radio4" type="radio" name="estrellas" value="2"><!--
--><label for="radio4">★</label><!--
--><input id="radio5" type="radio" name="estrellas" value="1"><!--
--><label for="radio5">★</label>
</p>
</form>
       <img src="/images/img/comentario01.jpg" class="rounded-circle mx-auto d-block img-fluid">
      <i class="fas fa-user"></i>
      <div class="block-quote">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi iusto iure laborum, incidunt reprehenderit recusandae cupiditate veritatis dolore delectus impedit, aspernatur sint dolor hic nisi suscipit! Maxime voluptate, cupiditate veniam.</p>
      </div>
      <div class="info">
        <div class="name">David</div>
        <div class="position">Cliente</div>
      </div>

    </div>
    <div class="carousel-item">
      <form class="text-center" id="form">
<p class="clasificacion">
<input id="radio6" type="radio" name="estrellas" value="5" disabled checked><!--
--><label for="radio6">★</label><!--
--><input id="radio7" type="radio" name="estrellas" value="4"><!--
--><label for="radio7">★</label><!--
--><input id="radio8" type="radio" name="estrellas" value="3"><!--
--><label for="radio8">★</label><!--
--><input id="radio9" type="radio" name="estrellas" value="2"><!--
--><label for="radio9">★</label><!--
--><input id="radio10" type="radio" name="estrellas" value="1"><!--
--><label for="radio10">★</label>
</p>
</form>
       <img src="/images/img/comentario02.jpg" class="rounded-circle mx-auto d-block img-fluid">
      <i class="fas fa-user"></i>
      <div class="block-quote">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi iusto iure laborum, incidunt reprehenderit recusandae cupiditate veritatis dolore delectus impedit, aspernatur sint dolor hic nisi suscipit! Maxime voluptate, cupiditate veniam.</p>
      </div>
      <div class="info">
        <div class="name">David</div>
        <div class="position">Cliente</div>
      </div>
    </div>
    <div class="carousel-item">
      <form class="text-center" id="form">
<p class="clasificacion">
<input id="radio11" type="radio" name="estrellas" value="5" disabled checked><!--
--><label for="radio11">★</label><!--
--><input id="radio12" type="radio" name="estrellas" value="4"><!--
--><label for="radio12">★</label><!--
--><input id="radio13" type="radio" name="estrellas" value="3"><!--
--><label for="radio13">★</label><!--
--><input id="radio14" type="radio" name="estrellas" value="2"><!--
--><label for="radio14">★</label><!--
--><input id="radio15" type="radio" name="estrellas" value="1"><!--
--><label for="radio15">★</label>
</p>
</form>
       <img src="/images/img/comentario03.jpg" class="rounded-circle mx-auto d-block img-fluid">
      <i class="fas fa-user"></i>
      <div class="block-quote">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi iusto iure laborum, incidunt reprehenderit recusandae cupiditate veritatis dolore delectus impedit, aspernatur sint dolor hic nisi suscipit! Maxime voluptate, cupiditate veniam.</p>
      </div>
      <div class="info">
        <div class="name">David</div>
        <div class="position">Cliente</div>
      </div>
    </div>
  </div>
  <!--Controladores izq derecha-->
  <a href="#demo" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
  <a href="#demo" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
</div>
</div>
</div>
</div>
</div>
</div><!--Fin SECTION TESTIMONIOS-->
<section class="container-fluid col-12 pt-5" id="blog" name="blog"><h1 id="post" class="text-center pb-2 pt-5 text-uppercase animate__animated animate__zoomIn">{{ __('Posts') }}</h1><!--Section Blog-->
  <div class="row mb-2">
    @if ($posts)
      @foreach ($posts ?? '' as $post)


      <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">{{__('Posted by: ')}}{{$post->users->name}}</strong>
            <h3 class="mb-0">{{$post->title}}</h3>
            <div class="mb-1 text-muted">{{$post->created_at}}</div>
            <p class="card-text mb-auto">{{$post->summary}}</p>
            <a href="/welcome/{{$post->id}}" class="stretched-link">{{__('Continue reading')}}</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="{{ asset('/storage/img_web/posts_img/'.$post->img_url) }}" class="mx-auto d-block rounded-circle w-200 h-300">
          </div>
        </div>
      </div>
      @endforeach
    @endif

  </div>
</section><!--END Section Blog-->

<section class="mb-5 mt-5 pt-5 pb-5" id="contacto" name="contacto"><!--Section Contacto-->
  <div class="text-center container" id="containermap">
    <div id="map-mirak">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3704.5133468314734!2d-79.98591988563838!3d21.79908798558619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f2ae45daa922d5f%3A0x26f3b3fd9ea784e7!2sHostal%20MIRAKURU%20Gran%20Familia!5e0!3m2!1ses!2scu!4v1598546597306!5m2!1ses!2scu" width="1200" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <div id="form-contact" class="container">
      <div class="row align-items-center">
        <div class="col d-block w-30"></div>
        <div class="col w-30"><img src="/images/img/contact1.png" alt="" type="button" class="btn bg-danger rounded-circle px-5 py-5 wow animate__animated animate__heartBeat animate__infinite" data-toggle="modal" data-target="#miModal"></div>
        <div class="col d-block w-40"></div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
 <h4 class="modal-title">{{ __('Contact') }}</h4>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
 <div class="row justify-content-center">
   <div class="col-6">
 <form action="" class="">
     <input type="text" class="form-control font-italic mt-5" placeholder="{{ __('Email') }}...">
     <input type="text" class="form-control font-italic mt-2" placeholder="{{ __('Name') }}...">
     <textarea name="mensaje" class="form-control font-italic mt-2" id="" cols="33" rows="2" placeholder="{{ __('Your message') }}..."></textarea>
    <button type="button" class="btn btn-primary rounded btn-lg mt-3">{{ __('Send') }}</button>
 </form>
 </div>
 <div class="col-6">
 <section class="info-contact">
   <div class="container mt-5">
       <div class="tel-fijo"><p><mark class="bg-dark text-light">{{ __('Landline') }}: <br></mark>+53-41993797</p></div>
       <div class="movil"><p><mark class="bg-dark text-light">{{ __('Mobile Phone') }} Arasay: <br></mark>+53-53419001</p>
       <p><mark class="bg-dark text-light">{{ __('Mobile Phone') }} Youblián: <br></mark>+53-52474269</p></div>
       <div class="email"> <p><mark class="bg-dark text-light">{{ __('Email') }}: <br></mark>hostalgranfamilia@gmail.com</p></div>
       <div class="direc"><p><mark class="bg-dark text-light">{{ __('Adress') }}: <br></mark>{{ __('At 180A Camilo Cienfuegos, between José Martí and Miguel Calzada street. Trinidad, Sancti Spíritus, Cuba. PC: 62600') }}</p></div>
     </div>
 </section>
 </div>
 </div>
</div>
</div>
</div>
</div>
</section><!--END Section Contacto-->
@include('forms.loginForm')
@include('forms.registerForm')
@include('forms.resetEmailForm')
<section class="mt-5 pt-5" id="suscripcion" name="suscripcion"><!--Section Newsletter-->
      <newsletter-component></newsletter-component>
</section><!--END Section Newsletter-->
@auth
    <section id="reserva" name="reserva" class="mt-5 pt-5 bg-primary pb-5 mb-5"><!--Section Reserva-->
<reservar-hostal-component></reservar-hostal-component>
</section><!--END Section Reserva-->
@endauth
