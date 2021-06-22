<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Permissions') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddPermiso()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <add-permiso-form-component @permissionnew="addPermisoIndex" :permission="permission" :locale="locale" v-if="ventanaCreatPermiso" @close="ventanaCreatPermiso = false">

    </add-permiso-form-component>
    <edit-permiso-form-component @permissionupd="updPermisoIndex" :locale="locale" :permission="permission" v-if="ventanaEditPermiso" @close="ventanaEditPermiso = false">

    </edit-permiso-form-component>
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "permissions" :list = "permissions" :per = "2" :key="permissions ? permissions.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Permission') }}</th>
              <th>{{ $trans('messages.Slug') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Permission') }}</th>
              <th>{{ $trans('messages.Slug') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(permission,index) in paginated('permissions')" :permission="permission" :key="permission.id">

                    <td>

                          <a href="#" @click="openEditPermission(index,permission)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deletePermission(index,permission.id,permission.name)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{permission.name}}</td>
                    <td>{{permission.slug}}</td>
                    <td>{{permission.description}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="permissions" :show-step-links="true"></paginate-links>
             <paginate-links
            for="permissions"
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
          permissions:[],
          permission:[],
          permission_state:[],
          paginate:['permissions'],
          hreff:'/permission-preview/',
          permissionActualizar:false,
          idpermissionActualizar:-1,
          value:'',
          id:'',
          mensage:'',
          valueImg:'',
          lang:true,
          locale:'',
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/permissions/',
          ventanaCreatPermiso:false,
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
        imageEdit:function(e){

          this.imagenpermission=e.target.files[0];
        },
        permissionList:function(){
          axios.get('/permissionsList')
               .then(response =>{
                 this.permissions = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addPermisoIndex:function(permissionAdd){

          this.permissions.push(permissionAdd);
          this.ventanaCreatPermiso=false;
        },
        updPermisoIndex:function(permissionUpd){
          const position=this.permissions.findIndex(permission=>permission.id===permissionUpd.id);
          this.permissionList();
          this.ventanaEditPermiso=false;
        },
        deletePermission:function(index,permission,permission_name){
          let permission_id=permission;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Permission'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Permission')+' : '+permission_name+'?',
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
                    let  url='/permissions/'+permission_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Permission')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.permissionList();
                                   if(this.permissions.length===0){
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
        openAddPermiso:function(){
          this.ventanaCreatPermiso = true;
        },
        openEditPermission:function(index,permission){

        this.permission=permission;
          this.ventanaEditPermiso=true;

        },

      },
      created: function () {
        this.permissionList();
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
