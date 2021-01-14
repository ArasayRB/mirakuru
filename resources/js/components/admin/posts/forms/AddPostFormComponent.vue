<template>
  <section class="mb-5" id="createPostModal" name="createPostModal"><!--Formulario createPostModal-->
    <form  id="form-create-post">
      <transition class="modal fade pt-5" id="createPostModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="show_lang_div===false">{{post.title}}</h1>
        <h1 class="text-center text-dark" v-else>{{ $trans('messages.New Post') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

              <div class="form-group" id="language_div" :hidden=show_lang_div>
                <label for="lang_trans">{{ $trans('messages.Language') }}</label>
                <select class="form-control" v-model="lang_trans" name="lang_trans" required>
                 <option value=''>{{ $trans('messages.Select Language') }}</option>
                   <option v-for="language in languages" :value="language.id">{{language.language}}</option>
                </select>
              </div>

<div class="form-group">
      <label for="title">{{ $trans('messages.Title') }}</label>
      <input type="text" name="title" v-model="title" class="form-control font-italic mb-2">
    </div>

    <div class="form-group" v-if="show_lang_div===true">

      <label for="image">{{ $trans('messages.Image') }}</label>
    <input type="file" name="image" v-on:change="image" class="form-control-file font-italic mb-2">
    </div>
    <div class="form-group" v-if="show_lang_div===true">
      <label for="category">{{ $trans('messages.Category') }}</label>
      <select class="form-control" v-model="categoria" name="category" required>
       <option value=''>{{ $trans('messages.Select Category') }}</option>
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

      <div class="form-group" v-if="show_lang_div===true">
                 <label>{{ $trans('messages.Tags') }} : <span class="text-danger">*</span></label>
                 <br>
                 <tags-input element-id="tags" :add-tags-on-comma=true	class=""
v-model="selectedTags"
:existing-tags="tags"
id-field="key"
text-field="value"

:typeahead="true"></tags-input>


      </div>

      <div class="form-group" v-if="show_lang_div===true">
        <label for="title">{{ $trans('messages.Keywords') }}: <span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label></label>

        <tags-input element-id="keys" :add-tags-on-comma=true	class=""
v-model="selectedKeys"
placeholder="Add a keyword"
:existing-tags="keywords"
id-field="key"
text-field="value"



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
            <button type="button" class="btn rounded btn-primary reserva" @click="createPost()" v-if="show_lang_div===true">{{ $trans('messages.Create') }}</button>
            <button type="button" class="btn rounded btn-primary reserva" @click="createPost()" v-else>{{ $trans('messages.Translate') }}</button>

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
      components: { VueCkeditor},
      props:['locale','show_lang_div','post'],
      data(){
        return {
          tags: [],
          selectedTags: [],
          msgAddTag:this.$trans('messages.Add a new Tag'),
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
          categories:'',
          categori:'',
          languages:[],
          language:'',
          activeClass:'active',
          showClass:'show',
          value:'',
          title:'',
          imagenPost:'',
          categoria:'',
          src:'images/lang/',
          lang_trans:'',
          checkEditSummary:'',
          checkEditContent:'',
          ventanaCreatPost:false,
          error:'',
          token   : window.CSRF_TOKEN,

        }
      },
      watch:{
        selectedTags(val){
          console.log('hi-',val);
        },
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
            let url;
            let msg_succ;
            let data;

           let default_lang=this.$lang.getLocale();
           if(this.show_lang_div===false){
              url="/addTranslate";
              msg_succ=this.$trans('messages.Post translated successfully');
              let mensaje=this.$trans('messages.Unidentified error');
              if (this.title==''||this.checkEditSummary==''||this.checkEditContent==''||this.lang_trans=='') {
                mensaje=this.$trans('messages.You cannot leave empty fields, please check');
              }
              data = new FormData();
                data.append("title", this.title);
                data.append("title_old", this.post.title);
                data.append("post_id", this.post.id);
                data.append("lang", this.lang_trans);
                data.append("checkEditSummary", this.checkEditSummary);
                data.append("checkEditContent", this.checkEditContent);
           }
           else{
            url="/posts";
            msg_succ=this.$trans('messages.Post created successfully');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.title==''||this.imagenPost==''||this.categoria==''||this.checkEditSummary==''||this.checkEditContent==''||this.selectedTags==''||this.keywords=='') {
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

            let keysList=this.selectedKeys;
            let postKeys="";
            for(var i=0; i<keysList.length;i=i+1){
              if(i==(keysList.length-1)){
              postKeys= ''+postKeys+keysList[i].value;
            }
            else{
              postKeys= ''+postKeys+keysList[i].value+',';
            }
            }
            data = new FormData();
              data.append("title", this.title);
              data.append("image", this.imagenPost);
              data.append("category", this.categoria);
              data.append("lang", this.lang_trans);
              data.append("default-lang", default_lang);
              data.append("checkEditSummary", this.checkEditSummary);
              data.append("checkEditContent", this.checkEditContent);
              data.append("tags", postTags);
              data.append("keywords", postKeys);
           }


            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let postAdd=response.data;
                           if(this.show_lang_div===true){
                          this.$emit('postnew',postAdd);
                        }
                        else{
                        this.ventanaCreatPost=false;
                      }
                           //location.reload();
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
                   if (wrong.hasOwnProperty('keywords')) {
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
        axios.get('/languagesList')
              .then(response=> this.languages=response.data)
              .catch(error=>this.error.push(error));

         axios.get('/categoriesList')
              .then(response => this.categories = response.data)
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
          /*
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }*/
        }
    }
</script>
