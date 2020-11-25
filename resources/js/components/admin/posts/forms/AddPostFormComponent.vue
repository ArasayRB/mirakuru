<template>
  <section class="mb-5" id="createPostModal" name="createPostModal"><!--Formulario createPostModal-->
    <form  id="form-create-post">
      <transition class="modal fade pt-5" id="createPostModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">{{ $trans('messages.New Post') }}</h1>
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
                <input type="text" name="title" v-model="title" class="form-control font-italic mb-2">
              </div>

              <div class="form-group">

                <label for="image">{{ $trans('messages.Image') }}</label>
              <input type="file" name="image" v-on:change="image" class="form-control-file font-italic mb-2">
              </div>
              <div class="form-group">
                <label for="category">{{ $trans('messages.Category') }}</label>
                <select class="form-control" v-model="categoria" name="category" required>
                 <option value=''>Seleccionar Actividad</option>
                   <option v-for="categori in categories" :value="categori.id">{{categori.category_post}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="check-edit-summary">{{ $trans('messages.Summary') }}</label>
                <textarea name="check-edit-summary" v-model="checkEditSummary" id="check-edit-summary" cols="10" rows="8" class="form-control font-italic mb-2"></textarea>
              </div>
              <div class="form-group">
                <label for="check-edit-content">{{ $trans('messages.Content') }}</label>
                <vue-ckeditor
                 v-model="checkEditContent"
                 :config="config"
                 @blur="onBlur($event)"
                 @focus="onFocus($event)"
                 @contentDom="onContentDom($event)"
                 @dialogDefinition="onDialogDefinition($event)"
                 @fileUploadRequest="onFileUploadRequest($event)"
                 @fileUploadResponse="onFileUploadResponse($event)" />
                </div>

                <div class="form-group">
                           <label>Tags : <span class="text-danger">*</span></label>
                           <br>
                           <tags-input element-id="tags" :add-tags-on-comma=true	class=""
    v-model="selectedTags"
    :existing-tags="tags"
    id-field="slug"
    text-field="name"

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
            <button type="button" class="btn rounded btn-primary reserva" @click=createPost()>{{ $trans('messages.Create') }}</button>

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
  import VoerroTagsInput from '@voerro/vue-tagsinput';
  Vue.component('tags-input', VoerroTagsInput);
    export default {
      components: { VueCkeditor},
      props:['locale'],
      data(){
        return {
          tags: [],
          selectedTags: [],
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
          categories:'',
          categori:'',
          post:'',
          value:'',
          title:'',
          imagenPost:'',
          categoria:'',
          checkEditSummary:'',
          checkEditContent:'',
          ventanaCreatPost:false,
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
            console.log('Entro -'+e.target.files[0]);
        },
        createPost:function(){

            let url="/posts";
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.title==''||this.imagenPost==''||this.categoria==''||this.checkEditSummary==''||this.checkEditContent==''||this.selectedTags=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }
            let tagsList=this.selectedTags;
            let postTags="";
            for(var i=0; i<tagsList.length;i=i+1){
              if(i==(tagsList.length-1)){
              postTags= ''+postTags+tagsList[i].value;
            }
            else{
              postTags= ''+postTags+tagsList[i].value+',';
            }
            }
            let data = new FormData();
              data.append("title", this.title);
              data.append("image", this.imagenPost);
              data.append("category", this.categoria);
              data.append("checkEditSummary", this.checkEditSummary);
              data.append("checkEditContent", this.checkEditContent);
              data.append("tags", postTags);
            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:this.$trans('messages.Post created successfully'),
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let postAdd=response.data;
                          this.$emit('postnew',postAdd);
                           //location.reload();
                         }
                       });
                   //console.log(response);
                 })
                 .catch(error=>{
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
         axios.get('/categoriesList')
              .then(response => this.categories = response.data)
              .catch(error => this.errors.push(error));

         axios.get('/available-tags')
              .then(response =>{
                this.tags = response.data;
                console.log(this.tags);
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
