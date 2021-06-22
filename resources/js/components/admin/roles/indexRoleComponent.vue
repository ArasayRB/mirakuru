<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Rolls') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddRole()" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <add-role-form-component @rolenew="addRoleIndex" :role="role" :locale="locale" v-if="ventanaCreatRole" @close="ventanaCreatRole = false">

    </add-role-form-component>
    <edit-role-form-component @roleupd="updRoleIndex" :locale="locale" :role="role" v-if="ventanaEditRole" @close="ventanaEditRole = false">

    </edit-role-form-component>
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "roles" :list = "roles" :per = "2" :key="roles ? roles.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Role') }}</th>
              <th>{{ $trans('messages.Slug') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Permissions') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Role') }}</th>
              <th>{{ $trans('messages.Slug') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Permissions') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(role,index) in paginated('roles')" :role="role" :key="role.id">

                    <td>

                          <a href="#" @click="openEditRole(index,role)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteRole(index,role.id,role.name)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{role.name}}</td>
                    <td>{{role.slug}}</td>
                    <td>{{role.description}}</td>
                    <td><p v-for="permiso in role.permissions"><span class="badge badge-pill badge-info">{{permiso.name}}</span></p></td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="roles" :show-step-links="true"></paginate-links>
             <paginate-links
            for="roles"
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
          roles:[],
          role:[],
          role_state:[],
          paginate:['roles'],
          hreff:'/role-preview/',
          roleActualizar:false,
          idroleActualizar:-1,
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
          imagenrole:'',
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/roles/',
          checkEditSummary:'',
          checkEditContent:'',
          ventanaCreatRole:false,
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
        imageEdit:function(e){

          this.imagenrole=e.target.files[0];
        },
        roleList:function(){
          axios.get('/rolesList')
               .then(response =>{
                 this.roles = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addRoleIndex:function(roleAdd){

          this.roles.push(roleAdd);
          this.ventanaCreatRole=false;
        },
        updRoleIndex:function(roleUpd){
          const position=this.roles.findIndex(role=>role.id===roleUpd.id);
          this.roleList();
          this.ventanaEditRole=false;
        },
        deleteRole:function(index,role,role_name){
          let role_id=role;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Role'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Role')+' : '+role_name+'?',
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
                    let  url='/roles/'+role_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.role')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.roleList();
                                   if(this.roles.length===0){
                                     this.mensage=this.$trans('messages.None added yet');
                                   }
                                 }
                               });
                         })
                         .catch(error=>{
                           console.log(error.response.data.errors);
                           let wrong=error.response.data.errors;
                           swal('Error',mensaje,'error');
                         });
                  }
                });


        },
        openAddRole:function(){
          this.ventanaCreatRole = true;
        },
        openEditRole:function(index,role){

        this.role=role;
          this.ventanaEditRole=true;

        },

      },
      created: function () {
        this.roleList();
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
