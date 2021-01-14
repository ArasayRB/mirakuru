<template>
<div class="">
 <div v-if="post==='readed'">
  <div class="pt-5 mt-3" v-for="pot in posts_read">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col-auto d-none d-lg-block w-25 h-25">
        <img :src="src+pot.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
      </div>
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{pot.users.name}}</strong>
        <strong class="d-inline-block mb-2 text-primary"><i title="Show your love/ Muestra tu amor" class="fa fa-eye"></i> {{pot.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{pot.cant_likes}}</strong>
        <h3 class="mb-0">{{pot.title}}</h3>
        <div class="mb-1 text-muted">{{pot.created_at}}</div>
        <p class="card-text mb-auto">{{pot.summary}}</p>
        <a :href="hreff+pot.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>

       </div>

    </div>
  </div>

 </div>
 <div v-else="post==='liked'">
  <div class="pt-5 mt-3" v-for="pot in posts_liked">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col-auto d-none d-lg-block w-25 h-25">
        <img :src="src+pot.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
      </div>
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{pot.users.name}}</strong>
        <strong class="d-inline-block mb-2 text-primary"><i title="Show your love/ Muestra tu amor" class="fa fa-eye"></i> {{pot.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{pot.cant_likes}}</strong>
        <h3 class="mb-0">{{pot.title}}</h3>
        <div class="mb-1 text-muted">{{pot.created_at}}</div>
        <p class="card-text mb-auto">{{pot.summary}}</p>
        <a :href="hreff+pot.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>

       </div>

    </div>
  </div>

 </div>
 <div v-else="post==='latest'">
  <div class="pt-5 mt-3" v-for="pot_lat in posts_last">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col-auto d-none d-lg-block w-25 h-25">
        <img :src="src+pot_lat.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
      </div>
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{pot_lat.users.name}}</strong>
        <strong class="d-inline-block mb-2 text-primary"><i title="Show your love/ Muestra tu amor" class="fa fa-eye"></i> {{pot_lat.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{pot_lat.cant_likes}}</strong>
        <h3 class="mb-0">{{pot_lat.title}}</h3>
        <div class="mb-1 text-muted">{{pot_lat.created_at}}</div>
        <p class="card-text mb-auto">{{pot_lat.summary}}</p>
        <a :href="hreff+pot_lat.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>

       </div>

    </div>
  </div>

 </div>
</div>

</template>

<script>
    export default {
      data(){
        return {
          post:this.$attrs.post,
          pot:[],
          pot_lat:[],
          posts_liked:[],
          posts_read:[],
          posts_last:[],
          hreff:'/post-list/',
          src:'storage/img_web/posts_img/',
          token   : window.CSRF_TOKEN,

        }
      },
      created: function () {
         axios.get('/posts-list')
              .then(response =>{
                this.posts_liked = response.data.posts_more_liked;
                this.posts_read = response.data.posts_more_read;
                this.posts_last = response.data.latest_posts;
                if (response.data==''){
                  this.mensage=this.$trans('messages.None Post added yet');
                }
              });
         },
        mounted() {

        }
    }
</script>
