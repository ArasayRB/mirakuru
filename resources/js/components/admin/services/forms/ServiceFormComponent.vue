<template>
  <section class="mb-5" id="createServiceModal" name="createServiceModal"><!--Formulario createServiceModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createServiceModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Services') }}</h1>
        <h1 class="text-center text-dark" v-if="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Services') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">


<div class="form-group">
  <label for="serv">{{ $trans('messages.Name') }}</label>
  <input type="serv" name="serv" v-model="serv" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="serv" name="serv" v-model="service.name" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>
<div class="form-group">
  <label for="check-edit-content">{{ $trans('messages.Description') }}</label>
  <vue-ckeditor
   v-if="operation==='add'"
   v-model="description"
   :config="config"
   @blur="onBlur($event)"
   @focus="onFocus($event)"
   @contentDom="onContentDom($event)"
   @dialogDefinition="onDialogDefinition($event)"
   @fileUploadRequest="onFileUploadRequest($event)"
   @fileUploadResponse="onFileUploadResponse($event)" />
   <vue-ckeditor
    v-if="operation==='update'"
    v-model="service.description"
    :config="config"
    @blur="onBlur($event)"
    @focus="onFocus($event)"
    @contentDom="onContentDom($event)"
    @dialogDefinition="onDialogDefinition($event)"
    @fileUploadRequest="onFileUploadRequest($event)"
    @fileUploadResponse="onFileUploadResponse($event)" />
  </div>

<div class="form-group">
  <label for="price_high">{{ $trans('messages.Price') }} {{ $trans('messages.High') }}</label>
  <input type="number"  id="price_high" required name="price_high" v-model="price_high" min="1" step="0.1"  class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="number"  id="price_high" required name="price_high" v-model="service.price_high" min="1" step="0.1"  class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="price_low">{{ $trans('messages.Price') }} {{ $trans('messages.Low') }}</label>
  <input type="number"  id="price_low" required name="price_low" v-model="price_low" min="1" step="0.1"  :max="price_high" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="number"  id="price_low" required name="price_low" v-model="service.price_low" min="1" step="0.1"  :max="service.price_high" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="contact_person">{{ $trans('messages.Contact') }} {{ $trans('messages.Persons') }}</label>
  <input type="text" name="contact_person" v-model="name_contact" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="text" name="contact_person" v-model="service.name_contact" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="person_max">Max {{ $trans('messages.Persons') }}</label>
  <input type="number"  id="person_max" required name="person_max" v-model="person_max" min="1" step="1" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="number"  id="person_max" required name="person_max" v-model="service.person_max" min="1" step="1" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="person_min">Min {{ $trans('messages.Persons') }}</label>
  <input type="number"  id="person_min" required name="person_min" v-model="person_min" min="1" step="1" :max="person_max" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="number"  id="person_min" required name="person_min" v-model="service.person_min" min="1" step="1" :max="service.person_max" class="form-control font-italic mb-2" v-if="operation==='update'">
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createService()" v-if="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedServices(service)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','service','operation'],
      data(){
        return {
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
          activeClass:'active',
          showClass:'show',
          name_contact:'',
          value:'',
          serv:'',
          price_high:0,
          price_low:0,
          name_contact:'',
          person_max:0,
          person_min:0,
          src:'images/lang/',
          ventanaOperServices:false,
          description:'',
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
        createService:function(){

            let  url=window.location.origin +"/admin/services";
            let msg_succ=this.$trans('messages.Services')+' '+this.$trans('messages.Created.');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.serv==''||this.name_contact=='' ||this.description=='' || this.price_high<0 || this.price_low<0 || this.person_max<0 || this.person_min<0 ) {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            let data = new FormData();
              data.append("name", this.serv);
              data.append("name_contact", this.name_contact);
              data.append("description", this.description);
              data.append("price_high", this.price_high);
              data.append("price_low", this.price_low);
              data.append("person_max", this.person_max);
              data.append("person_min", this.person_min);



            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let serviceAdd=response.data;
                          this.$emit('servicenew',serviceAdd);

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
                   if(wrong.hasOwnProperty('name')){
                     mensaje+='-'+wrong.name[0];
                   }
                   if(wrong.hasOwnProperty('name_contact')){
                     mensaje+='-'+wrong.name_contact[0];
                   }
                   if(wrong.hasOwnProperty('description')){
                     mensaje+='-'+wrong.description[0];
                   }
                   if(wrong.hasOwnProperty('price_high')){
                     mensaje+='-'+wrong.price_high[0];
                   }
                   if(wrong.hasOwnProperty('price_low')){
                     mensaje+='-'+wrong.price_low[0];
                   }
                   if(wrong.hasOwnProperty('person_max')){
                     mensaje+='-'+wrong.person_max[0];
                   }
                   if(wrong.hasOwnProperty('person_min')){
                     mensaje+='-'+wrong.person_min[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedServices:function(service){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", service.name);
                data.append("name_contact", service.name_contact);
                data.append("description", service.description);
                data.append("price_high", service.price_high);
                data.append("price_low", service.price_low);
                data.append("person_max", service.person_max);
                data.append("person_min", service.person_min);
              url=window.location.origin +"/admin/services/"+service.id;
              msg_edited=this.$trans('messages.Services')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Services'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let serviceUpdate=response.data;
                         this.$emit('serviceoperupd',serviceUpdate);
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
                 if(wrong.hasOwnProperty('name_contact')){
                   mensaje+='-'+wrong.name_contact[0];
                 }
                 if(wrong.hasOwnProperty('description')){
                   mensaje+='-'+wrong.description[0];
                 }
                 if(wrong.hasOwnProperty('price_high')){
                   mensaje+='-'+wrong.price_high[0];
                 }
                 if(wrong.hasOwnProperty('price_low')){
                   mensaje+='-'+wrong.price_low[0];
                 }
                 if(wrong.hasOwnProperty('person_max')){
                   mensaje+='-'+wrong.person_max[0];
                 }
                 if(wrong.hasOwnProperty('person_min')){
                   mensaje+='-'+wrong.person_min[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {

         },
        mounted() {
          if (this.locale) {
               this.$lang.setLocale(this.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
