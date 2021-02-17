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
    <div class="card-header">
      <h1 class="text-center text-dark text-uppercase pt-3">{{$noticia[0]->title}}</h1>

    </div>
    <div class="card-body h-5 w-5">

      <img src="{{ asset('storage/img_web/news_img/'.$noticia[0]->img_url.'') }}" class="img-fluid w-50 h-50 mx-auto d-block rounded-circle">
      <p>{{$noticia[0]->noticia}}</p>
    </div>
    <div class="card-footer">
      <h3 class="card-title text-dark text-uppercase text-center">{{$hostal}}</h3>
    </div>
  </div>

  </div>
  @endsection
