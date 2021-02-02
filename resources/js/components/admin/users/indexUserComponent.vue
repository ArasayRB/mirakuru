<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Users') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAdduser()" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <add-user-form-component @usernew="adduserIndex" :show_lang_div="show_lang_div" :user="user" :locale="locale" v-if="ventanaCreatuser" @close="ventanaCreatuser = false">

    </add-user-form-component>
    <edit-user-form-component @userupd="upduserIndex" :lan_to_edit="lan_to_edit" :locale="locale" :user="user" v-if="ventanaEdituser" @close="ventanaEdituser = false">

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
        <paginate class="pt-5 mt-3" ref="paginator" name = "users" :list = "users" :per = "2" :key="users ? users.length:0">
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


                <tr v-for="(user,index) in paginated('users')" :user="user" :key="user.id">

                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle" title="Edit Translate/Editar Traducción" data-toggle="dropdown" @click="getTranslates(index,user)">
                          <i class="fa fa-edit"></i>
                          <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu">

                          <a class="dropdown-item" type="button" v-for="lang_available in translated_languages" @click="openEditTranslated(user, lang_available)">
                              {{lang_available}}
                          </a>

                          </div>
                      </div>
                        <a href="#" @click="openAddTranslate(index,user)"><i class="fas fa-language" title="Add Language/Añadir Lenguage"></i></a>
                        <a href="#" @click="openEdituser(index,user)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteuser(index,user.id,user.name)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                        <a :href="hreff+user.id"><i title="Preview/Vista previa" class="fa fa-eye"></i></a>
                        <a id="publicado">
                          <i :id="'publish-'+index" @click="publishIt(index,user)" v-if="user.show==false" title="Publish it/Publicar" class="fa fa-toggle-off"></i>
                          <i :id="'unpublish-'+index"  @click="publishIt(index,user)" v-else title="Publish it/Publicar" class="fa fa-toggle-on text-primary"></i>
                          <!--<i :id="'unpublish-act-'+index"  title="Publish it/Publicar" :hidden="user.show" class="fa fa-toggle-on text-primary"></i>
                          <i :id="'publish-act-'+index"  title="Publish it/Publicar" :hidden="user.show" class="fa fa-toggle-off"></i>-->
                        </a>
                    </td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>Roles</td>
                    <td>Permisos</td>
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
          show_lang_div:false,
          userActualizar:false,
          iduserActualizar:-1,
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
          user:this.$attrs.user,
          imagenuser:'',
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/users/',
          checkEditSummary:'',
          checkEditContent:'',
          ventanaCreatuser:false,
          ventanaEdituser:false,
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

          this.imagenuser=e.target.files[0];
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
        adduserIndex:function(userAdd){
          if(this.show_lang_div){
            if(this.users.length===0){
              location.reload();
            }
            else{
          this.users.push(userAdd);
        }
        }
          this.ventanaCreatuser=false;
        },
        upduserIndex:function(userUpd,act_lan_to_edit){
          console.log('Nueva variable lan_to_edit es: '+act_lan_to_edit);
          const position=this.users.findIndex(user=>user.id===userUpd.id);
          this.users[position]=userUpd;
          this.ventanaEdituser=false;
          this.lan_to_edit=act_lan_to_edit;
        },
        publishIt:function(index,user){
          //alert($("#publish-"+index).removeClass('fa-toggle-on'));
          let mssg;
          let state_act;

          if(user.publicate_state===0){
            mssg=this.$trans('messages.Do you want publish the user');
            state_act=1;
          }
          else{
          mssg=this.$trans('messages.Do you want unpublish the user');
          state_act=0;
        }
          swal({title:this.$trans('messages.Publish user'),
                text:mssg+': '+user.title+'?',
                icon:'warning',
                closeOnClickOutside:false,
                closeOnEsc:false,
                buttons:true,
                dangerMode:true,
                showCancelButton: true,
                confirmButtonText: this.$trans('messages.Yes'),
                cancelButtonText: this.$trans('messages.Cancel'),
              }).then(select=>{
                if (select){
                  let  url='/publicate-user/'+user.id+'/'+state_act;

                  axios.user(url)
                       .then(response=>{
                         let publicated_user=response.data;
                         swal({title:this.$trans('messages.Correct data'),
                               text:this.$trans('messages.The user had been publicate'),
                               icon:'success',
                               closeOnClickOutside:false,
                               closeOnEsc:false
                             }).then(select=>{
                               if (select){
                                 if(this.users[index].show===false){
                                 this.users[index].show=true;
                                 this.users[index].publicate_state=1;
                               }
                               else{
                               this.users[index].show=false;
                               this.users[index].publicate_state=0;
                             }

                                  // $("#publish-"+index).hide(true);

                               //location.reload();
                               }
                             });
                       })
                       .catch(error=>{
                         console.log(error.response.data.errors);
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
                       });
                }
              });

        },
        deleteuser:function(index,user,user_name){
          let user_id=user;
            swal({title:this.$trans('messages.Delete user'),
                  text:this.$trans('messages.Are you completely sure you want to delete the user')+': '+user_name+'?',
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
                                 text:this.$trans('messages.user deleted successfully'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.users.splice(index,1);
                                   if(this.users.length===0){
                                     this.mensage=this.$trans('messages.None user added yet');
                                   }
                                 }
                               });
                         })
                         .catch(error=>{
                           console.log(error.response.data.errors);
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
                         });
                  }
                });


        },
        openAddTranslate:function(index,user){
          this.user=user;
          this.show_lang_div=false;
          this.ventanaCreatuser = true;
        },
        openAdduser:function(){
          this.show_lang_div=true;
          this.ventanaCreatuser = true;
        },
        getTranslates:function(index,user){
          axios.get('/translated-language-user/'+user.id)
               .then(response =>{
                   this.lang=false;
                 if (response.data==='no-language-added'){
                   this.translated_languages = [];
                   let mensageLang=this.$trans('messages.None language added yet');
                   swal({title:this.$trans('messages.Warning!'),
                         text:mensageLang,
                         icon:'warning',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });
                 }
                 else{
                     this.translated_languages = response.data;
                 }
               })
               .catch(error => this.errors.push(error));
        },
        openEdituser:function(index,user){

        this.user=user;
          this.ventanaEdituser=true;

        },
        openEditTranslated:function(user, lang_available){
          let user_translated_array;
          axios.get('/get-translated-user-by-lang/'+lang_available+'/'+user.id)
               .then(response =>{
                 user_translated_array = response.data;
                 this.user=user_translated_array;
                     this.ventanaEdituser=true;
                     this.lan_to_edit=lang_available;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None user added yet');
                 }})
               .catch(error => this.errors.push(error));
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
