<template>
  <section class="mb-5" id="editPostModal" name="editPostModal"><!--Formulario editPostModal-->
    <form  id="form-create-post">
      <transition class="modal fade pt-5" id="editPostModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">{{ $trans('messages.Update a Post') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="form-group">
                <label for="title">{{ $trans('messages.Title') }}</label>
                <input type="text" name="title" v-model="post.title" class="form-control font-italic mb-2">
              </div>

              <div class="form-group">

                <label for="image">{{ $trans('messages.Image') }}</label>
              <input type="file" name="image" v-on:change="image" class="form-control-file font-italic mb-2">
              <div class="row">
                <img :src="src+post.img_url" :alt="post.img_url" width="100">
              </div>
              </div>
              <div class="form-group">
                <label for="category">{{ $trans('messages.Category') }}</label>
                <select class="form-control" v-model="categoria" name="category" required>
                 <option value=''>Seleccionar Actividad</option>
                   <option v-for="categori in categories" :selected="post.category_id === categori.id" :value="categori.id" selected>{{categori.category_post}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="check-edit-summary">{{ $trans('messages.Summary') }}</label>
                <textarea name="check-edit-summary" v-model="post.summary" id="check-edit-summary" cols="10" rows="8" class="form-control font-italic mb-2"></textarea>
              </div>
              <div class="form-group">
                <label for="check-edit-content">{{ $trans('messages.Content') }}</label>
                <vue-ckeditor
                 v-model="post.content"
                 :config="config"
                 @blur="onBlur($event)"
                 @focus="onFocus($event)"
                 @contentDom="onContentDom($event)"
                 @dialogDefinition="onDialogDefinition($event)"
                 @fileUploadRequest="onFileUploadRequest($event)"
                 @fileUploadResponse="onFileUploadResponse($event)" />
                </div>

                <div class="form-group">
                           <label>{{ $trans('messages.Tags') }} : <span class="text-danger">*</span></label>
                           <br>
                           <tags-input element-id="tags" :add-tags-on-comma=true	class=""
    v-model="post.tags"
    :existing-tags="tags"
    id-field="slug"
    text-field="name"
    :typeahead="true"></tags-input>


                </div>

                <div class="form-group">
                  <label for="title">{{ $trans('messages.Keywords') }}: <span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label></label>

                  <tags-input element-id="keys" :add-tags-on-comma=true	class=""
v-model="post.keywords"
:existing-tags="keywords"
id-field="id"
text-field="name"
placeholder="Add a keyword"

:typeahead="true"></tags-input>


                </div>


            </div>

          </div>
        </div>
      </slot>
    </div>
    <div class="modal-footer">
      <slot>
        <div class="col justify-content-center">
      <div class="form-group row mb-0">
          <div class="col-md-5 offset-md-4">
            <button type="button" class="btn rounded btn-primary reserva" @click="editedPost(post)">{{ $trans('messages.Update') }}</button>

              <button type="button" class="modal-default-button btn btn-danger" @click="$emit('close')">{{ $trans('messages.Close') }}</button>

          </div>
      </div>
      </div>
      </slot>
    </div>
    </div>
    </div>
    </div>
  </transition>
    </form>
  </section><!--End Formulario login-->
</template>

<script>
  import VueCkeditor from 'vue-ckeditor2';
    export default {
      components: { VueCkeditor },
      props:['post',
              'locale'],
      data(){
        return {
          tags: [],
          selectedTags: [],
          keywords: [],
          selectedKeys: [],
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
          urlPostUp:this.$attrs.urlpostup,
          categories:'',
          categori:'',
          value:'',
          src:'storage/img_web/posts_img/',
          imagenPost:'',
          categoria:'',
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
        image:function(e){

          this.imagenPost=e.target.files[0];
        },
        editedPost:function(post){
          let config= { headers: {"Content-Type": "multipart/form-data" }};

            let tagsList=post.tags;
            let postTags="";
            for(var i=0; i<tagsList.length;i=i+1){
              if(i==(tagsList.length-1)){
              postTags= ''+postTags+tagsList[i].name;
            }
            else{
              postTags= ''+postTags+tagsList[i].name+',';
            }
            }

            let keysList=post.keywords;
            let postKeys="";
            for(var i=0; i<keysList.length;i=i+1){
              if(i==(keysList.length-1)){
              postKeys= ''+postKeys+keysList[i].name;
            }
            else{
              postKeys= ''+postKeys+keysList[i].name+',';
            }
            }
          let data = new FormData();
	          data.append('_method', 'patch');
            data.append("title", post.title);
            data.append("img_url", this.imagenPost);
            data.append("category_id", this.categoria);
            data.append("summary", post.summary);
            data.append("content", post.content);
            data.append("tags", postTags);
            data.append("keywords", postKeys);
          let url="/posts/"+post.id;
          post.img_url=this.imagenPost;
          console.log('textTgs- '+postTags+', textKeys- '+postKeys);
          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Post'),
                       text:this.$trans('messages.The post has been successfully modified'),
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let postUpdate=response.data;
                         this.$emit('postupd',postUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('title')){
                   mensaje+='-'+wrong.title[0];
                 }
                 if(wrong.hasOwnProperty('img_url')){
                   mensaje+='-'+wrong.img_url[0];
                 }
                if (wrong.hasOwnProperty('category_id')) {
                   mensaje+='-'+wrong.category_id[0];
                 }
                 if(wrong.hasOwnProperty('summary')){
                   mensaje+='-'+wrong.summary[0];
                 }
                if (wrong.hasOwnProperty('content')) {
                   mensaje+='-'+wrong.content[0];
                 }
                if (wrong.hasOwnProperty('tags')) {
                   mensaje+='-'+wrong.tags[0];
                 }
                 else if (wrong.hasOwnProperty('login')){
                   mensaje+='-'+wrong.login[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },

      },
      created: function () {
        this.categoria=this.post.category_id;
         axios.get('/categoriesList')
              .then(response =>{
                 this.categories = response.data;
               })
              .catch(error => this.errors.push(error));

         axios.get('/available-tags')
              .then(response =>{
                this.tags = response.data;
                console.log(this.tags);
              })
              .catch(error => this.errors.push(error));

              axios.get('/available-keys')
                   .then(response =>{
                     this.keywords = response.data;
                     console.log(this.keywords);
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
