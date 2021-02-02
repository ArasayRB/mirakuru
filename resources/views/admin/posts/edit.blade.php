@extends('admin.layout.dashboard')
@section('head')
  @parent
  @include('admin.subviews.head')
@endsection
@section('dashboard')
<h1>Editar un Post/ Update a Post</h1>
@if ($errors->any())
  <div class="alert alert-danger" role="alert">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif
<form method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data"  data-ajax="false" class="mt-5">
  @method('PATCH')
  {{csrf_field()}}
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="form-group">
          <label for="title">Título/Title</label>
          <input type="text" name="title" class="form-control font-italic mb-2" placeholder="Título/Title..." value="{{$post->title}}">
        </div>

        <div class="form-group">

          <label for="image">Selecciona Imagen/ Select Image</label>
        <input type="file" name="image" class="form-control-file font-italic mb-2" value="{{$post->imge}}" placeholder="Imagen/Image...">
        <div class="row">
          <img src="{{asset('storage/img_web/posts_img/'.$post->img_url)}}" alt="{{$post->img_url}}" width="100">
        </div>
        </div>
        <div class="form-group">
          <label for="category">Categoría/Category</label>
          <select class="form-control" name="category" placeholder="Categoría/Category..." required value="{{$post->categoriaPosts->category_post}}">
           <option value={{$post->category_id}}>{{$post->categoriaPosts->category_post}}</option>
           @foreach ($categories as $categorie)
             @if ($categorie->id!=$post->category_id)
               <option value={{$categorie->id}}>{{$categorie->category_post}}</option>
             @endif

           @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="check-edit-summary">Resumen/Summary</label>
          <textarea name="check-edit-summary" id="check-edit-summary" cols="10" rows="8" class="form-control font-italic mb-2" placeholder="Resumen/Summary...">{{$post->summary}}</textarea>
        </div>
        <div class="form-group">
          <label for="check-edit-content">Contenido/Content</label>
          <textarea name="check-edit-content" id="check-edit-content" cols="33" rows="8" class="form-control font-italic mb-2" placeholder="Contenido/Content...">{{$post->content}}</textarea>
        </div>


      </div>
      <div class="col-2 ">
        <div class="content-justify-center"><button type="submit" value="submit" class="btn w-20 rounded btn-primary btn-lg mt-5 reserva">Actualizar/ Update</button></div>
      </div>
    </div>
  </div>
</form>
@endsection
@section('scripts')
  @parent
@include('admin.subviews.scripts')
@endsection
