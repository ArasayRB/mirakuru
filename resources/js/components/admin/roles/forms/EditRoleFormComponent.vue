<template>
  <section class="mb-5" id="editRoleModal" name="editRoleModal"><!--Formulario editRoleModal-->
    <form  id="form-create-role">
      <transition class="modal fade pt-5" id="editRoleModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">{{ $trans('messages.Update') }} {{ $trans('messages.Role') }}</h1>
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
                <input type="text" name="name" v-model="role.name" class="form-control font-italic mb-2">
              </div>

              <div class="form-group">
                    <label for="description">{{ $trans('messages.Description') }}</label>
                    <input type="text" name="description" v-model="role.description" class="form-control font-italic mb-2">
                  </div>
          <div class="custom-control custom-checkbox ">{{ $trans('messages.Permissions') }}:
            <span aria-hidden="true"><label :for="'permis_'+permis.id" v-for="permis in permissions" class="badge badge-pill badge-primary h3">
              {{permis.name}} <input type="checkbox" :name="'permis_'+permis.id" :id="'permis_'+permis.id" v-model="permis['checked']" class="ml-1" :value="permis.id"></label></span>
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
            <button type="button" class="btn rounded btn-primary reserva" @click="editedRole(role)">{{ $trans('messages.Update') }}</button>

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
      props:['role',
             'locale'],
      data(){
        return {
          permissions: [],
          selectedPermissions: [],
          permis: [],
          roles:[],
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

          ventanaEditRole:false,
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

        editedRole:function(role){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};
          let permissions_array=[];
          for(var t=0;t<this.permissions.length;t++){
            if(this.permissions[t].checked){
              permissions_array.push(this.permissions[t].id);
            }
          }

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", role.name);
                data.append("description", role.description);
                data.append("permissions", permissions_array);
              url="/roles/"+role.id;
              msg_edited=this.$trans('messages.Role')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Role'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let roleUpdate=response.data;
                         this.$emit('roleupd',roleUpdate);
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

        getPermissions:function(){
          axios.get('/permissions-list')
               .then(response =>{
                 this.permissions = response.data;
                 for(var i=0;i<this.permissions.length;i++){
                   for(var n=0;n<this.role.permissions.length;n++){
                     if(this.permissions[i].id===this.role.permissions[n].id){
                       this.permissions[i]['checked']=true;
                       break;
                     }
                     else{
                       this.permissions[i]['checked']=false;
                     }
                   }
                 }

                 console.log('permisos',this.permissions);
                 console.log('rol-permisos',this.role.permissions);
               })
               .catch(error => this.errors.push(error));


        },

      },
      created: function () {
        this.getPermissions();

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
