<template>
  <section class="mb-5" id="editPermisoModal" name="editPermisoModal"><!--Formulario editPermisoModal-->
    <form  id="form-create-permission">
      <transition class="modal fade pt-5" id="editPermisoModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">{{ $trans('messages.Update') }} {{ $trans('messages.Permission') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">


              <div class="form-group">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="text" name="name" v-model="permission.name" class="form-control font-italic mb-2">
              </div>

              <div class="form-group">
                    <label for="description">{{ $trans('messages.Description') }}</label>
                    <input type="text" name="description" v-model="permission.description" class="form-control font-italic mb-2">
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
            <button type="button" class="btn rounded btn-primary reserva" @click="editedPermiso(permission)">{{ $trans('messages.Update') }}</button>

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
      props:['permission',
             'locale'],
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

          ventanaEditPermiso:false,
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

        editedPermiso:function(permission){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", permission.name);
                data.append("description", permission.description);
              url="/permissions/"+permission.id;
              msg_edited=this.$trans('messages.Permission')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Permission'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let permissionUpdate=response.data;
                         this.$emit('permissionupd',permissionUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 if(wrong.hasOwnProperty('description')){
                   mensaje+='-'+wrong.description[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },


      },
      created: function () {

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
