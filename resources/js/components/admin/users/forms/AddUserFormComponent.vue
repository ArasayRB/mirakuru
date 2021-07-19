<template>
  <section class="mb-5" id="createUserModal" name="createUserModal"><!--Formulario createUserModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createUserModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">{{ $trans('messages.New User') }}</h1>
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
      <input type="text" name="name" v-model="name" class="form-control font-italic mb-2">
    </div>

    <div class="form-group">
          <label for="email">{{ $trans('messages.Email') }}</label>
          <input type="text" name="email" v-model="email" class="form-control font-italic mb-2">
        </div>

        <div class="form-group">
              <label for="password">{{ $trans('messages.Password') }}</label>
              <input type="password" name="password" v-model="password" class="form-control font-italic mb-2">
            </div>
            <div class="form-group">
                  <label for="confirm_pass">{{ $trans('messages.Confirm Password') }}</label>
                  <input type="password" name="confirm_pass" v-model="confirm_password" class="form-control font-italic mb-2">
                </div>

    <div class="form-group">
      <label for="role">{{ $trans('messages.Role') }}</label>
      <select class="form-control" v-model="roll" name="role" required>
       <option value=''>{{ $trans('messages.Select Role') }}</option>
         <option v-for="role in roles" :value="role.id">{{role.name}}</option>
      </select>
    </div>
<div class="custom-control custom-checkbox ">{{ $trans('messages.Permissions') }}:
  <span aria-hidden="true"><label :for="'permis_'+permis.key" v-for="permis in permissions" class="badge badge-pill badge-primary h3">
    {{permis.value}} <input type="checkbox" :name="'permis_'+permis.key" :id="'permis_'+permis.key" v-model="selectedPermissions" class="ml-1" :value="permis.key"></label></span>
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createPost()">{{ $trans('messages.Create') }}</button>

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
      props:['locale','show_lang_div','user'],
      data(){
        return {
          permissions: [],
          selectedPermissions: [],
          permis:[],
          msgAddTag:this.$trans('messages.Add a new Tag'),
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
          roles:[],
          role:[],
          email:'',
          activeClass:'active',
          showClass:'show',
          password:'',
          confirm_password:'',
          value:'',
          name:'',
          imagenPost:'',
          roll:'',
          src:'images/lang/',
          lang_trans:'',
          checkEditSummary:'',
          checkEditContent:'',
          ventanaCreatPost:false,
          error:'',
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
        createPost:function(){

            let  url=window.location.origin +"/admin/users";
            let msg_succ=this.$trans('messages.User')+' '+this.$trans('messages.Created.');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.name==''||this.email==''||this.password==''||this.confirm_password==''||this.roll==''||this.selectedPermissions.length==0) {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            let data = new FormData();
              data.append("name", this.name);
              data.append("email", this.email);
              data.append("password", this.password);
              data.append("password_confirmation", this.confirm_password);
              data.append("roll", this.roll);
              data.append("selectedPermissions", this.selectedPermissions);



            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let userAdd=response.data;
                          this.$emit('usernew',userAdd);

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
                  if (wrong.hasOwnProperty('rolea')) {
                     mensaje+='-'+wrong.rolea[0];
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
      watch:{
        roll(val){
          axios.get(window.location.origin +'/admin/available-permissions/'+val)
               .then(response =>{
                 this.permissions = response.data
               })
               .catch(error => this.errors.push(error));
                 console.log(this.permissions);
        },
      },
      created: function () {
         axios.get(window.location.origin +'/admin/roles-list')
              .then(response => this.roles = response.data)
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
