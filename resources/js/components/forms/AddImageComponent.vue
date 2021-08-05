<template>
  <div class="">

 <div class="panel rounded border border-light">
   <div class="panel-title bg-info">
     <div class="row">
       <div class="col-10">
          <p class="text-light pt-3 text-center font-weight-bold">{{ $trans('messages.Add') }} {{ $trans('messages.Image') }}</p>
       </div>
       <div class="col-2">
          <button type="button" class="modal-default-button btn btn-lg text-light" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>
       </div>

     </div>
   </div>
   <div class="panel-body bg-muted">
     <div class="" v-for="(area,index) in areas_pictures">
       <!-- Collapsable Card Example -->
       <div class="card shadow mb-4" :id="'card_area'+area.id">
         <!-- Card Header - Accordion -->
         <a :href="'#collapseCardExample'+area.id" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" :aria-controls="'collapseCardExample'+area.id">
           <h6 class="m-0 font-weight-bold text-primary">{{area.name}}</h6>
         </a>
         <!-- Card Content - Collapse -->
         <div class="collapse show" :id="'collapseCardExample'+area.id">
           <div class="card-body">
           <form  :id="'form-update-data-img'+img_to_upd.id" v-if="area.id==img_to_upd.area_id" v-show="img_to_upd.update_bool==='true'">
             <div class="form-group">
             <label for="img_name" class="text-dark">{{ $trans('messages.Name') }}</label>
             <input type="text" name="img_name" id="img_name" class="form-control" v-model="img_to_upd.name">
             </div>
             <div class="form-group">
             <label for="img_descript" class="text-dark">{{ $trans('messages.Description') }}</label>
             <input type="text" name="img_descript" id="img_descript" class="form-control" v-model="img_to_upd.description">
             </div>
             <div>
               <button type="button" name="button-upd" class="btn btn-primary text-light font-weight-bold fa fa-check" @click="doEditImage(img_to_upd)"> {{ $trans('messages.Update') }}</button>
               <button type="button" name="button-cancel" class="btn btn-danger text-light font-weight-bold" @click="cancelEditImage(img_to_upd)">X {{ $trans('messages.Cancel') }}</button>
             </div>
           </form>
             <div class="row">
               <div class="col-md-4">
                 <form  :id="'form-upload-img'+area.id">
                   <input type="file" :name="area.id" v-on:change="image" class="form-control-file font-italic mb-2" multiple>
                   <button type="button" :name="'button'+area.id" class="btn btn-success text-light font-weight-bold fas fa-upload"@click="saveImages(index,area)"> {{ $trans('messages.Upload') }}</button>
                 </form>
               </div>
               <div class="col-md-4" v-for="(up,index) in images_uploaded">
                 <div class="card border border-info" v-if="area.id==up.area_id" v-show="up.deleted_bool=='false'">
                   <div class="card-title">
                     <p class="text-center">{{up.name}}</p>
                   </div>
                   <div class="card-body">
                   <img :src="src+hostal.slug+'/'+up.area_name+'/'+up.img_url" width="100">
                 </div>
                 <div class="card-footer">
                     <div class="caption">
                       <p class="text-center">{{up.description}}</p>
                       <div>

                           <a href="#" @click="openEditImage(index,up,'uploaded')"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                           <a href="#" @click="deleteImage(index,up.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                      </div>
                     </div>
                 </div>
                 </div>
               </div>

             </div>
           </div>
           <div class="card-footer">
             <div class="container">
                <div class="row">
                  <div  v-if="area.pictures_count>0">
                   <p class="h3 text-dark">{{ $trans('messages.Image') }}s {{ $trans('messages.Saved.') }}</p>
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                       <tr>
                         <th>{{ $trans('messages.Tools') }}</th>
                         <th>{{ $trans('messages.Name') }}</th>
                         <th>{{ $trans('messages.Description') }}</th>
                         <th>{{ $trans('messages.Image') }}</th>
                       </tr>
                     </thead>
                     <tfoot>
                       <tr>
                         <th>{{ $trans('messages.Tools') }}</th>
                         <th>{{ $trans('messages.Name') }}</th>
                         <th>{{ $trans('messages.Description') }}</th>
                         <th>{{ $trans('messages.Image') }}</th>
                       </tr>
                     </tfoot>
                     <tbody>


                           <tr v-for="(img_saved,index) in area.pictures" :key="img_saved.id">

                               <td>

                                     <a href="#" @click="openEditImage(index,img_saved,'saved',area)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                                     <a href="#" @click="deleteImage(index,img_saved.id,'saved',area)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                              </td>
                               <td>{{img_saved.name}}</td>
                               <td>{{img_saved.description}}</td>
                               <td><img :src="src+area.hostal_name+'/'+area.name+'/'+img_saved.img_url"  width="100"></td>

                           </tr>



                     </tbody>
                   </table>
                 </div>
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

 </div>

</div>

</template>

<script>
    export default {
      props:['hostal'],
      data(){
        return {
          email:'',
          areas_pictures:[],
          area_uploaded:[],
          imagesUpload:[],
          images_uploaded:[],
          img_to_upd:[],
          kind_oper:'',
          update_bool:false,
          src:window.location.origin +'/storage/hostales/',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
      image:function(e){

        this.imagesUpload={'area':e.target.name,'images':e.target.files};
      },
      saveImages:function(index,areaUpload){
        let url=window.location.origin +"/fotos";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.imagesUpload.length==0) {
          swal({title:this.$trans('messages.Warning!'),
                text:this.$trans('messages.Select A New Photo'),
                icon:'warning',
                closeOnClickOutside:false,
                closeOnEsc:false
              });
        }
        else{
        let imagesUp=this.imagesUpload['images'];
        for(var i=0;i<imagesUp.length;i++){
        let data = new FormData();
          data.append("image", imagesUp[i]);
            data.append("area", this.imagesUpload['area']);
              data.append("hostal", this.hostal.id);
          axios.post(url,data)
               .then(response=>{
                 let imag=response.data;
                 console.log('data saved-',response.data);
                 this.area_uploaded=areaUpload;
                 this.images_uploaded.push(imag);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('image')){
                   mensaje+='-'+wrong.image[0];
                 }
                 if(wrong.hasOwnProperty('area')){
                   mensaje+='-'+wrong.area[0];
                 }

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });

        }
      }


      },
      deleteImage:function(index,image,kind='',area=[]){
        let image_id=image;
          swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Image'),
                text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Image')+'?',
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
                  let  url=window.location.origin +'/fotos/'+image_id;
                  axios.delete(url)
                       .then(response=>{
                         swal({title:this.$trans('messages.Correct data'),
                               text:this.$trans('messages.Image')+' '+this.$trans('messages.Deleted'),
                               icon:'success',
                               closeOnClickOutside:false,
                               closeOnEsc:false
                             }).then(select=>{
                               if (select){
                                 if(kind=='saved')
                                 {
                                   this.listAreasPictures();
                                 }
                                 else
                                 {
                                   let pos_del=this.images_uploaded.findIndex(img=>img.id===image);
                                   this.images_uploaded[pos_del]['deleted_bool']='true';
                                 }
                               }
                             });
                       })
                       .catch(error=>{
                         let wrong=error.response.data.errors;
                         swal('Error',mensaje,'error');
                       });
                }
              });
      },
      openEditImage:function(index,up,kind,area=[]){
        //this.update_bool=true;
        let position;
        if(kind==='uploaded')
        {
          position=this.images_uploaded.findIndex(img=>img.id===up.id);
          this.images_uploaded[position]['update_bool']='true';
          this.img_to_upd=this.images_uploaded[position];
          this.kind_oper='uploaded';
        }
        else if(kind==='saved'){
         let pos_area=this.areas_pictures.findIndex(are=>are.id===area.id);
         let pictures=this.areas_pictures[pos_area]['pictures'];
         position=pictures.findIndex(im=>im.id===up.id);
         pictures[position]['update_bool']='true';
         this.img_to_upd=pictures[position];
         this.kind_oper='saved';
        }
      },
      cancelEditImage:function(img_to_upd,kind=''){

      this.img_to_upd=[];
      },
      doEditImage:function(img_to_upd){
        let url=window.location.origin +"/fotos/"+this.img_to_upd['id'];
        let config= { headers: {"Content-Type": "multipart/form-data" }};
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.img_to_upd.length==0) {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }
        let data = new FormData();
          data.append('_method', 'patch');
          data.append("name", this.img_to_upd['name']);
          data.append("description", this.img_to_upd['description']);
          axios.post(url,data,config)
               .then(response=>{
                 let imag=response.data;
                 this.cancelEditImage(imag,this.kind_oper);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 if(wrong.hasOwnProperty('description')){
                   mensaje+='-'+wrong.description[0];
                 }

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });


      },
      listAreasPictures:function(){
        axios.get(window.location.origin +'/admin/areaPictureList/'+this.hostal.id)
             .then(response =>{
                    this.areas_pictures = response.data;
       })
          .catch(error => this.errors.push(error));
      },
      },
        mounted() {
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        },
        created:function(){
          this.listAreasPictures();
        }
    }
</script>
