@extends('layouts.mail')
@section('content')
  <div class="card bg-light">
  <section class="section-ppal pb-5" id="nosotros" name="nosotros"><!--Section Nosotros-->
    <div class="box">
      <div class="card-header">
        <h1 id="us_ttle" class="text-uppercase text-center pt-2 animate__animated animate__zoomIn">Bienvenido <mark class="text-primary">user</mark>!</h1></div>
      </div>

   <div class="card-body">
    <p class="text-justify mx-2 my-2">Le agradecemos su registro en nuestra web. Por favor verifique su dirección email a través del link que le dejamos a continuación </p><br>
      <div class="row justify-content-center"><button class="btn btn-primary btn-center"><a href="#" class="text-light">Confirmo mi cuenta</a></button> <br></div>
      <p class="mt-3 text-justify mx-2 my-2">Por favor, note que las cuentas no verificadas son eliminadas automáticamente luego de 30 días de su registro. </p><br>

      <p class="mt-3 text-justify mx-2 my-2">Si no desea responder a esta notificación, por favo ignore este email.</p>

  </section><!--END Section Nosotros-->
  </div>
  <div class="card-footer bg-info">
  <section class="bg-info">
    <div class="row justify-content-center">
      <div class="col-6">
      <p class="text-center text-light">Con cariño, Hostal mIrakuru Gran Familia <br></p>
      <div class="text-center">
        <img src="images/img/ico-facebook.png" class="mx-2 my-2 img-foot">
        <img src="images/img/ico-instagram.png" class="mx-2 my-2 img-foot">
        <img src="images/img/ico-twitter.png" class="mx-2 my-2 img-foot">
      </div>
      </div>
      <div class="col-6">
        <p class="text-center text-light">Camilo Cienfuegos #180 A entre José Martí y Miguel Calzada, Trinidad, Sancti Spíritus, Cuba. CP: 62600 </p>
      </div>
    </div>
  </section>
  </div>
  </div>
   @endsection
