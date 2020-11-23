<template>
<section class="mb-5" id="resetpasw" name="resetpasw"><!--Formulario login-->
  <form  id="form-login">
    <transition class="modal fade pt-5" id="resetpaswModal">
      <div class="modal-mask">
  <div class="modal-wrapper">
  <div class="modal-container bg-primary">
    <div class="modal-header">
      <slot>
        <div class="col justify-content-center">
      <img :src="imgPpal" class="bg-primary mx-auto d-block py-2 px-2 ">
      <div class=" bg-primary"><h1 class="text-center text-light">{{ $trans('messages.Send Password Reset Link') }}</h1>
        </div>
        </div>
      </slot>
    </div>

  <div class="modal-body bg-primary">
    <slot>
      <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right
          text-light">{{ $trans('messages.E-Mail Address') }}</label>

          <div class="col-md-6">
              <input id="email" type="email" v-model="email" class="form-control" name="email" required autocomplete="email" autofocus>

          </div>
      </div>
    </slot>
  </div>
  <div class="modal-footer">
    <slot>
      <div class="col justify-content-center">
        <div class="form-group row mb-0">
            <div class="col-md-5 offset-md-4">

                  <button type="button" class="btn btn-primary bg-dark" @click=resetPassword()>
                      {{ $trans('messages.Send') }}
                  </button>
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
    export default {
      data(){
        return {
          imgPpal:this.$attrs.imgppal,
          urlResetEmail:this.$attrs.urlresetemail,
          name:'',
          email    : '',
          ventanaResetEmail:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{

        resetPassword: function(){
          let url=this.urlResetEmail;
          let mensaje=this.$trans('messages.Unidentified error');
          if (this.email=='') {
            mensaje=this.$trans('messages.You cannot leave empty fields, please check');
          }
          let data={
            email:this.email,
            token:this.token,
          };
          axios.post(url,data)
               .then(response=>{
                 swal({title:this.$trans('messages.Check your email. Link password reset sent'),
                       text:this.$trans('messages.You must receive in your email a link that you must access to continue with the password change'),
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         location.reload();
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                 swal('Error',mensaje,'error');
                 console.log(error.response.data);
               });

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
