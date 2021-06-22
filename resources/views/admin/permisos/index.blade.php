@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-permiso-component locale="{{ App::getLocale() }}">

      </index-permiso-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
@section('scripts')
  @parent
@include('admin.subviews.scripts')
@endsection
