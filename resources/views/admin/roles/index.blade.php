@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-role-component locale="{{ App::getLocale() }}">

      </index-role-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
@section('scripts')
  @parent
@include('admin.subviews.scripts')
@endsection
