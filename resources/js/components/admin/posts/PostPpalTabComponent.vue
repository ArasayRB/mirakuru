<template>
<div class="">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-readed-tab" data-toggle="tab" href="#nav-readed" role="tab" aria-controls="nav-readed" aria-selected="true"><strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.The most readed') }}</strong></a>
      <a class="nav-item nav-link" id="nav-liked-tab" data-toggle="tab" href="#nav-liked" role="tab" aria-controls="nav-liked" aria-selected="false"><strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.The most liked') }}</strong></a>
      <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-last" aria-selected="false"><strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.The latest posts') }}</strong></a>
      <a class="nav-item nav-link" id="nav-all-posts-tab" data-toggle="tab" href="#nav-all-posts" role="tab" aria-controls="nav-all-posts" aria-selected="false"><strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.All Posts') }}</strong></a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-readed" role="tabpanel" aria-labelledby="nav-readed-tab">
      <div class="pt-5 mt-3" v-for="pot in posts_read">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col-auto d-none d-lg-block w-25 h-25">
            <img :src="src+pot.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
          </div>
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{pot.users.name}}</strong>
            <strong class="d-inline-block mb-2 text-primary"><i title="Reads/ Lecturas" class="fa fa-eye"></i> {{pot.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{pot.cant_likes}}</strong>
            <h3 class="mb-0">{{pot.title}}</h3>
            <div class="mb-1 text-muted">{{pot.created_at}}</div>
            <p class="card-text mb-auto">{{pot.summary}}</p>
            <a :href="hreff+pot.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>

           </div>

        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-liked" role="tabpanel" aria-labelledby="nav-liked-tab">
      <div class="pt-5 mt-3" v-for="pot in posts_liked">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col-auto d-none d-lg-block w-25 h-25">
            <img :src="src+pot.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
          </div>
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{pot.users.name}}</strong>
            <strong class="d-inline-block mb-2 text-primary"><i title="Reads/ Lecturas" class="fa fa-eye"></i> {{pot.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{pot.cant_likes}}</strong>
            <h3 class="mb-0">{{pot.title}}</h3>
            <div class="mb-1 text-muted">{{pot.created_at}}</div>
            <p class="card-text mb-auto">{{pot.summary}}</p>
            <a :href="hreff+pot.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>

           </div>

        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-last" role="tabpanel" aria-labelledby="nav-last-tab">
      <div class="pt-5 mt-3" v-for="pot_lat in posts_last">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col-auto d-none d-lg-block w-25 h-25">
            <img :src="src+pot_lat.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
          </div>
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{pot_lat.users.name}}</strong>
            <strong class="d-inline-block mb-2 text-primary"><i title="Reads/ Lecturas" class="fa fa-eye"></i> {{pot_lat.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{pot_lat.cant_likes}}</strong>
            <h3 class="mb-0">{{pot_lat.title}}</h3>
            <div class="mb-1 text-muted">{{pot_lat.created_at}}</div>
            <p class="card-text mb-auto">{{pot_lat.summary}}</p>
            <a :href="hreff+pot_lat.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>

           </div>

        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-all-posts" role="tabpanel" aria-labelledby="nav-all-posts-tab">
      <paginate class="pt-5 mt-3" ref="paginator" name = "posts_all" :list = "posts_all" :per = "3">
          <div v-for="post_all in paginated('posts_all')" :key="post_all.id" class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col-auto d-none d-lg-block w-25 h-25">
              <img :src="src+post_all.img_url" class="mx-auto d-block pt-2 rounded-circle w-100 h-1010">
            </div>
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary">{{ $trans('messages.Posted by: ') }}{{post_all.users.name}}</strong>
              <strong class="d-inline-block mb-2 text-primary"><i title="Reads/ Lecturas" class="fa fa-eye"></i> {{post_all.cant_access_read}} | <i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{post_all.cant_likes}}</strong>
              <h3 class="mb-0">{{post_all.title}}</h3>
              <div class="mb-1 text-muted">{{post_all.created_at}}</div>
              <p class="card-text mb-auto">{{post_all.summary}}</p>
              <a :href="hreff+post_all.id" class="stretched-link">{{ $trans('messages.Continue reading') }}</a>
             </div>

          </div>
          </paginate>
             <strong class="text-primary">
               <paginate-links for="posts_all" :show-step-links="true"></paginate-links>
               <paginate-links
              for="posts_all"
              :show-step-links="true"
              :simple="{
                  prev: $trans('messages.Previous'),
                  next: $trans('messages.Next')
              }"
             ></paginate-links>
           </strong>
    </div>
  </div>





</div>

</template>
<style>
  .paginate-links{
    width:100%;
    list-style: none;
    text-align: center;
}
.paginate-links li {
    display: inline;
    background-color:#1fa9ed;
    color:white;
    padding:0.5rem;
    margin-left:0.3rem;
    margin-right: 0.3rem;
    cursor:pointer;
    border-radius: 3px;
}
.paginate-result{
    width: 100%;
    text-align:center;
    margin-bottom: 1rem;
}
</style>
<script>
    export default {
      data(){
        return {
          pot:[],
          pot_lat:[],
          posts_liked:[],
          posts_read:[],
          posts_last:[],
          posts_all:[],
          paginate:['posts_all'],
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
                this.posts_all= response.data.posts;
                if (response.data==''){
                  this.mensage=this.$trans('messages.None Post added yet');
                }
              });
         },
        mounted() {

        }
    }
</script>
