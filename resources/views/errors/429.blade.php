@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))@section('code')
<div class="error" data-text="429">
  429
</div>
@endsection
@section('image')
<div style="background-image: url('/images/errors/500.png');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('message', __('Too Many Requests'))
