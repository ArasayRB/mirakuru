<template>


    <transition class="modal fade pt-5" id="contactoModal">
      <div class="modal-mask">
  <div class="modal-wrapper">
  <div class="modal-container">
    <div class="modal-header">
      <slot>
        <div class="col justify-content-center">

      <div class=""><h1 class="text-center text-dark">{{ $trans('messages.Contact') }}</h1>
        </div>
        </div>
      </slot>
    </div>

  <div class="modal-body">
    <slot>
    <div class="row justify-content-center">
      <div class="col-6">
    <form id="form-contacto">
        <input type="text" v-model="email" class="form-control font-italic mt-5" placeholder="Email/Correo...">
        <input type="text" v-model="name" class="form-control font-italic mt-2" placeholder="Name/Nombre...">
        <textarea name="mensaje" v-model="mensage" class="form-control font-italic mt-2" id="" cols="33" rows="2" placeholder="Your message/Su mensaje..."></textarea>
       <button type="button" class="btn btn-primary rounded btn-lg mt-3" @click=contact()>{{ $trans('messages.Send') }}</button>
       <button type="button" class="btn btn-danger rounded btn-lg mt-3" @click="$emit('close')">{{ $trans('messages.Close') }}</button>
    </form>
    </div>
    <div class="col-6">
    <section class="info-contact">
      <div class="container mt-5">
          <div class="tel-fijo"><p><mark class="bg-dark text-light">{{ $trans('messages.Landline') }}: <br></mark>+53-41993797</p></div>
          <div class="movil"><p><mark class="bg-dark text-light">{{ $trans('messages.Mobile Phone') }} Arasay: <br></mark>+53-53419001</p>
          <p><mark class="bg-dark text-light">{{ $trans('messages.Mobile Phone') }} Youblián: <br></mark>+53-52474269</p></div>
          <div class="email"> <p><mark class="bg-dark text-light">{{ $trans('messages.Email') }}: <br></mark>hostalgranfamilia@gmail.com</p></div>
          <div class="direc"><p><mark class="bg-dark text-light">{{ $trans('messages.Adress') }}: <br></mark>{{ $trans('messages.At 180A Camilo Cienfuegos, between José Martí and Miguel Calzada street. Trinidad, Sancti Spíritus, Cuba. PC: 62600') }}</p></div>
        </div>
    </section>
    </div>
    </div>


    </slot>
  </div>

  </div>
  </div>
  </div>
</transition>

</template>

<script>
    export default {
      data(){
        return {
          email:this.$attrs.email,
          name:'',
          mensage:'',
          ventanaContact:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
      contact:function(){

        let url="/contact";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email==''||this.name==''||this.mensage=='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }
        let data = new FormData();
            data.append("email", this.email);
            data.append("name", this.name);
            data.append("token", this.token);
            data.append("mensage", this.mensage);
            data.append("hostal_id", 'Hostal Mirakuru Gran Familia');

          axios.post(url,data)
               .then(response=>{
                 let contact=response.data;
                 this.ventanaContact=false;
                 swal({title:this.$trans('messages.Message sended'),
                       text:this.$trans('messages.You go to receive an answare as soon like be possible!'),
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
          this.blockedDays={'start': null,'end': new Date()};
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
