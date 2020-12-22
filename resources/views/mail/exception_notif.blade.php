<?php
$action = (\Route::getCurrentRoute()) ? \Route::getCurrentRoute()->getActionName() : "n/a";
$path = (\Route::getCurrentRoute()) ? \Route::getCurrentRoute()->getPath() : "n/a";
$user = (\Auth::check()) ? \Auth::user()->name : 'no login';
?>
@extends('layouts.mail')
@section('content')
  <div class="card bg-light">
  <section class="section-ppal pb-5" id="nosotros" name="nosotros"><!--Section Nosotros-->
    <div class="box">
      <div class="card-header">
        <h1 id="us_ttle" class="text-uppercase text-center pt-2 animate__animated animate__zoomIn">There was an error in your Laravel App <mark class="text-primary">user</mark>!</h1></div>
      </div>

   <div class="card-body">
     <table border="1" width="100%">
       <tr><th >User:</th><td>{{ $user }}</td></tr>
       <tr><th >Message:</th><td>{{ $e['message'] }}</td></tr>
       <tr><th >Action:</th><td>{{ $action }}</td></tr>
       <tr><th >URI:</th><td>{{ $path }}</td></tr>
       <tr><th >Line:</th><td>{{ $e['line'] }}</td></tr>
       <tr><th >Code:</th><td>{{ $e['code'] }}</td></tr>
   </table>

  </section><!--END Section Nosotros-->
  </div>
  <div class="card-footer bg-info">
  <section class="bg-info">
    <div class="row justify-content-center">
      <div class="col-6">
      <p class="text-center text-light">Hostal Mirakuru Gran Familia <br></p>
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
