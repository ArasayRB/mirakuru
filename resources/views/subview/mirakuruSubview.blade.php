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
  <div class="box"><h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn">En busca de un hostal</h1></div>
  <p class="text-justify mx-2 my-2">Sabe qué nos diferencia del resto de la gran comunidad de hostales que existen en Trinidad? Seguro pensarás que allá vamos con nuevas viejas que todos dicen &#128545;!
    Pues no, déjeme decirle en pocas líneas lo que creemos con mucho aínco que nos diferencia del resto. Primero que todo, cobramos un precio muy similar al resto, con la diferencia
    que en muchos casos le ponemos un valor añadido que puede ir desde un <mark>DESAYUNO</mark> sencillo incluido hasta un <mark>TOUR</mark> por los principales lugares de nuestra ciudad, <mark>TODO POR UN MISMO VALOR</mark>.
    Además entre nuestras ofertas queremos incluir <mark>EL INTERCAMBIO, sí, has leído muy bien, sabemos que nos encontramos en situaciones muy difíciles de la economía mundial, y <mark>QUÉ MEJOR</mark> que
    poder obtener hospedaje gracias al intercambio de objetos al cual no le das ya uso, se encuentran en buen estado y a alguien como nosotros se nos hace difícil obtener en nuestros mercados,
   aunque también sucede que puedan traernos lo que a nosotros en nuestro país nos cuesta 3 veces el valor que a ustedes en el suyo como son aseo personal, alimentos, etc. Hagamos una cosa
   entonces, le invito a que si alguna de estas ofertas le interesa nos <mark><a href="#contacto" class="text-dark">CONTACTE</a></mark> para más información y/o se mantenga visitando periódicamente nuestra web donde pondremos las ofertas vigentes según las fechas especiales de nuestra
   casa, aunque también puede <a href="#suscripcion" class="text-dark">SUSCRIBIRSE</a> para poder recibir nuestras últimas noticias y ofertas de primera mano, sobre todo si ya tiene una fecha a futuro de viaje a nuestro país, y si encontró
   esta web por casualidad y <mark>NO PENSABA VISITAR TRINIDAD</mark> le invito a que lea <mark>RAZONES PARA VISITAR LA ISLA MUSEO DEL CARIBE</mark>, verá que si no lo tenía dentro de sus destinos, lo incluirá de todas todas.
   Vió que en pocas líneas logré atrapar su atención (Al menos eso espero &#128591;)!! No olvide la <mark><a href="#suscripcion" class="text-dark">SUSCRIPCIÓN</a></mark>.</p>
<div class="clearfix"></div>
<div class="row pb-5 pt-5">
  <div id="fac_plac" class="panel panel-primary col-xs-12 col-md-6 animate__animated animate__slideInLeft">
    <div class="bg-primary rounded container pt-2"><img src="/images/img/facilidades.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2"><h3 class="text-center text-uppercase text-light">Facilidades</h3></div>
  <section class="border border-primary rounded"><p>Facilities</p></section>
  </div>
  <div id="plac_fac" class="panel panel-primary col-xs-12 col-md-6 animate__animated animate__slideInRight">
    <div class="bg-primary rounded container pt-2"><img src="/images/img/Lugares.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2"><h3 class="text-center text-uppercase text-light">Lugares Cerca</h3></div>
  <section class="border border-primary rounded"><p>CLose Places</p></section>
  </div>
</div>
</section><!--END Section Nosotros-->
<div class="row" id="galeria" name="galeria"><!--Section Galeria-->
<section class="galeria pt-5">
  <h1 id="galer" class="text-center text-uppercase text-light pt-5 animate__animated animate__slideInRight">Conozca nuestros espacios</h1>
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
<h1 id="services" class="col-xs-12 text-center text-uppercase pt-5 px-2 animate__animated animate__bounceIn">Servicios</h1>
<div class="clearfix"></div>
<div class="row">
<div id="alimen" class="panel panel-primary col-xs-12 col-md-6 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/cenas.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">Alimentos</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">Nuestra casa pone a su disposición los servicios de cena y desayuno con productos frescos y totalmente naturales</p></section>
</div>
<div id="excurs" class="panel panel-primary col-xs-12 col-md-6 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/excursiones.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">Excursiones</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">Le proporcionamos a usted varias excursiones, desde incluidas en su precio de reserva hasta otras con precio adicional, en diferentes idiomas donde conocerán varios atractivos de la ciudad</p></section>
</div>
<div id="transp" class="panel panel-primary col-xs-12 col-md-12 col-lg-4 h-500px pb-5">
  <div class="bg-primary rounded container pt-2 pb-2">
    <img src="/images/img/transporte.png" alt="" class="rounded-circle bg-light mx-auto d-block py-2 px-2">
    <h3 class="text-center text-uppercase text-light">Transportación</h3>
  </div>
  <section class="border border-primary rounded h-100"><p class="pt-2 mx-2 my-2 text-justify">Donde quiera que usted piense ir nosotros podremos ayudar a gestionar su traslado desde precios económicos hasta precios más especializados dependiendo del confort y seguridad con el que guste viajar.</p></section>
</div>
</div>
</section>
</div><!--END Section Servicios-->
<div class="contenedor-testimonios"><!--SECTION TESTIMONIOS-->
  <div class="contenedor-slider-testimonios">
    <div class="testimonial-slider">
      <div class="slider-overflow"><h1 class="text-center text-light text-uppercase">Testimonios</h1>
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
<section class="container-fluid col-12 pt-5" id="blog" name="blog"><h1 id="post" class="text-center pb-2 pt-5 text-uppercase animate__animated animate__zoomIn">Posts</h1><!--Section Blog-->
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="/images/img/comentario01.jpg" class="mx-auto d-block rounded-circle w-200 h-300">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="/images/img/comentario02.jpg" class="mx-auto d-block rounded-circle w-200 h-300">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="/images/img/comentario03.jpg" class="mx-auto d-block rounded-circle w-200 h-300">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h3 class="mb-0">Post title</h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
           <img src="/images/img/comentario02.jpg" class="mx-auto d-block rounded-circle w-200 h-300">
        </div>
      </div>
    </div>
  </div>
</section><!--END Section Blog-->
<section class="mb-5" id="contacto" name="contacto"><!--Section Contacto-->
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
 <h4 class="modal-title">Contacto</h4>
 <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
 <div class="row justify-content-center">
   <div class="col-6">
 <form action="" class="">
     <input type="text" class="form-control font-italic mt-5" placeholder="Email...">
     <input type="text" class="form-control font-italic mt-2" placeholder="Nombre...">
     <textarea name="mensaje" class="form-control font-italic mt-2" id="" cols="33" rows="2" placeholder="Su mensaje..."></textarea>
    <button type="button" class="btn btn-primary rounded btn-lg mt-3">Enviar</button>
 </form>
 </div>
 <div class="col-6">
 <section class="info-contact">
   <div class="container mt-5">
       <div class="tel-fijo"><p><mark class="bg-dark text-light">Teléfono Fijo: <br></mark>+53-41993797</p></div>
       <div class="movil"><p><mark class="bg-dark text-light">Móvil Arasay: <br></mark>+53-53419001</p>
       <p><mark class="bg-dark text-light">Móvil Youblián: <br></mark>+53-52474269</p></div>
       <div class="email"> <p><mark class="bg-dark text-light">Email: <br></mark>hostalgranfamilia@gmail.com</p></div>
       <div class="direc"><p><mark class="bg-dark text-light">Dirección: <br></mark>Camilo Cienfuegos #180A entre José Martí y Miguel Calzada. Trinidad, Sancti Spíritus, Cuba. CP-62600</p></div>
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
