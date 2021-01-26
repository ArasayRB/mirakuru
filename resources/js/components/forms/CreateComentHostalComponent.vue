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
        <label for="estrellas1" class="font-weight-bold text-light">{{ $trans('messages.Clean') }} {{ $trans('messages.Value') }}
  <p class="clasificacion">
  <input id="radio1" type="radio" v-model="clean_value" name="estrellas1" value="5">
  <label for="radio1">★</label>
  <input id="radio2" type="radio" v-model="clean_value" name="estrellas1" value="4">
  <label for="radio2">★</label>
  <input id="radio3" type="radio" v-model="clean_value" name="estrellas1" value="3">
  <label for="radio3">★</label>
  <input id="radio4" type="radio" v-model="clean_value" name="estrellas1" value="2">
  <label for="radio4">★</label>
  <input id="radio5" type="radio" v-model="clean_value" name="estrellas1" value="1">
  <label for="radio5">★</label>
 </p></label><br>
    <label for="estrellas2" class="font-weight-bold text-light">{{ $trans('messages.Location') }} {{ $trans('messages.Value') }}
  <p class="clasificacion">
  <input id="radio6" type="radio" v-model="location_value" name="estrellas2" value="5">
  <label for="radio6">★</label>
  <input id="radio7" type="radio" v-model="location_value" name="estrellas2" value="4">
  <label for="radio7">★</label>
  <input id="radio8" type="radio" v-model="location_value" name="estrellas2" value="3">
  <label for="radio8">★</label>
  <input id="radio9" type="radio" v-model="location_value" name="estrellas2" value="2">
  <label for="radio9">★</label>
  <input id="radio10" type="radio" v-model="location_value" name="estrellas2" value="1">
  <label for="radio10">★</label>
  </p></label>
  </div>
  <div class="col-md-6 col-sm-12">
    <label class="font-weight-bold text-light">{{ $trans('messages.Confort') }} {{ $trans('messages.Value') }}
 <p class="clasificacion">
 <input id="radio11" type="radio" v-model="confort_value" name="estrellas3" value="5">
 <label for="radio11">★</label>
 <input id="radio12" type="radio" v-model="confort_value" name="estrellas3" value="4">
 <label for="radio12">★</label>
 <input id="radio13" type="radio" v-model="confort_value" name="estrellas3" value="3">
 <label for="radio13">★</label>
 <input id="radio14" type="radio" v-model="confort_value" name="estrellas3" value="2">
 <label for="radio14">★</label>
 <input id="radio15" type="radio" v-model="confort_value" name="estrellas3" value="1">
 <label for="radio15">★</label>
 </p></label><br>
 <label class="font-weight-bold text-light">{{ $trans('messages.Services') }} {{ $trans('messages.Value') }}
 <p class="clasificacion">
 <input id="radio16" type="radio" v-model="services_value" name="estrellas4" value="5">
 <label for="radio16">★</label>
 <input id="radio17" type="radio" v-model="services_value" name="estrellas4" value="4">
 <label for="radio17">★</label>
 <input id="radio18" type="radio" v-model="services_value" name="estrellas4" value="3">
 <label for="radio18">★</label>
 <input id="radio19" type="radio" v-model="services_value" name="estrellas4" value="2">
 <label for="radio19">★</label>
 <input id="radio20" type="radio" v-model="services_value" name="estrellas4" value="1">
 <label for="radio20">★</label>
 </p></label>
 </div>
 <div class="col-md-12 col-sm-12">
 <label class="mb-md-2 pt-md-5 font-weight-bold text-light">{{ $trans('messages.Hosters Atention') }} {{ $trans('messages.Value') }}
 <p class="clasificacion">
 <input id="radio21" type="radio" v-model="hoster_atention_value" name="estrellas5" value="5">
 <label for="radio21">★</label>
 <input id="radio22" type="radio" v-model="hoster_atention_value" name="estrellas5" value="4">
 <label for="radio22">★</label>
 <input id="radio23" type="radio" v-model="hoster_atention_value" name="estrellas5" value="3">
 <label for="radio23">★</label>
 <input id="radio24" type="radio" v-model="hoster_atention_value" name="estrellas5" value="2">
 <label for="radio24">★</label>
 <input id="radio25" type="radio" v-model="hoster_atention_value" name="estrellas5" value="1">
 <label for="radio25">★</label>
 </p></label>
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
          hoster_atention_value:0,
          services_value:0,
          confort_value:0,
          location_value:0,
          ventanaReview:false,
          clean_value:0,
          src:'/storage/img_web/login_img/',
          token   : window.CSRF_TOKEN,

        }
      },

      methods:{
        sendReview:function(){
          let url="/comentario-hostal";
          let mensaje=this.$trans('messages.Unidentified error');
          if (this.review_value==''||this.this==0||this.services_value==0||this.confort_value==0||this.location_value==0||this.clean_value==0) {
            mensaje=this.$trans('messages.You cannot leave empty fields, please check');
          }
          let data = new FormData();
            data.append("review_value", this.review_value);
            data.append("hoster_atention_value", this.hoster_atention_value);
            data.append("services_value", this.services_value);
            data.append("confort_value", this.confort_value);
            data.append("location_value", this.location_value);
            data.append("clean_value", this.clean_value);
            data.append("hostal_name", this.books[0].hostal_name);

            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:this.$trans('messages.Thanks!'),
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });

                      this.$emit('closereviewmodal');
                 })
                 .catch(error=>{
                   if(error.response.data.message){
                     swal('Error',''+error.response.data.message,'error');
                   }
                   let wrong=error.response.data.errors;
                   if(wrong.hasOwnProperty('review_value')){
                     mensaje+='-'+wrong.review_value[0];
                   }
                   if(wrong.hasOwnProperty('hoster_atention_value')){
                     mensaje+='-'+wrong.hoster_atention_value[0];
                   }
                   if(wrong.hasOwnProperty('services_value')){
                     mensaje+='-'+wrong.services_value[0];
                   }
                   if(wrong.hasOwnProperty('confort_value')){
                     mensaje+='-'+wrong.confort_value[0];
                   }
                   if(wrong.hasOwnProperty('location_value')){
                     mensaje+='-'+wrong.location_value[0];
                   }
                   if(wrong.hasOwnProperty('clean_value')){
                     mensaje+='-'+wrong.clean_value[0];
                   }

                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });
        },
      },

        mounted() {
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
