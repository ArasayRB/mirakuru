<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Services') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddService()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <manage-service-form-component @servicenew="addServiceIndex" @serviceoperupd="updServiceIndex" :operation="operation" :service="service" :locale="locale" v-if="ventanaOperService" @close="ventanaOperService = false">

    </manage-service-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-services'" :locale="locale" :emit="'services'" @cancelsearch="serviceList" @servicesfilter="filtersservices">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "services" :list = "services" :per = "2" :key="services ? services.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Services') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Price') }} {{ $trans('messages.High') }}</th>
              <th>{{ $trans('messages.Price') }} {{ $trans('messages.Low') }}</th>
              <th>{{ $trans('messages.Persons') }} {{ $trans('messages.Contact') }}</th>
              <th>Min {{ $trans('messages.Persons') }}</th>
              <th>Max {{ $trans('messages.Persons') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Services') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Price') }} {{ $trans('messages.High') }}</th>
              <th>{{ $trans('messages.Price') }} {{ $trans('messages.Low') }}</th>
              <th>{{ $trans('messages.Persons') }} {{ $trans('messages.Contact') }}</th>
              <th>Min {{ $trans('messages.Persons') }}</th>
              <th>Max {{ $trans('messages.Persons') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(service,index) in paginated('services')" :service="service" :key="service.id">

                    <td>

                          <a href="#" @click="openEditService(index,service)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteService(index,service.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{service.name}}</td>
                    <td>{{service.description}}</td>
                    <td>{{service.price_high}}</td>
                    <td>{{service.price_low}}</td>
                    <td>{{service.name_contact}}</td>
                    <td>{{service.person_min}}</td>
                    <td>{{service.person_max}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="services" :show-step-links="true"></paginate-links>
             <paginate-links
            for="services"
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
          services:[],
          service:[],
          permission_state:[],
          paginate:['services'],
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
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/permissions/',
          ventanaOperService:false,
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
    filtersservices:function(filters){
      this.services=filters;
    },
        imageEdit:function(e){

          this.imagenpermission=e.target.files[0];
        },
        serviceList:function(){
          axios.get('/admin/serviceList')
               .then(response =>{
                 this.services = response.data;
                 console.log('Services: '+response.data);
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addServiceIndex:function(permissionAdd){
          this.operation='';
          if(this.services.length===0){
            this.serviceList();
          }
          else{
          this.services.push(permissionAdd);
          }
          this.mensage="";
          this.ventanaOperService=false;
        },
        updServiceIndex:function(serviceUpd){
          this.operation='';
          const position=this.services.findIndex(service=>service.id===serviceUpd.id);
          this.serviceList();
          this.ventanaOperService=false;
        },
        deleteService:function(index,service){
          let service_id=service;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Service'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Service')+'?',
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
                    let  url=window.location.origin +'/admin/services/'+service_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Service')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.serviceList();
                                   if(this.services.length===0){
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
        openAddService:function(){
          this.operation='add';
          this.ventanaOperService = true;
        },
        openEditService:function(index,service){
          this.operation='update';
        this.service=service;
          this.ventanaOperService=true;

        },

      },
      created: function () {
        this.serviceList();
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
