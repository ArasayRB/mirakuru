@extends('errors::illustrated-layout')

@section('title', __('Not Found'))@section('code')
<div class="error" data-text="404">
  404
</div>
@endsection
@section('image')
<div style="background-image: url('/images/errors/404.png');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('message', __('Not Found'))
