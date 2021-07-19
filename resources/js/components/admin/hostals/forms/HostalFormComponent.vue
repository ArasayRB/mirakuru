<template>
  <section class="mb-5" id="createHostalModal" name="createHostalModal"><!--Formulario createHostalModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createHostalModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Hostals') }}</h1>
        <h1 class="text-center text-dark" v-if="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Hostals') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

                 <div class="form-group">
                   <label for="host">{{ $trans('messages.Name') }}</label>
                   <input type="host" name="host" v-model="host" class="form-control font-italic mb-2" v-if="operation==='add'">
                   <input type="host" name="host" v-model="hostal.name" class="form-control font-italic mb-2" v-if="operation==='update'">
                 </div>
                 <div class="form-group">
                   <label for="tel">{{ $trans('messages.Phone') }}</label>
                   <input type="tel" id="tel" name="tel"  v-model="phone" class="form-control font-italic mb-2" pattern="\x2b[0-9]+" size="15" v-if="operation==='add'">
                   <input type="tel" id="tel" name="tel"  v-model="hostal.phone" class="form-control font-italic mb-2" pattern="\x2b[0-9]+" size="15" v-if="operation==='update'">
                 </div>
                 <div class="form-group">
                   <label for="address">{{ $trans('messages.Adress') }}</label>
                   <input type="text" id="address" name="address"  v-model="address" class="form-control font-italic mb-2" v-if="operation==='add'">
                   <input type="text" id="address" name="address"  v-model="hostal.address" class="form-control font-italic mb-2" v-if="operation==='update'">
                 </div>

                    <div class="form-group">
                      <label for="email">{{ $trans('messages.Email') }}</label>
                      <input type="email" name="email" v-model="email" class="form-control font-italic mb-2" v-if="operation==='add'">
                      <input type="email" name="email" v-model="hostal.email" class="form-control font-italic mb-2" v-if="operation==='update'">
                    </div>
                    <div class="form-group">

                      <label for="image">{{ $trans('messages.Image') }}</label>
                    <input type="file" name="image" v-on:change="image" class="form-control-file font-italic mb-2">
                    <div class="row" v-if="operation==='update'">
                      <img :src="src+hostal.img_ppal_url" :alt="hostal.img_ppal_url" width="100">
                    </div>
                    </div>
                    <div class="form-group">
                       <label>{{ $trans('messages.Tags') }} : <span class="text-danger">*</span></label>
                       <br>
                       <tags-input element-id="tags" :add-tags-on-comma=true	class=""
                          v-model="selectedTags"
                          :existing-tags="tags"
                          id-field="key"
                          text-field="value"
                          :typeahead="true">
                       </tags-input>

                    </div>

                    <div class="form-group">
                      <label for="title">{{ $trans('messages.Keywords') }}: <span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label></label>

                      <tags-input element-id="keys" :add-tags-on-comma=true	class=""
                        v-model="selectedKeys"
                        placeholder="Add a keyword"
                        :existing-tags="keywords"
                        id-field="key"
                        text-field="value"
                        :typeahead="true">
                      </tags-input>

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
            <button type="button" class="btn rounded btn-primary reserva" @click="createHostal()" v-if="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedHostals(hostal)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','hostal','operation'],
      data(){
        return {
          tags: [],
          selectedTags: [],
          msgAddTag:this.$trans('messages.Add a new Tag'),
          keywords: [],
          selectedKeys: [],
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
          phone:'',
          value:'',
          host:'',
          email:0,
          src:'images/lang/',
          ventanaOperHostals:false,
          address:'',
          error:'',
          imagenHostal:'',
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

      this.imagenHostal=e.target.files[0];
    },
    availableTags:function(){
            axios.get('/available-tags')
                 .then(response =>{
                        this.tags = response.data;
                                  })
                 .catch(error => this.errors.push(error));
           },
     availableKeywords:function(){
            axios.get('/available-keys')
                 .then(response =>{
                        this.keywords = response.data;
           })
              .catch(error => this.errors.push(error));
            },
        createHostal:function(){

            let  url=window.location.origin +"/admin/hostals";
            let msg_succ=this.$trans('messages.Hostals')+' '+this.$trans('messages.Created.');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.host==''||this.phone=='' || this.imagenHostal=='' ||this.address==''||this.email==''||this.selectedTags==''||this.selectedKeys=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            let data = new FormData();
              data.append("name", this.host);
              data.append("phone", this.phone);
              data.append("image", this.imagenHostal);
              data.append("address", this.address);
              data.append("email", this.email);

              let tagsList=this.selectedTags;
              let hostTags="";
              for(var i=0; i<tagsList.length;i=i+1){
                if(i==(tagsList.length-1)){
                hostTags= ''+hostTags+tagsList[i].value;
              }
              else{
                hostTags= ''+hostTags+tagsList[i].value+',';
              }
              }

              let keysList=this.selectedKeys;
              let hostKeys="";
              for(var i=0; i<keysList.length;i=i+1){
                if(i==(keysList.length-1)){
                hostKeys= ''+hostKeys+keysList[i].value;
              }
              else{
                hostKeys= ''+hostKeys+keysList[i].value+',';
              }
              }

              data.append("tags", hostTags);
              data.append("keywords", hostKeys);

            axios.post(url,data)
                 .then(response=>{
                   let hostalAdd=response.data;
                     if(hostalAdd['exception']=='Error'){
                       swal({title:this.$trans('messages.Whoops! Something went wrong.'),
                             text:this.$trans('messages.'+hostalAdd['message']),
                             icon:'warning',
                             closeOnClickOutside:false,
                             closeOnEsc:false
                           }).then(select=>{
                             if (select){
                              this.$emit('hostalnew',hostalAdd);

                               //location.reload();
                             }
                           });
                     }
                     else{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                          this.$emit('hostalnew',hostalAdd);

                           //location.reload();
                         }
                       });
                     }
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
                   if(wrong.hasOwnProperty('phone')){
                     mensaje+='-'+wrong.phone[0];
                   }
                   if(wrong.hasOwnProperty('address')){
                     mensaje+='-'+wrong.address[0];
                   }
                   if(wrong.hasOwnProperty('image')){
                     mensaje+='-'+wrong.image[0];
                   }
                   if(wrong.hasOwnProperty('email')){
                     mensaje+='-'+wrong.email[0];
                   }
                  if (wrong.hasOwnProperty('tags')) {
                     mensaje+='-'+wrong.tags[0];
                   }
                   if (wrong.hasOwnProperty('keywords')) {
                      mensaje+='-'+wrong.keywords[0];
                    }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedHostals:function(hostal){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", hostal.name);
                data.append("phone", hostal.phone);
                data.append("image", this.imagenHostal);
                data.append("address", hostal.address);
                data.append("email", hostal.email);
                let tagsList=this.selectedTags;
                let hostTags="";
                for(var i=0; i<tagsList.length;i=i+1){
                  if(i==(tagsList.length-1)){
                  hostTags= ''+hostTags+tagsList[i].value;
                }
                else{
                  hostTags= ''+hostTags+tagsList[i].value+',';
                }
                }

                let keysList=this.selectedKeys;
                let hostKeys="";
                for(var i=0; i<keysList.length;i=i+1){
                  if(i==(keysList.length-1)){
                  hostKeys= ''+hostKeys+keysList[i].value;
                }
                else{
                  hostKeys= ''+hostKeys+keysList[i].value+',';
                }
                }

                data.append("tags", hostTags);
                data.append("keywords", hostKeys);
              url=window.location.origin +"/admin/hostals/"+hostal.id;
              msg_edited=this.$trans('messages.Hostals')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Hostals'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let hostalUpdate=response.data;
                         this.$emit('hostaloperupd',hostalUpdate);
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
                 if(wrong.hasOwnProperty('phone')){
                   mensaje+='-'+wrong.phone[0];
                 }
                 if(wrong.hasOwnProperty('address')){
                   mensaje+='-'+wrong.address[0];
                 }
                 if(wrong.hasOwnProperty('image')){
                   mensaje+='-'+wrong.image[0];
                 }
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                if (wrong.hasOwnProperty('tags')) {
                   mensaje+='-'+wrong.tags[0];
                 }
                 if (wrong.hasOwnProperty('keywords')) {
                    mensaje+='-'+wrong.keywords[0];
                  }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
        for(var i=0; i<this.hostal.tags.length;i++){
          this.selectedTags.push({'key':'',
                                    'value':this.hostal.tags[i].name});
        }

        for(var i=0; i<this.hostal.keywords.length;i++){
          this.selectedKeys.push({'key':'',
                                    'value':this.hostal.keywords[i].name});
        }
        this.availableTags();
        this.availableKeywords();
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
