<template>
  <section class="mb-5" id="edituserModal" name="edituserModal"><!--Formulario edituserModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="edituserModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark">{{ $trans('messages.Update') }} {{ $trans('messages.User') }}</h1>
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
                <input type="text" name="name" v-model="user.name" class="form-control font-italic mb-2">
              </div>

              <div class="form-group">
                    <label for="email">{{ $trans('messages.Email') }}</label>
                    <input type="text" name="email" v-model="user.email" class="form-control font-italic mb-2">
                  </div>

                  <div class="form-group">
                        <label for="password">{{ $trans('messages.Password') }}</label>
                        <input type="password" name="password" v-model="user.password" class="form-control font-italic mb-2">
                      </div>
                      <div class="form-group">
                            <label for="confirm_pass">{{ $trans('messages.Confirm Password') }}</label>
                            <input type="password" name="confirm_pass" v-model="user.password_confirm" class="form-control font-italic mb-2">
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
              {{permis.value}} <input type="checkbox" :name="'permis_'+permis.key" :id="'permis_'+permis.key" v-model="permis['checked']" class="ml-1" :value="permis.key"></label></span>
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
            <button type="button" class="btn rounded btn-primary reserva" @click="editedUser(user)">{{ $trans('messages.Update') }}</button>

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
      props:['user',
             'locale',
             'lan_to_edit'],
      data(){
        return {
          permissions: [],
          selectedPermissions: [],
          permis: [],
          roles:[],
          role:[],
          roll:'',
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

          ventanaEditUser:false,
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

          this.imagenuser=e.target.files[0];
        },
        editedUser:function(user){let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};
          let permissions_array=[];
          for(var t=0;t<this.permissions.length;t++){
            if(this.permissions[t].checked){
              permissions_array.push(this.permissions[t].key);
            }
          }

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", user.name);
                data.append("email", user.email);
                data.append("password", user.password);
                data.append("password_confirm", user.password_confirm);
                data.append("role", this.roll);
                data.append("permissions", permissions_array);
              url=window.location.origin +"/admin/users/"+user.id;
              msg_edited=this.$trans('messages.User')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.User'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let userUpdate=response.data;
                         this.lan_to_edit='none';
                         this.$emit('userupd',userUpdate);
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
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
        getPermissionsByRole:function(role){
         console.log('permiss-user-array:',this.user.permissions);
          console.log('permiss-old-array:',this.permissions);
          axios.get(window.location.origin +'/admin/available-permissions/'+role)
               .then(response =>{
                 this.permissions = response.data;

                 for(var i=0;i<this.permissions.length;i++){
                   for(var n=0;n<this.user.permissions.length;n++){
                     if(this.permissions[i].key===this.user.permissions[n].id){
                       this.permissions[i]['checked']=true;
                       break;
                     }
                     else{
                       this.permissions[i]['checked']=false;
                     }
                   }
                 }

                 console.log('cant-permiss:',this.permissions.length);
                  console.log('permiss-array:',this.permissions);
               })
               .catch(error => this.errors.push(error));
                 console.log(this.permissions);
        },

      },watch:{
        roll(val){
          this.getPermissionsByRole(val);
        },
      },
      created: function () {
        axios.get(window.location.origin +'/admin/roles-list')
             .then(response => this.roles = response.data)
             .catch(error => this.errors.push(error));
         },
        mounted() {
          this.roll=this.user.roles[0].id;

          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
