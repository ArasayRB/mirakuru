<template>
  <transition class="modal fade pt-5" id="reviewModal">
    <div class="modal-mask">
<div class="modal-wrapper">
<div class="modal-container bg-primary">
  <form class="text-center" id="form3">
  <div class="modal-header">
    <slot>
      <div class="col justify-content-center">
    <div class=" bg-primary"><h1 class="text-center text-light">"{{books[0].hostal_name}}" <br> {{ $trans('messages.Leave your review') }}!</h1>
      </div>
      </div>
    </slot>
  </div>

<div class="modal-body bg-primary">
  <slot>
    <div class="panel-header row justify-content-center">
      <div class="col-md-6 col-sm-12">
        <label for="estrellas1" v-for="(indice,index) in indices" class="font-weight-bold text-light text-uppercase mr-3">{{ indice.name }} {{ $trans('messages.Value') }}
  <p class="clasificacion">
  <input :id="'radio1'+index" type="radio" v-model="indices_value[index]" :name="'estrellas'+index" value="5">
  <label :for="'radio1'+index">★</label>
  <input :id="'radio2'+index" type="radio" v-model="indices_value[index]" :name="'estrellas'+index" value="4">
  <label :for="'radio2'+index">★</label>
  <input :id="'radio3'+index" type="radio" v-model="indices_value[index]" :name="'estrellas'+index" value="3">
  <label :for="'radio3'+index">★</label>
  <input :id="'radio4'+index" type="radio" v-model="indices_value[index]" :name="'estrellas'+index" value="2">
  <label :for="'radio4'+index">★</label>
  <input :id="'radio5'+index" type="radio" v-model="indices_value[index]" :name="'estrellas'+index" value="1">
  <label :for="'radio5'+index">★</label>
 </p></label><br>
  </div>
 <div class="col-md-12 col-sm-12 text-center">
   <label class="mb-2 font-weight-bold text-light" for="comentario">{{ $trans('messages.Review') }}
   <input type="text" v-model="review_value" class="form-control" id="comentario" name="comentario" value=""></label>
 </div>
    </div>
  </slot>
</div>
<div class="modal-footer">
  <slot>
    <div class="col justify-content-center">
  <div class="form-group row mb-0">
      <div class="col-md-5 offset-md-4">
          <a href="#" type="button" @click="sendReview()" class="btn btn-dark text-light">{{ $trans('messages.Send') }}</a>
          <button type="button" class="modal-default-button btn btn-danger" @click="$emit('close')">{{ $trans('messages.Close') }}</button>
      </div>
  </div>
  </div>
  </slot>
</div>
</form>
</div>
</div>
</div>
</transition>

</template>

<script>
    export default {
      props:['books'],
      data(){
        return {
          review_value:'',
          indices:[],
          indices_value:[],
          ventanaReview:false,
          src:'/storage/img_web/login_img/',
          token   : window.CSRF_TOKEN,

        }
      },

      methods:{
        searchIndices:function(){
          axios.get('/indices-valuation-hostal')
              .then(response =>{
                this.indices=response.data;
              });
        },
        sendReview:function(){
          console.log(this.indices_value);
          let indices_id=[];
          for(var i=0; i<this.indices.length;i++){
            indices_id[i]=this.indices[i].id;
          }

          let url="/comentario-hostal";
          let mensaje=this.$trans('messages.Unidentified error');
          if (this.review_value==''||this.indices_value.length!=this.indices.length) {
            mensaje=this.$trans('messages.You cannot leave empty fields, please check');
          }
          let data = new FormData();
            data.append("review_value", this.review_value);
            data.append("indices", indices_id);
            data.append("indices_value", this.indices_value);
            data.append("hostal_name", this.books[0].hostal_name);

            axios.post(url,data)
                 .then(response=>{
                   if(response.data==='You cannot leave empty fields, please check'){
                     swal('Error',''+this.$trans('messages.'+response.data+''),'error');
                   }
                  else{
                     swal({title:this.$trans('messages.Correct data'),
                         text:this.$trans('messages.Thanks!'),
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });


                      this.$emit('closereviewmodal');
                    }
                 })
                 .catch(error=>{
                   if(error.response.data.message){
                     swal('Error',''+error.response.data.message,'error');
                   }
                   let wrong=error.response.data.errors;
                   if(wrong.hasOwnProperty('review_value')){
                     mensaje+='-'+wrong.review_value[0];
                   }
                   if(wrong.hasOwnProperty('indices')){
                     mensaje+='-'+wrong.indices[0];
                   }
                   if(wrong.hasOwnProperty('indices_value')){
                     mensaje+='-'+wrong.indices_value[0];
                   }
                   if(wrong.hasOwnProperty('hostal_name')){
                     mensaje+='-'+wrong.hostal_name[0];
                   }

                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });
        },
      },

        mounted() {
          this.searchIndices();
console.log(this.books);

          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
