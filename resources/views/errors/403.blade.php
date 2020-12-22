@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))@section('code')
<div class="error" data-text="403">
  403
</div>
@endsection
@section('image')
<div style="background-image: url('/images/errors/401.png');" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))
