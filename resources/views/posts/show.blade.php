@extends('layouts.app')
@section('head')
  @include('posts.subview.head')
@stop
@section('sidebar')
  @include('posts.subview.navbar')
@stop
@section('content')
  <div class="row">
  <aside class="col-1">
  <cont-view-share-like-component model="post" url_post="{{url('/welcome/'.$post->id)}}" id_post="{{$post->id}}" title="{{$post->title}}" cant_read="{{$post->cant_access_read}}" cant_shares="{{$post->cant_shares}}" cant_likes="{{$post->cant_likes}}">
  </cont-view-share-like-component>


  </aside>

  <div class="card align-content-center col-8 ml-2">
    <div class="box">
      @if (isset($preview))
      <div class="alert alert-primary" id='mensage'>
        <ul>
              <div class="alert alert-success font-weight-bold" role="alert">
                  {{ __('You are in Preview Post, the navbar no function, this is only for check how look before publish it') }}
              </div>

          <a type="button" href="/posts" class="btn btn-primary">{{ __('Back Dashboard') }}</a>
        </ul>
      </div>
@endif

    <h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn card-title">{{$post->title}}</h1>
  </div>
    <p class="text-justify mx-2 my-2">{!!$post->content!!}</p>
      <div class="box"> <h3 class="text-center">{{ __('Find us with QR') }}:</h3> <img src="{{ asset('/storage/qrcodes/posts/'.$post->qr_img_url) }}" title="Qr: {{$post->title}} Post" class="img-fluid mx-auto d-block mt-5">
  </div>
  <section class="card-footer mt-3">

    <div class="card">
      <div class="card-body">
        <relationed-tags-component id_post="{{$post->id}}">
        </relationed-tags-component>
      </div>


    </div>
  </section>
  <aside class="col-3 pl-3">
    <div class="position-fixed">
      <div class="">
        <h1>Anuncios</h1>
      </div>

      </div>


  </aside>

  </div>
   @endsection
