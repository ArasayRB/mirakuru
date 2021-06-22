<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Posts') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddPost()" v-can-user="'create-post'" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true" hidden>{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <add-post-form-component @postnew="addPostIndex" :show_lang_div="show_lang_div" :post="post" :locale="locale" v-if="ventanaCreatPost" @close="ventanaCreatPost = false">

    </add-post-form-component>
    <edit-post-form-component @postupd="updPostIndex" :lan_to_edit="lan_to_edit" :locale="locale" :post="post" v-if="ventanaEditPost" @close="ventanaEditPost = false">

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
        <paginate class="pt-5 mt-3" ref="paginator" name = "posts" :list = "posts" :per = "2" :key="posts ? posts.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Title') }}</th>
              <th>{{ $trans('messages.Tags') }}</th>
              <th>{{ $trans('messages.Summary') }}</th>
              <th>{{ $trans('messages.Publication State') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.QR') }}</th>
              <th>{{ $trans('messages.User') }}</th>
              <th>{{ $trans('messages.Category') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Title') }}</th>
              <th>{{ $trans('messages.Tags') }}</th>
              <th>{{ $trans('messages.Summary') }}</th>
              <th>{{ $trans('messages.Publication State') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.QR') }}</th>
              <th>{{ $trans('messages.User') }}</th>
              <th>{{ $trans('messages.Category') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(post,index) in paginated('posts')" :post="post" :key="post.id">

                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle" :id="'edit-translate-post-'+post.id" v-can-user="'edit-translate-post'" title="Edit Translate/Editar Traducción" data-toggle="dropdown" @click="getTranslates(index,post)" hidden>
                          <i class="fa fa-edit"></i>
                          <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu">

                          <a class="dropdown-item" type="button" v-for="lang_available in translated_languages" @click="openEditTranslated(post, lang_available)">
                              {{lang_available}}
                          </a>

                          </div>
                      </div>
                        <a href="#" @click="openAddTranslate(index,post)" :id="'translate-post-'+post.id" v-can-user="'translate-post'" hidden><i class="fas fa-language" title="Add Language/Añadir Lenguage"></i></a>
                        <a href="#" @click="openEditPost(index,post)" :id="'update-post-'+post.id" v-can="'update-post,'+post.users.name"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deletePost(index,post.id,post.title)" :id="'delete-post-'+post.id" v-can-user="'delete-post'" hidden><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                        <a :href="hreff+post.slug" :id="'preview-'+post.id" v-can-user="'pre-view-post'" hidden><i title="Preview/Vista previa" class="fa fa-eye"></i></a>
                        <a id="publicado" :id="'publish-post-'+post.id" v-can-user="'publish-post'" hidden>
                          <i :id="'publish-'+index" @click="publishIt(index,post)" v-if="post.show==false" title="Publish it/Publicar" class="fa fa-toggle-off"></i>
                          <i :id="'unpublish-'+index"  @click="publishIt(index,post)" v-else title="Publish it/Publicar" class="fa fa-toggle-on text-primary"></i>
                          <!--<i :id="'unpublish-act-'+index"  title="Publish it/Publicar" :hidden="post.show" class="fa fa-toggle-on text-primary"></i>
                          <i :id="'publish-act-'+index"  title="Publish it/Publicar" :hidden="post.show" class="fa fa-toggle-off"></i>-->
                        </a>
                    </td>
                    <td>{{post.title}}</td>
                    <td>
                      <div class="" v-for="tag in post.tags ">
                      <p> <span class="badge badge-pill badge-primary">{{tag.name}}</span></p>
                      </div>
                    </td>
                    <td>{{post.summary}}</td>
                    <td>{{post.publicate_state}}</td>
                    <td><img :src="src+post.img_url"  width="100"></td>
                    <td><img :src="src_qr+post.qr_img_url"  width="100"></td>
                    <td>{{post.users.name}}</td>
                    <td>{{post.categoria_posts.category_post}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="posts" :show-step-links="true"></paginate-links>
             <paginate-links
            for="posts"
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
          post_state:[],
          paginate:['posts'],
          hreff:'/post-preview/',
          show_lang_div:false,
          postActualizar:false,
          idPostActualizar:-1,
          value:'',
          id:'',
          mensage:'',
          valueImg:'',
          lang:true,
          title:'',
          translated_languages:[],
          lang_available:'',
          lan_to_edit:'none',
          locale:'',
          user:this.$attrs.user,
          userPermissions:[],
          imagenPost:'',
          src:'storage/img_web/posts_img/',
          src_qr:'storage/qrcodes/posts/',
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
        getListPosts:function(){
          axios.get('/postsTable')
               .then(response =>{
                 this.posts = response.data;
                /* for(var i=0; i<this.posts.length;i++){
                   if(this.posts[i].publicate_state===0){
                   this.posts[i].show=false;
                 }
                 else{
                   this.posts[i].show=true;
                 }
               }*/
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None Post added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addPostIndex:function(postAdd){
          if(this.show_lang_div){
            if(this.posts.length===0){
              location.reload();
            }
            else{
          this.posts.push(postAdd);
        }
        }
          this.ventanaCreatPost=false;
        },
        updPostIndex:function(postUpd,act_lan_to_edit){
          this.getListPosts();
          this.ventanaEditPost=false;
          this.lan_to_edit=act_lan_to_edit;
        },
        publishIt:function(index,post){
          //alert($("#publish-"+index).removeClass('fa-toggle-on'));
          let mssg;
          let state_act;

          if(post.publicate_state===0){
            mssg=this.$trans('messages.Do you want publish the post');
            state_act=1;
          }
          else{
          mssg=this.$trans('messages.Do you want unpublish the post');
          state_act=0;
        }
          swal({title:this.$trans('messages.Publish Post'),
                text:mssg+': '+post.title+'?',
                icon:'warning',
                closeOnClickOutside:false,
                closeOnEsc:false,
                buttons:true,
                dangerMode:true,
                showCancelButton: true,
                confirmButtonText: this.$trans('messages.Yes'),
                cancelButtonText: this.$trans('messages.Cancel'),
              }).then(select=>{
                if (select){
                  let  url='/publicate-post/'+post.id+'/'+state_act;

                  axios.post(url)
                       .then(response=>{
                         let publicated_post=response.data;
                         swal({title:this.$trans('messages.Correct data'),
                               text:this.$trans('messages.The Post had been publicate'),
                               icon:'success',
                               closeOnClickOutside:false,
                               closeOnEsc:false
                             }).then(select=>{
                               if (select){
                                 if(this.posts[index].show===false){
                                 this.posts[index].show=true;
                                 this.posts[index].publicate_state=1;
                               }
                               else{
                               this.posts[index].show=false;
                               this.posts[index].publicate_state=0;
                             }

                                  // $("#publish-"+index).hide(true);

                               //location.reload();
                               }
                             });
                       })
                       .catch(error=>{
                         if(error.response.data.message){
                         swal('Error',''+error.response.data.message,'error');
                       }
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
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Post deleted successfully'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                 this.getListPosts();
                                   if(this.posts.length===0){
                                     this.mensage=this.$trans('messages.None Post added yet');
                                   }
                                 }
                               });
                         })
                         .catch(error=>{
                             if(error.response.data.message){
                             swal('Error',''+error.response.data.message,'error');
                           }
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
        openAddTranslate:function(index,post){
          this.post=post;
          this.show_lang_div=false;
          this.ventanaCreatPost = true;
        },
        openAddPost:function(){
          this.show_lang_div=true;
          this.ventanaCreatPost = true;
        },
        getTranslates:function(index,post){
          axios.get('/translated-language-post/'+post.id)
               .then(response =>{
                   this.lang=false;
                 if (response.data==='no-language-added'){
                   this.translated_languages = [];
                   let mensageLang=this.$trans('messages.None language added yet');
                   swal({title:this.$trans('messages.Warning!'),
                         text:mensageLang,
                         icon:'warning',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });
                 }
                 else{
                     this.translated_languages = response.data;
                 }
               })
               .catch(error => this.errors.push(error));
        },
        openEditPost:function(index,post){

        this.post=post;
          this.ventanaEditPost=true;

        },
        openEditTranslated:function(post, lang_available){
          let post_translated_array;
          axios.get('/get-translated-post-by-lang/'+lang_available+'/'+post.id)
               .then(response =>{
                 post_translated_array = response.data;
                 this.post=post_translated_array;
                     this.ventanaEditPost=true;
                     this.lan_to_edit=lang_available;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None Post added yet');
                 }})
               .catch(error => this.errors.push(error));
        },

      },
      created: function () {
        this.userPermissions=Permissions;
        $('#publicado').add('<p>Hola</p>');
        this.getListPosts();
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
