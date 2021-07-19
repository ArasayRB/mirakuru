<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Hostals') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddHostal()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <manage-hostal-form-component @hostalnew="addHostalIndex" @hostaloperupd="updHostalIndex" :operation="operation" :hostal="hostal" :locale="locale" v-if="ventanaOperHostal" @close="ventanaOperHostal = false">

    </manage-hostal-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-hostals'" :locale="locale" :emit="'hostals'" @cancelsearch="hostalList" @hostalsfilter="filtershostals">
    </input-searcher-component>

    </div>
    </div>
    <div class="alert alert-success" v-if="mensage!=''">
      <ul>
        <li>{{mensage}}</li>
      </ul>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <paginate class="pt-5 mt-3" ref="paginator" name = "hostals" :list = "hostals" :per = "2" :key="hostals ? hostals.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Hostals') }}</th>
              <th>{{ $trans('messages.Phone') }}</th>
              <th>{{ $trans('messages.Adress') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Hostals') }}</th>
              <th>{{ $trans('messages.Phone') }}</th>
              <th>{{ $trans('messages.Adress') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(hostal,index) in paginated('hostals')" :hostal="hostal" :key="hostal.id">

                    <td>

                          <a href="#" @click="openEditHostal(index,hostal)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="addHostalImages(index,hostal.id)"><i class="fas fa-images" title="Add Images/Añadir Imagenes"></i></a>
                        <a href="#" @click="deleteHostal(index,hostal.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{hostal.name}}</td>
                    <td>{{hostal.phone}}</td>
                    <td>{{hostal.address}}</td>
                    <td><img :src="src+hostal.slug+'/'+hostal.img_ppal_url"  width="100"></td>
                    <td>{{hostal.email}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="hostals" :show-step-links="true"></paginate-links>
             <paginate-links
            for="hostals"
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
          hostals:[],
          hostal:[],
          permission_state:[],
          paginate:['hostals'],
          hreff:'/permission-preview/',
          permissionActualizar:false,
          idpermissionActualizar:-1,
          value:'',
          operation:'',
          id:'',
          mensage:'',
          valueImg:'',
          lang:true,
          locale:this.$attrs.locale,
          src:window.location.origin +'/storage/hostales/',
          src_qr:'storage/qrcodes/hostals/',
          ventanaOperHostal:false,
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
    filtershostals:function(filters){
      this.hostals=filters;
    },
        imageEdit:function(e){

          this.imagenpermission=e.target.files[0];
        },
        hostalList:function(){
          axios.get(window.location.origin +'/admin/hostalList')
               .then(response =>{
                 this.hostals = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addHostalIndex:function(permissionAdd){
          this.operation='';
            this.hostalList();
          this.mensage="";
          this.ventanaOperHostal=false;
        },
        updHostalIndex:function(hostalUpd){
          this.operation='';
          const position=this.hostals.findIndex(hostal=>hostal.id===hostalUpd.id);
          this.hostalList();
          this.ventanaOperHostal=false;
        },
        deleteHostal:function(index,hostal){
          let hostal_id=hostal;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Hostal'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Hostal')+'?',
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
                    let  url=window.location.origin +'/admin/hostals/'+hostal_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Hostal')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.hostalList();
                                   if(this.hostals.length===0){
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
        openAddHostal:function(){
          this.operation='add';
          this.ventanaOperHostal = true;
        },
        openEditHostal:function(index,hostal){
          this.operation='update';
        this.hostal=hostal;
          this.ventanaOperHostal=true;

        },

      },
      created: function () {
        this.hostalList();
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
