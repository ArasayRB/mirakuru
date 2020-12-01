<template>

  <form id="newsletter" class="mt-5">
    <div class="container mt-5"><h4 class="text-uppercase text-center mt-5 mb-5">{{ $trans('messages.Subscribe yourself and receive our offer and informations') }}</h4>
      <div class="row justify-content-center">
        <div class="col-2 d-block">
        </div>
        <div class="col-6"><input type="text" v-model="email" class="form-control font-italic" placeholder="Email/Correo..."></div>
        <div class="col-2"><img src="/images/img/enviar.png" alt="" type="button" @click=suscribe() id="enviar-news" class="btn rounded px-2 py-2 newsletter"></div>
      </div>
    </div>
  </form>

</template>

<script>
    export default {
      data(){
        return {
          email:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
      suscribe:function(){
        let url="/suscripcion";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email=='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }
        let data = new FormData();
          data.append("email", this.email);

          axios.post(url,data)
               .then(response=>{
                 swal({title:this.$trans('messages.Correct data'),
                       text:this.$trans('messages.Thank you for subscribe!'),
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        //alert('Hola');
      }
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
