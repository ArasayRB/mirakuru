<template>

            <form id="reservation" class="mt-5">
              <div class="container mt-5"><h1 class="text-center text-light mt-5 mb-5">{{ $trans('messages.Book Now!') }}</h1>

                <div class="alert alert-success" id='mensage'>
                  <button type="button" class="modal-default-button btn btn-lg" @click="esconderMensage()"><span aria-hidden="true">&times;</span></button>
                  <ul>
                    <li>{{ $trans('messages.Select first how many rooms do you need for see what days are available in calendar') }}</li>
                  </ul>
                </div>

                <div class="row justify-content-center">
                  <div class="col-3">

                  </div>
                  <div class="col-6 col-sm-12 col-xs-12 col-md-8 pb-2 justify-content-center">

                  <vc-date-picker v-model="range"
                  is-range class="pb-2"
                  :model-config="modelConfig"
                  :disabled-dates='blockedDays'>
                    <template v-slot="{ inputValue, inputEvents }">
                     <div class="flex justify-center items-center col-12">
                         <i class="fas fa-calendar-alt pb-2"></i>
                         <input
                           :value="inputValue.start"
                           v-on="inputEvents.start"
                           placeholder=" Entrada/ Date in"
                           class="border px-2 py-1 pb-2 w-32 rounded focus:outline-none focus:border-indigo-300"
                         />
                       </br>
                         <i class="fas fa-calendar-alt pb-2"></i>
                         <input
                           :value="inputValue.end"
                           v-on="inputEvents.end"
                           placeholder="Salida/ Date out"
                           class="border px-2 py-1 pb-2 w-32 rounded focus:outline-none focus:border-indigo-300"
                          />
                     </div>
                    </template>
                  </vc-date-picker>
                </div>
                <div class="col-3 col-sm-12 col-xs-12 col-md-8 pb-2">

                </div>

                  <div class="col-6">
                    <input type="text" id="nombre"  name="nombre" v-model="name" pattern="[a-zA-Z]" class="form-control font-italic mb-2" placeholder="Nombre Completo/Full Name..." required>
                    <input type="text" id="dir" name="dir"  v-model="adress" class="form-control font-italic mb-2" placeholder="Dirección/Adress..." required>
                    <input type="tel" id="tel" name="tel"  v-model="phone" class="form-control font-italic mb-2" placeholder="Teléfono/Phone..." pattern="\x2b[0-9]+" size="15" required>
                      <label for="services" class="text-light"><span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label>
                        <br>
                                 <tags-input  id="services" element-id="services" :add-tags-on-comma=true	class=""
                                    v-model="selectedServices"
                                    placeholder="Servicios/Services..."
                                    :existing-tags="services"
                                     id-field="id"
                                     text-field="name"
                                    :typeahead="true">

                                 </tags-input>


                  </div>
                  <div class="col-6">
                    <input type="number"  id="personas" required name="personas" v-model="cant_person" min="1" :max="roomCapacityMax" step="1" class="form-control font-italic mb-2" placeholder="Huéspedes/Guests...">
                    <input type="number"  id="ninos" nrequired ame="ninos" v-model="childs" min="1" step="1" :max="childCapacityMax" class="form-control font-italic mb-2" placeholder="#Niños de Huéspedes/#Childs of Guests...">
                    <input type="email" disabled=true name="email" v-model="email" class="form-control font-italic mb-2" placeholder="Correo/Email...">


                    <label for="rooms"  class="text-light"><span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label>
                    <br>
                             <tags-input  required id="rooms_input" element-id="rooms" :add-tags-on-comma=true	class=""
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
                    <select  required class="form-control pt-2" v-model="pais" id="country" name="country" required>
                     <option value=''>{{ $trans('messages.Select Country') }}</option>
                       <option v-for="countri in countries" :value="countri.id">{{countri.name_knowing}}</option>
                    </select>

                  </div>

                  <div class="col-12">
                    <div class="content-justify-center">
                      <label for="amount" class="text-light">{{ $trans('messages.Amount') }}</label>
                      <input type="number" disabled=true name="amount" v-model="amount" min="1"  step="0.1" class="form-control font-italic mb-2">

                      <button type="button" @click=book() class="btn w-20 rounded btn-light btn-lg mt-5 reserva">{{ $trans('messages.Book') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

</template>

<script>
import moment from 'moment';
    export default {
      data(){
        const month = new Date().getMonth();
        const year = new Date().getFullYear();
        return {
          modelConfig: {
       type: 'string',
       mask: 'YYYY-MM-DD', // Uses 'iso' if missing
     },
          email:this.$attrs.email,
          name:'',
          hostal:this.$attrs.hostal_id,
          hostal_data:[],
          adress:'',
          pais:'',
          phone:'',
          blockedDays:[],
          blockedAllDays:[],
          rooms:[],
          selectedRooms:[],
          services:[],
          selectedServices:[],
          roomCapacityMax:0,
          childCapacityMax:0,
          countries:[],
          cant_person:0,
          seasons:[],
          tempor:'',
          temporada_book:'',
          dayhigh:0,
          daylow:0,
          reservation_days:0,
          range:[],
          childs:0,
          nuSortArr:[],
          amount:0,
          is_betwen:'no',
          service_price:0,
          rooms_price:0,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        hostalData:function(){
          axios.get('/data-hostal/'+this.hostal)
               .then(response =>{
                 this.hostal_data=response.data;

               });
        },
        esconderMensage:function(){
        $("#mensage").hide(true);
        },
      totalAmount:function(val,tipoIinput){

        if(tipoIinput=='service'){
          this.service_price=0;
          var price_baj=0;
          var price_alta=0;
          if(val.length>0){
          for(var i=0; i<val.length; i++){
            if(this.tempor=='Alta'){
            this.service_price+=val[i].price_high*this.cant_person*this.reservation_days;
             }

           else  if(this.tempor=='Baja'){
          this.service_price+=val[i].price_low*this.cant_person*this.reservation_days;
            }

            else {
              price_baj=val[i].price_low*this.daylow*this.cant_person;
              price_alta=val[i].price_high*this.dayhigh*this.cant_person;
             this.service_price+=price_baj+price_alta;
            }

          }
        }
        }
        else if(tipoIinput=='room'){
          this.rooms_price=0;
          var price_baj=0;
          var price_alta=0;
          if(val.length>0 && this.cant_person>0){
          for(var i=0; i<val.length; i++){
            if(this.tempor=='Alta'){
            this.rooms_price+=val[i].price_high*this.reservation_days;
             }

           else  if(this.tempor=='Baja'){
          this.rooms_price+=val[i].price_low*this.reservation_days;
            }

            else {
              price_baj=val[i].price_low*this.daylow;
              price_alta=val[i].price_high*this.dayhigh;
             this.rooms_price+=price_baj+price_alta;
            }

          }
        }
        }
        else if (tipoIinput=='range'||tipoIinput=='cant_persons'){
          this.service_price=0;
          this.rooms_price=0;
          var price_baj_room=0;
          var price_alta_room=0;
          var price_baj_serv=0;
          var price_alta_serv=0;
          if(this.selectedRooms.length>0){
          for(var i=0; i<this.selectedRooms.length; i++){
            if(this.tempor=='Alta'){
            this.rooms_price+=this.selectedRooms[i].price_high*this.reservation_days;
             }

           else  if(this.tempor=='Baja'){
          this.rooms_price+=this.selectedRooms[i].price_low*this.reservation_days;
            }

            else {
              price_baj_room=this.selectedRooms[i].price_low*this.daylow;
              price_alta_room=this.selectedRooms[i].price_high*this.dayhigh;
             this.rooms_price+=price_baj_room+price_alta_room;
            }

          }
        }

        if(this.selectedServices.length>0){
        for(var i=0; i<this.selectedServices.length; i++){
          if(this.tempor=='Alta'){
          this.service_price+=this.selectedServices[i].price_high*this.reservation_days*this.cant_person;
           }

         else  if(this.tempor=='Baja'){
        this.service_price+=this.selectedServices[i].price_low*this.reservation_days*this.cant_person;
          }

          else {
            price_baj_serv=this.selectedServices[i].price_low*this.daylow*this.cant_person;
            price_alta_serv=this.selectedServices[i].price_high*this.dayhigh*this.cant_person;
           this.service_price+=price_baj_serv+price_alta_serv;
          }

        }
      }
          }

        this.amount=this.service_price+this.rooms_price;

      },
      sortArrayNum:function(numeros){
        var temporal = 0;
      for (var i = 0; i < numeros.length; i++) {
          for (var j = 1; j < (numeros.length - i); j++) {
              if (numeros[j - 1]['num'] > numeros[j]['num']) {
                  temporal = numeros[j - 1];
                  numeros[j - 1] = numeros[j];
                  numeros[j] = temporal;
              }
          }
      }
      this.nuSortArr=numeros;
      },
      getCountryList:function(){
        axios.get('/countries-list')
             .then(response => {
               this.countries = response.data;
             })
             .catch(error => this.errors.push(error));

      },
      getTemporadasHostal:function(name){
        axios.get('/temporadas-hostal/'+name)
            .then(response => {
              this.seasons = response.data.temporadas;
            })
            .catch(error => this.errors.push(error));
      },
      getBookedDatesBD:function(name){
        axios.get('/blocked-dates/'+name)
            .then(response => {
              let dates_block = response.data;
              var temp;
              this.blockedAllDays=dates_block;

            })
            .catch(error => this.errors.push(error));
      },
      getAvailableRooms:function(name){
        axios.get('/available-rooms/'+name)
             .then(response =>{
             this.rooms=response.data;
             for(var i=0; i<this.rooms.length; i++){
               this.roomCapacityMax+=this.rooms[i].capacity;
             }
             this.childCapacityMax=this.roomCapacityMax-1;
             })
             .catch(error => this.errors.push(error));
      },
      getAvailableServices:function(name){
        axios.get('/available-services/'+name)
             .then(response =>{
               let hostalsServices=response.data;
               let servicesHostal=hostalsServices[0].services;

               this.services = servicesHostal;
             })
             .catch(error => this.errors.push(error));
      },
      book:function(){

        let url="/reserva";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email==''||this.name==''||this.adress==''||this.pais==''||this.phone==''||this.selectedRooms==''||this.cant_person==0||this.date_in==''||this.date_out=='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }

        let roomsList=this.selectedRooms;
        let roomTags='';
        if(this.selectedRooms.length>0){
        for(var i=0; i<roomsList.length;i=i+1){
          if(i==(roomsList.length-1)){
          roomTags= ''+roomTags+roomsList[i].name;
        }
        else{
          roomTags= ''+roomTags+roomsList[i].name+',';
        }
        }
        }

        let serviceList=this.selectedServices;
        let serviceTags='';
        if(this.selectedServices.length>0){
        for(var i=0; i<serviceList.length;i=i+1){
          if(i==(serviceList.length-1)){
          serviceTags= ''+serviceTags+serviceList[i].name;
        }
        else{
          serviceTags= ''+serviceTags+serviceList[i].name+',';
        }
        }
      }




        let data = new FormData();
            data.append("email", this.email);
            data.append("name", this.name);
            data.append("token", this.token);
            data.append("adress", this.adress);
            data.append("pais", this.pais);
            data.append("phone", this.phone);
            data.append("rooms", roomTags);
            data.append("service", serviceTags);
            data.append("cant_person", this.cant_person);
            data.append("childs", this.childs);
            data.append("amount", this.amount);
            data.append("date_in", this.range['start']);
            data.append("date_out", this.range['end']);
            data.append("hostal_id", this.hostal_data.name);
            data.append("reservation_days", this.reservation_days);

          axios.post(url,data)
               .then(response=>{
                 var valor=Object.keys(response.data);
                 if(valor.includes('msg')){
                   swal({title:this.$trans('messages.Whoops! Something went wrong.'),
                         text:this.$trans('messages.'+response.data['msg']+''),
                         icon:'error',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });
                 }
                 else{
                 swal({title:this.$trans('messages.Correct data'),
                       text:this.$trans('messages.You have made a pre-reservation in our hostal, you must receive in your email a link that you must access for confirm it and know steps to payment'),
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     });
                     this.name='';
                     this.adress='';
                     this.pais='';
                     this.phone='';
                     this.cant_person=0;
                     this.childs=0;
                     this.amount=0;
                     this.selectedRooms=[];
                     this.selectedServices=[];
                     this.range=[];
                     this.getAvailableServices(hostalName);
                     this.getAvailableRooms(hostalName);

                     this.getBookedDatesBD(hostalName);
                   }
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
      watch: {
    selectedServices(val) {
      var tipoIinput='service';
      this.totalAmount(val,tipoIinput);

    },
    selectedRooms(val){
      var tipoIinput='room';
      if(val.length>1){
        this.blockedDays=this.blockedAllDays['together'];
        this.blockedDays.push({'start':null,'end':new Date()});
      }
      else if (val.length===1){
      this.blockedDays=this.blockedAllDays[val[0].name];
      this.blockedDays.push({'start':null,'end':new Date()});
      }
      else{
        this.blockedDays={'start':null,'end':new Date()};
      }

      this.totalAmount(val,tipoIinput);
    },
    range(val){
      //this.blockedAllDays

      var date_satart=moment(val['start']);
      var date_end=moment(val['end']);

      var diff_min_start=[];
      var diff_min_end=[];
     for (var i=0; i<this.seasons.length; i++){
        let start_seas=this.seasons[i].date_in;
        let end_seas=this.seasons[i].date_out;
        var is_same_after_start=date_satart.isSameOrAfter(this.seasons[i].date_in);
        var is_same_before_end=date_end.isSameOrBefore(this.seasons[i].date_out);
        if (is_same_after_start && is_same_before_end){
          this.is_betwen='yes';
          this.tempor=this.seasons[i].name;


        }
        else{
          var season_start=moment(this.seasons[i].date_in);
          var season_end=moment(this.seasons[i].date_out);
          if(season_end.diff(date_satart,'days')>=0){
            diff_min_start.push({'num':season_end.diff(date_satart,'days'),'name_season':this.seasons[i].name});
          }

          if(date_end.diff(season_end,'days')>=0){
            diff_min_end.push({'num':date_end.diff(season_end,'days'),'name_season':this.seasons[i].name});
          }

        }

      }
      if(this.is_betwen=='yes'){
        this.reservation_days=date_end.diff(date_satart,'days');
      }
      else{
        this.sortArrayNum(diff_min_start);
        diff_min_start =this.nuSortArr;
        this.sortArrayNum(diff_min_end);
        diff_min_end =this.nuSortArr;

        if(diff_min_start[0]['name_season']=='Alta'){
          this.dayhigh=diff_min_start[0]['num'];
          this.daylow=diff_min_end[0]['num'];

        }
        else if(diff_min_start[0]['name_season']=='Baja'){
          this.daylow=diff_min_start[0]['num'];
          this.dayhigh=diff_min_end[0]['num'];
        }

    }
    var tipoIinput='range';
    var valor=[];
    this.totalAmount(valor,tipoIinput);
    },
    cant_person(val){
      this.childCapacityMax=val-1;
      var tipoIinput='cant_persons';
      var valor=[];
      this.totalAmount(valor,tipoIinput);
    },
  },
      created: function(){
        let hostalName=this.hostal_data.name;
        this.getAvailableServices(hostalName);
        this.getAvailableRooms(hostalName);
        this.getCountryList();
        this.getTemporadasHostal(hostalName);
        this.getBookedDatesBD(hostalName);







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
