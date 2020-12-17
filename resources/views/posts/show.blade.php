@extends('layouts.app')
@section('head')
  @include('posts.subview.head')
@stop
@section('sidebar')
  @include('posts.subview.navbar')
@stop
@section('content')
  <div class="row">
  <aside class="col-3 pl-3 sticky-left position-fixed">

      <h3 class="pl-3">Anuncios</h3>


  </aside>

  <div class="col-3">

  </div>

  <div class="card align-content-center col-6">
    <div class="box">

    <h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn">{{ __('Searching hostal') }}</h1>
  </div>
    <p class="text-justify mx-2 my-2">{!!$post->content!!}</p>
  </div>

  </div>
   @endsection
