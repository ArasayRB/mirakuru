@extends('layouts.app')
@section('sidebar')
  @include('subview.navbar')
@stop
@section('content')

    <reservado-hostal-component ruta="{{route('active-books-list',['user_id'=>Auth::user()->id])}}" email="{{Auth::user()->email}}" locale="{{ App::getLocale() }}">
    </reservado-hostal-component>


  @endsection
