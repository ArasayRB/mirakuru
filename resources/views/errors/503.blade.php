@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code')
<div class="error" data-text="503">
  503
</div>
@endsection
@section('image')
<div style="background-image: url('/images/errors/500.png');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('message', __('Service Unavailable'))
