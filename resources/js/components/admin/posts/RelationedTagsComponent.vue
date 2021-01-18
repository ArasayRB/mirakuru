<template>
<div class="">
  <h3 class="text-uppercase text-center">Tags</h3>
  <p class="text-center"><span class="badge badge-pill badge-primary ml-2" v-for="tag in tags">{{tag.name}}</span></p>

  <div class="tab-pane fade show active mt-5" id="nav-readed" role="tabpanel" aria-labelledby="nav-readed-tab">
    <h3 class="text-uppercase text-center">Relationed Posts</h3>
     <div class="pt-5 mt-3" v-for="pot in relationed_posts">
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


</div>

</template>

<script>
    export default {
      data(){
        return {
          post_id:this.$attrs.id_post,
          tags:[],
          relationed_posts:[],
          hreff:'/post-list/',
          src:'/storage/img_web/posts_img/',
          token   : window.CSRF_TOKEN,

        }
      },
      created: function () {
         axios.get('/relationed-post/'+this.post_id)
              .then(response =>{
                this.tags = response.data.tags;
                this.relationed_posts=response.data.relationed_posts;
                console.log(this.relationed_posts);
                if (response.data==''){
                  this.mensage=this.$trans('messages.None Post added yet');
                }
              });
         },
        mounted() {

        }
    }
</script>
