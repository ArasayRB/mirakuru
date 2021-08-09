<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Subscription') }}s</h1>
    </div>
    <form id="form-delete-suscript" class="bg-info mx-2 my-2 rounded" v-if="form_del_sus">
      <p class="font-weight-bold text-dark text-center">{{suscript_to_del.email}}</p>
      <h4 class="font-weight-bold text-dark text-center mx-2 my-2">{{ $trans('messages.Choice the suscriptions to delete, please!') }}</h4>
      <div class="form-group text-center">
        <label v-for="(sus,ind) in suscript_to_del.hostales">
          <input type="checkbox" :id="'sus_del_'+sus.id" class="mx-2 my-2"><span class="text-dark">{{sus.name}}</span>
        </label>
      </div>
      <div class="row justify-content-center mb-2">
          <button type="button" class="btn btn-primary mx-2 my-2" @click="confirmDeleteSusc(suscript_to_del)">{{ $trans('messages.Delete') }}</button>
          <button type="button" class="btn btn-danger mx-2 my-2" @click="form_del_sus=false">{{ $trans('messages.Cancel') }}</button>
      </div>
    </form>

  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>

      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-suscriptions'" :locale="locale" :emit="'suscriptions'" @cancelsearch="suscriptionList" @suscriptionsfilter="filterssuscriptions">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "suscriptions" :list = "suscriptions" :per = "2" :key="suscriptions ? suscriptions.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Subscription') }}</th>
              <th>{{ $trans('messages.Hostal') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Subscription') }}</th>
              <th>{{ $trans('messages.Hostal') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(suscription,index) in paginated('suscriptions')" :suscription="suscription" :key="suscription.id">

                    <td>

                        <a href="#" @click="deleteSuscription(index,suscription)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{suscription.email}}</td>
                    <td>
                      <div v-for="(hostal,index) in suscription.hostales">
                        <span class="badge badge-pill badge-primary">{{hostal.name}}</span>
                      </div>
                    </td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="suscriptions" :show-step-links="true"></paginate-links>
             <paginate-links
            for="suscriptions"
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
          suscriptions:[],
          suscription:[],
          suscript_to_del:[],
          form_del_sus:false,
          permission_state:[],
          paginate:['suscriptions'],
          value:'',
          operation:'',
          id:'',
          mensage:'',
          valueImg:'',
          lang:true,
          locale:this.$attrs.locale,
          ventanaOperSuscription:false,
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
    filterssuscriptions:function(filters){
      this.suscriptions=filters;
    },
        suscriptionList:function(){
          axios.get(window.location.origin +'/admin/suscriptionList')
               .then(response =>{
                 this.suscriptions = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        confirmDeleteSusc:function(susc_to_del_confirm){
          let checks=susc_to_del_confirm.hostales;
          let id_checks='sus_del_';
          let hostal_sus_del=[];
          let error_msg='-';
          for (var i = 0; i < checks.length; i++) {
            if($("#"+id_checks+checks[i].id)[0].checked){
            hostal_sus_del.push(checks[i].id);
            }
          }
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Suscription'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Suscription')+'?',
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
                    let  url;
                    for (var y = 0; y < hostal_sus_del.length; y++) {
                    url=window.location.origin +'/admin/suscriptions/'+susc_to_del_confirm.id+'/'+hostal_sus_del[y];
                    axios.delete(url)
                         .then(response=>{
                           let resp=response.data;
                           let cont=hostal_sus_del.length;
                           if(cont==y){
                             let is_error=error_msg.split(' ');
                             if(is_error.length==1){
                               swal({title:this.$trans('messages.Correct data'),
                                     text:this.$trans('messages.Deleted')+' '+this.$trans('messages.Succefully'),
                                     icon:'success',
                                     closeOnClickOutside:false,
                                     closeOnEsc:false
                                   });
                                     this.suscriptionList();
                                   this.form_del_sus=false;
                             }
                             else{
                               swal({title:this.$trans('messages.Whoops!'),
                                     text:this.$trans('messages.Whoops! Something went wrong.')+' '+is_error,
                                     icon:'error',
                                     closeOnClickOutside:false,
                                     closeOnEsc:false
                                   });
                             }
                           }
                         })
                         .catch(error=>{
                           error_msg+=error.response.data.errors+'</br>';
                           swal('Error',mensaje,'error');
                         });
                       }

                  }
                });
        },
        deleteSuscription:function(index,suscription){
          this.suscript_to_del=suscription;
          this.form_del_sus=true;

        },

      },
      created: function () {
        this.suscriptionList();
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
