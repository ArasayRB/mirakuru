@extends('layouts.app')
@section('head')
  @include('posts.subview.head')
@stop
@section('sidebar')
  @include('subview.navbar')
@stop
@section('content')
  <div class="row">
  <aside class="col-1 pl-3 h-100">
  <cont-view-share-like-component model="post" url_post="{{url('/welcome/'.$post->id)}}" id_post="{{$post->id}}" title="{{$post->title}}" cant_read="{{$post->cant_access_read}}" cant_shares="{{$post->cant_shares}}" cant_likes="{{$post->cant_likes}}">
  </cont-view-share-like-component>


  </aside>

  <div class="card align-content-center col-8 ml-2">
    <div class="box"><img src="{{ asset('/storage/img_web/posts_img/'.$post->img_url) }}" title="Image: {{$post->title}}" class="img-fluid mx-auto d-block mt-5">


    <h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn">{{ __('Searching hostal') }}</h1>
  </div>
    <p class="text-justify mx-2 my-2">{!!$post->content!!}</p>
      <div class="box"><img src="{{ asset('/qrcodes/posts/'.$post->qr_img_url) }}" title="Qr: {{$post->title}} Post" class="img-fluid mx-auto d-block mt-5">
  </div>
  <aside class="col-3 pl-3">
    <div class="position-fixed">
      <div class="">
        <h1>Anuncios</h1>
      </div>

      </div>


  </aside>

  </div>
   @endsection
