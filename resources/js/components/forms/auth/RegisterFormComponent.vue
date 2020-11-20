<template>
<section class="mb-5" id="register" name="register"><!--Formulario login-->
  <form  id="form-login">
    <transition class="modal fade pt-5" id="registerModal">
      <div class="modal-mask">
  <div class="modal-wrapper">
  <div class="modal-container bg-primary">
    <div class="modal-header">
      <slot>
        <div class="col justify-content-center">
      <img :src="imgPpal" class="bg-primary mx-auto d-block py-2 px-2 ">
      <div class=" bg-primary"><h1 class="text-center text-light">{{ $trans('messages.Register') }}</h1>
        </div>
        </div>
      </slot>
    </div>

  <div class="modal-body bg-primary">
    <slot>
   <div class="row justify-content-center">
     <div class="col">
       <div class="form-group row">
           <label for="name" class="col-md-4 col-form-label text-md-right text-light">{{ $trans('messages.Name') }}</label>

           <div class="col-md-6">
               <input id="name" type="text" v-model="name" class="form-control" name="name" required autocomplete="name" autofocus>


           </div>
       </div>
       <div class="form-group row">
           <label for="email" class="col-md-4 col-form-label text-md-right text-light">{{ $trans('messages.E-Mail Address') }}</label>

           <div class="col-md-6">
               <input id="email" type="email" v-model="email" class="form-control" name="email" required autocomplete="email">

           </div>
       </div>
       <div class="form-group row">
           <label for="password" class="col-md-4 col-form-label text-md-right text-light">{{ $trans('messages.Password') }}</label>

           <div class="col-md-6">
               <input id="password" type="password" v-model="password" class="form-control" name="password" required autocomplete="new-password">

           </div>
       </div>
       <div class="form-group row">
           <label for="password-confirm" class="col-md-4 col-form-label text-md-right text-light">{{ $trans('messages.Confirm Password') }}</label>

           <div class="col-md-6">
               <input id="password-confirm" type="password" v-model="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
            <div class="col-md-6 offset-md-4">
                <button type="button" class="btn btn-primary bg-dark" @click=registerUser()>
                    {{ $trans('messages.Register') }}
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
          urlRegister:this.$attrs.urlregister,
          name:'',
          email    : '',
          password:'',
          password_confirmation:'',
          ventanaRegister:false,
          labelForgPass:this.$attrs.labelforgpass,
          forgPass:this.$attrs.forgpass,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{

        registerUser: function(){
          let url=this.urlRegister;
          let mensaje=this.$trans('messages.Unidentified error');
          if (this.email==''||this.password==''||this.password_confirmation==''||this.name=='') {
            mensaje=this.$trans('messages.You cannot leave empty fields, please check');
          }
          let data={
            name:this.name,
            email:this.email,
            password:this.password,
            password_confirmation:this.password_confirmation,
          };
          axios.post(url,data)
               .then(response=>{
                 swal({title:this.$trans('messages.Correct data'),
                       text:this.$trans('messages.You have successfully registered'),
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         location.href='/register-user';
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 console.log(error.response.data.errors);
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                if (wrong.hasOwnProperty('password')) {
                   mensaje+='-'+wrong.password[0];
                 }
                 if (wrong.hasOwnProperty('password_confirm')) {
                    mensaje+='-'+wrong.password_confirm[0];
                  }
                 else if (wrong.hasOwnProperty('login')){
                   mensaje+='-'+wrong.login[0];
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
