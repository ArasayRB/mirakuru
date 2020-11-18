<template>
<section class="mb-5" id="login" name="login"><!--Formulario login-->
  <form  id="form-login">
    <transition class="modal fade pt-5" id="loginModal">
      <div class="modal-mask">
  <div class="modal-wrapper">
  <div class="modal-container bg-primary">
    <div class="modal-header">
      <slot>
        <div class="col justify-content-center">
      <img :src="imgPpal" class="bg-primary mx-auto d-block py-2 px-2 ">
      <div class=" bg-primary"><h1 class="text-center text-light">{{ titleLogin }}</h1>
        </div>
        </div>
      </slot>
    </div>

  <div class="modal-body bg-primary">
    <slot>
   <div class="row justify-content-center">
     <div class="col">




      <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right text-light">{{ labelEmail }}</label>

          <div class="col-md-6">
              <input id="email" v-model="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>

          </div>
      </div>

      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right text-light">{{ labelPass }}</label>

          <div class="col-md-6">
              <input id="password" v-model="password" type="password" class="form-control" name="password" required autocomplete="current-password">

          </div>
      </div>

      <div class="form-group row">
          <div class="col-md-6 offset-md-4">

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
            <button type="button" class="btn btn-primary bg-dark" @click=startSession()>
                {{ titleLogin }}
            </button>
            <button type="button" class="modal-default-button btn btn-danger" @click="$emit('close')">Cerrar</button>


                <a class="btn btn-link text-light" href="#" id="show-reset-modal" @click="openReset()">
                    Forgot Your Password?
                </a>
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
          urlLogin:this.$attrs.urllogin,
          urlReset:this.$attrs.urlreset,
          email    : '',
          password:'',
          ventanaLogin:false,
          labelPass:this.$attrs.labelpass,
          labelForgPass:this.$attrs.labelforgpass,
          forgPass:this.$attrs.forgpass,
          oldEmail:this.$attrs.oldemail,
          labelEmail:this.$attrs.labelemail,
          titleLogin:this.$attrs.titlelogin,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{

        startSession: function(){
          let url=this.urlLogin;
          let mensaje='Error no identificado';
          if (this.email==''||this.password=='') {
            mensaje='No puede dejar campos vacíos, revise por favor';
          }
          let data={
            email:this.email,
            password:this.password
          };
          axios.post(url,data)
               .then(response=>{
                 swal({title:'Usted ha iniciado sesión satisfactoriamente',
                       text:'Datos correctos',
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
                if (wrong.hasOwnProperty('password')) {
                   mensaje+='-'+wrong.password[0];
                 }
                 else if (wrong.hasOwnProperty('login')){
                   mensaje+='-'+wrong.login[0];
                 }
                 swal('Error',mensaje,'error');
                 console.log(error.response.data);
               });

        },
        openReset:function(){
          this.$emit('openresetemailmodal');
        }


      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
