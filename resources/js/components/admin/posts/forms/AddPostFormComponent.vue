<template>
  <section class="mb-5" id="createPostModal" name="createPostModal"><!--Formulario createPostModal-->
    <form  id="form-create-post">
      <transition class="modal fade pt-5" id="createPostModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">Crear un post</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="form-group">
                <label for="title">Título/Title</label>
                <input type="text" name="title" v-model="title" class="form-control font-italic mb-2" placeholder="Título/Title...">
              </div>

              <div class="form-group">

                <label for="image">Imagen/Image</label>
              <input type="file" name="image" v-on:change="image" class="form-control-file font-italic mb-2" placeholder="Imagen/Image...">
              </div>
              <div class="form-group">
                <label for="category">Categoría/Category</label>
                <select class="form-control" v-model="categoria" name="category" placeholder="Categoría/Category..." required>
                 <option value=''>Seleccionar Actividad</option>
                   <option v-for="categori in categories" :value="categori.id">{{categori.category_post}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="check-edit-summary">Resumen/Summary</label>
                <textarea name="check-edit-summary" v-model="checkEditSummary" id="check-edit-summary" cols="10" rows="8" class="form-control font-italic mb-2" placeholder="Resumen/Summary..."></textarea>
              </div>
              <div class="form-group">
                <label for="check-edit-content">Contenido/Content</label>
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
            <button type="button" class="btn rounded btn-primary reserva" @click=createPost()>Crear/ Create</button>

              <button type="button" class="modal-default-button btn btn-danger" @click="$emit('close')">Cerrar</button>

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
  import VueCkeditor from '@ckeditor/ckeditor5-build-classic';
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
            let mensaje='Error no identificado';
            if (this.title==''||this.imagenPost==''||this.categoria==''||this.checkEditSummary==''||this.checkEditContent=='') {
              mensaje='No puede dejar campos vacíos, revise por favor';
            }
            let data = new FormData();
              data.append("title", this.title);
              data.append("image", this.imagenPost);
              data.append("category", this.categoria);
              data.append("checkEditSummary", this.checkEditSummary);
              data.append("checkEditContent", this.checkEditContent);
            axios.post(url,data)
                 .then(response=>{
                   swal({title:'Post creado satisfactoriamente',
                         text:'Datos correctos',
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
         },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
