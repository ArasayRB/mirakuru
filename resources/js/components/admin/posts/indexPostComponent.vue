<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Posts') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="ventanaCreatPost = true" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <add-post-form-component @postnew="addPostIndex" :locale="locale" v-if="ventanaCreatPost" @close="ventanaCreatPost = false">

    </add-post-form-component>
    <edit-post-form-component @postupd="updPostIndex" :locale="locale" :post="post" v-if="ventanaEditPost" @close="ventanaEditPost = false">

    </edit-post-form-component>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ $trans('messages.List') }}</h6>
    </div>
    <div class="alert alert-success" v-if="mensage!=''">
      <ul>
        <li>{{mensage}}</li>
      </ul>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.ID') }}</th>
              <th>{{ $trans('messages.Title') }}</th>
              <th>{{ $trans('messages.Content') }}</th>
              <th>{{ $trans('messages.Tags') }}</th>
              <th>{{ $trans('messages.Summary') }}</th>
              <th>{{ $trans('messages.Publication State') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Video') }}</th>
              <th>{{ $trans('messages.QR') }}</th>
              <th>{{ $trans('messages.User') }}</th>
              <th>{{ $trans('messages.Category') }}</th>
              <th>{{ $trans('messages.Read Access') }}</th>
              <th>{{ $trans('messages.Likes') }}</th>
              <th>{{ $trans('messages.Shared') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.ID') }}</th>
              <th>{{ $trans('messages.Title') }}</th>
              <th>{{ $trans('messages.Content') }}</th>
              <th>{{ $trans('messages.Tags') }}</th>
              <th>{{ $trans('messages.Summary') }}</th>
              <th>{{ $trans('messages.Publication State') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Video') }}</th>
              <th>{{ $trans('messages.QR') }}</th>
              <th>{{ $trans('messages.User') }}</th>
              <th>{{ $trans('messages.Category') }}</th>
              <th>{{ $trans('messages.Read Access') }}</th>
              <th>{{ $trans('messages.Likes') }}</th>
              <th>{{ $trans('messages.Shared') }}</th>
            </tr>
          </tfoot>
          <tbody>

                <tr v-for="(post, index) in posts" :post="post" :key="post.id">
                  <td>
                      <a href="#" @click="openEditPost(index,post)"><i class="fa fa-edit"></i></a>
                      <a href="#" @click="deletePost(index,post.id,post.title)"><i class="fa fa-trash-alt"></i></a>
                  </td>
                  <td>{{post.id}}</td>
                  <td>{{post.title}}</td>
                  <td>{{post.content}}</td>
                  <td>
                    <div class="" v-for="tag in post.tags ">
                    {{tag.name}}
                    </div>
                  </td>
                  <td>{{post.summary}}</td>
                  <td>{{post.publicate_state}}</td>
                  <td><img :src="src+post.img_url"  width="100"></td>
                  <td></td>
                  <td></td>
                  <td>{{user}}</td>
                  <td>{{post.categoria_posts.category_post}}</td>
                  <td>{{post.cant_access_read}}</td>
                  <td>{{post.cant_likes}}</td>
                  <td>{{post.cant_shares}}</td>
                </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
  import VueCkeditor from 'vue-ckeditor2';
  export default {
      components: { VueCkeditor },
      data(){
        return {
          config: {
       toolbar: [

     { name: 'document',    items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
     { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
     { name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
     { name: 'forms',       items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
     '/',
     { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
     { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
     { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
     { name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
     '/',
     { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
     { name: 'colors',      items : [ 'TextColor','BGColor' ] },
     { name: 'tools',       items : [ 'Maximize', 'ShowBlocks','-','About' ] }
       ],
       height: 300
     },
          posts:[],
          post:[],
          postActualizar:false,
          idPostActualizar:-1,
          value:'',
          id:'',
          mensage:'',
          valueImg:'',
          title:'',
          locale:'',
          user:this.$attrs.user,
          imagenPost:'',
          src:'storage/img_web/posts_img/',
          categoria:'',
          categories:'',
          categori:'',
          checkEditSummary:'',
          checkEditContent:'',
          ventanaCreatPost:false,
          ventanaEditPost:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        onBlur(evt) {
      console.log(evt);
    },
    onFocus(evt) {
      console.log(evt);
    },
    onContentDom(evt) {
      console.log(evt);
    },
    onDialogDefinition(evt) {
      console.log(evt);
    },
    onFileUploadRequest(evt) {
      console.log(evt);
    },
    onFileUploadResponse(evt) {
      console.log(evt);
    },
        imageEdit:function(e){

          this.imagenPost=e.target.files[0];
        },
        addPostIndex:function(postAdd){
          this.posts.push(postAdd);
          this.ventanaCreatPost=false;
        },
        updPostIndex:function(postUpd){
          const position=this.posts.findIndex(post=>post.id===postUpd.id);
          this.posts[position]=postUpd;
          this.ventanaEditPost=false;
        },
        deletePost:function(index,post,post_name){
          let post_id=post;
            swal({title:this.$trans('messages.Delete Post'),
                  text:this.$trans('messages.Are you completely sure you want to delete the post')+': '+post_name+'?',
                  icon:'warning',
                  closeOnClickOutside:false,
                  closeOnEsc:false,
                  buttons:true,
                  dangerMode:true,
                  showCancelButton: true,
                  confirmButtonText: this.$trans('messages.Yes, delete'),
                  cancelButtonText: this.$trans('messages.Cancel'),
                }).then(select=>{
                  if (select){
                    let  url='/posts/'+post_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:'Operación correcta',
                                 text:'Post eliminado satisfactoriamente',
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.posts.splice(index,1);
                                 }
                               });
                         })
                         .catch(error=>{
                           console.log(error.response.data.errors);
                           let wrong=error.response.data.errors;
                           if(wrong.hasOwnProperty('title')){
                             mensaje+='-'+wrong.title[0];
                           }
                           if(wrong.hasOwnProperty('image')){
                             mensaje+='-'+wrong.image[0];
                           }
                          if (wrong.hasOwnProperty('categoria')) {
                             mensaje+='-'+wrong.categoria[0];
                           }
                           if(wrong.hasOwnProperty('checkEditSummary')){
                             mensaje+='-'+wrong.checkEditSummary[0];
                           }
                          if (wrong.hasOwnProperty('checkEditContent')) {
                             mensaje+='-'+wrong.checkEditContent[0];
                           }
                           else if (wrong.hasOwnProperty('login')){
                             mensaje+='-'+wrong.login[0];
                           }
                           swal('Error',mensaje,'error');
                         });
                  }
                });


        },
        openEditPost:function(index,post){
        this.post=post;
          this.ventanaEditPost=true;

        },

      },
      created: function () {
         axios.get('/postsTable')
              .then(response =>{
                this.posts = response.data;
                if (response.data==''){
                  this.mensage=this.$trans('messages.None Post added yet');
                }
                console.log('CatPost- '+response.data);})
              .catch(error => this.errors.push(error));
         axios.get('/categoriesList')
               .then(response =>{
                 this.categories = response.data;
               })
              .catch(error => this.errors.push(error));
         },
        mounted() {
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
