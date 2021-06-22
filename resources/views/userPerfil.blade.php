@extends('layouts.app')
@section('sidebar')
  @include('subview.navbar')
@stop
@section('content')
  <div class="row">
  <aside class="col-3 pl-3">
    <div class="position-fixed">

      <h3 class="pl-3">Anuncios</h3>

      </div>


  </aside>


  <div class="card align-content-center w-50 h-50 col-9">
    <div class="card-header bg-dark">
      <p class="text-center text-light pt-3">{{__('User')}}</p>

    </div>
    <div class="card-body h-5 w-5">

      <img src="{{ asset('storage/img_web/login_img/'.Auth::user()->imagen_url.'') }}" class="img-fluid w-50 h-50 mx-auto d-block rounded-circle">
    </div>
    <div class="card-footer bg-dark">
      <h3 class="card-title text-light text-center">{{Auth::user()->name}}</h3>
      <p class="text-center text-light pt-3">{{Auth::user()->email}}</p>
    </div>
  </div>

  </div>
  @endsection
