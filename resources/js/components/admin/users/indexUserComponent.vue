<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Users') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddUser()" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <add-user-form-component @usernew="addUserIndex" :user="user" :locale="locale" v-if="ventanaCreatUser" @close="ventanaCreatUser = false">

    </add-user-form-component>
    <edit-user-form-component @userupd="updUserIndex" :lan_to_edit="lan_to_edit" :locale="locale" :user="user" v-if="ventanaEditUser" @close="ventanaEditUser = false">

    </edit-user-form-component>
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
        <paginate class="mt-3" ref="paginator" name = "users" :list = "users" :per = "3" :key="users ? users.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.User') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
              <th>{{ $trans('messages.Role') }}</th>
              <th>{{ $trans('messages.Permissions') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.User') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
              <th>{{ $trans('messages.Role') }}</th>
              <th>{{ $trans('messages.Permissions') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(user,index) in paginated('users')" :user="user" :key="user.id" :class="user.id==user_id?bg_color='bg-dark':''">


                    <td>

                          <a href="#" @click="openEdituser(index,user)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteUser(index,user.id,user.name)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td :class="user.id==user_id?text_color='text-light':''">{{user.name}}</td>
                    <td :class="user.id==user_id?text_color='text-light':''">{{user.email}}</td>
                    <td><p v-for="role in user.roles"><span class="badge badge-pill badge-info">{{role.name}}</span></p></td>
                    <td>
                      <!-- Collapsable Card Example -->
                      <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a :href="'#collapseCardExample'+user.id" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" :aria-controls="'collapseCardExample'+user.id">
                          <h6 class="m-0 font-weight-bold text-primary">{{ $trans('messages.Show') }} {{ $trans('messages.Permissions') }}</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse" :id="'collapseCardExample'+user.id">
                          <div class="card-body">
                            <p v-for="permiso in user.permissions"><span class="badge badge-pill badge-info">{{permiso.name}}</span></p>
                          </div>
                        </div>
                      </div>

                    </td>
                    <td><img :src="src+user.imagen_url"  width="100"></td>



                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="users" :show-step-links="true"></paginate-links>
             <paginate-links
            for="users"
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
          users:[],
          user:[],
          user_state:[],
          paginate:['users'],
          hreff:'/user-preview/',
          userActualizar:false,
          iduserActualizar:-1,
          value:'',
          id:'',
          mensage:'',
          lang:true,
          lan_to_edit:'none',
          locale:'',
          user:this.$attrs.user,
          user_id:this.$attrs.user_id,
          imagenuser:'',
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/users/',
          ventanaCreatUser:false,
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

        userList:function(){
          axios.get('/usersList')
               .then(response =>{
                 this.users = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None User added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addUserIndex:function(userAdd){

          this.users.push(userAdd);
          this.ventanaCreatUser=false;
        },
        updUserIndex:function(userUpd){
          const position=this.users.findIndex(user=>user.id===userUpd.id);
          this.users[position]=userUpd;
          this.userList();
          this.ventanaEditUser=false;
        },
        deleteUser:function(index,user,user_name){
          let user_id=user;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.User'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.User')+' : '+user_name+'?',
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
                    let  url='/users/'+user_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.User')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.userList();
                                   if(this.users.length===0){
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
        openAddUser:function(){
          this.ventanaCreatUser = true;
        },
        openEdituser:function(index,user){

        this.user=user;
          this.ventanaEditUser=true;

        },

      },
      created: function () {
        this.userList();
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
