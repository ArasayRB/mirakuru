<template>

            <form id="reservation" class="mt-5">
              <div class="container mt-5"><h1 class="text-center text-light mt-5 mb-5">{{ $trans('messages.Book Now!') }}</h1>
                <div class="row justify-content-center">
                  <div class="col-6">
                    <input type="text" name="nombre" v-model="name" class="form-control font-italic mb-2" placeholder="Nombre Completo/Full Name...">
                    <input type="text" name="dir" v-model="adress" class="form-control font-italic mb-2" placeholder="Dirección/Adress...">
                    <input type="tel" name="tel" v-model="phone" class="form-control font-italic mb-2" placeholder="Teléfono/Phone...">
                      <input type="email" name="email" v-model="email" class="form-control font-italic mb-2" placeholder="Correo/Email...">
                      <label for="services" class="text-light"><span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label>
                        <br>
                                 <tags-input element-id="services" :add-tags-on-comma=true	class=""
                                    v-model="selectedServices"
                                    placeholder="Servicios/Services..."
                                    :existing-tags="services"
                                     id-field="id"
                                     text-field="name"
                                    :typeahead="true">

                                 </tags-input>


                  </div>
                  <div class="col-6">
                    <input type="number" name="personas" v-model="cant_person" min="1" :max="roomCapacityMax" step="1" class="form-control font-italic mb-2" placeholder="Huéspedes/Guests...">
                    <input type="number" name="ninos" v-model="childs" min="1" step="1" :max="childCapacityMax" class="form-control font-italic mb-2" placeholder="#Niños de Huéspedes/#Childs of Guests...">
                    <input type="date" name="fecha-entrada" v-model="date_in" class="form-control font-italic mb-2" placeholder="Entrada/In...">
                    <input type="date" name="fecha-salida" v-model="date_out" class="form-control font-italic mb-2" placeholder="Salida/Out...">
                    <label for="rooms" class="text-light"><span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label>
                    <br>
                             <tags-input element-id="rooms" :add-tags-on-comma=true	class=""
                                v-model="selectedRooms"
                                placeholder="Habitación(s)/Room(s)..."
                                :existing-tags="rooms"
                                 id-field="id"
                                 text-field="name"
                                :typeahead="true">

                             </tags-input>


                  </div>
                  <div class="col-12 form-group pt-2">
                    <label for="country" class="text-light">{{ $trans('messages.Select Country') }}</label>
                    <select class="form-control pt-2" v-model="pais" name="country" required>
                     <option value=''>{{ $trans('messages.Select Country') }}</option>
                       <option v-for="countri in countries" :value="countri.id">{{countri.name_knowing}}</option>
                    </select>
                  </div>

                  <div class="col-2 ">
                    <div class="content-justify-center"><button type="button" @click=book() class="btn w-20 rounded btn-light btn-lg mt-5 reserva">{{ $trans('messages.Book') }}</button></div>
                  </div>
                </div>
              </div>
            </form>

</template>

<script>
    export default {
      data(){
        return {
          email:'',
          name:'',
          adress:'',
          phone:'',
          rooms:[],
          selectedRooms:[],
          services:[],
          selectedServices:[],
          roomCapacityMax:0,
          childCapacityMax:0,
          countries:[],
          cant_person:'',
          childs:'',
          date_in:'',
          date_out:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
      book:function(){
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
      created: function(){
        let hostalName='Hostal Mirakuru Gran Familia';
        axios.get('/available-services/'+hostalName)
             .then(response =>{
               let hostalsServices=response.data;
               let servicesHostal=hostalsServices[0].services;

               this.services = servicesHostal;

               console.log(this.services);
             })
             .catch(error => this.errors.push(error));

             axios.get('/available-rooms/'+hostalName)
                  .then(response =>{
                  this.rooms=response.data;
                  for(var i=0; i<this.rooms.length; i++){
                    this.roomCapacityMax+=this.rooms[i].capacity;
                  }
                  this.childCapacityMax=this.roomCapacityMax-1;
                  console.log('CapAzul- '+this.roomCapacityMax);
                  })
                  .catch(error => this.errors.push(error));

                  axios.get('/countries-list')
                       .then(response => {
                         this.countries = response.data;
                         console.log(this.countries.length);
                       })
                       .catch(error => this.errors.push(error));
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
