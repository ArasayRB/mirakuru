<template>
  <div class="mt-5">
   <div class="panel shadow" v-for="(comentario,index) in comentarios">
     <div class="panel-header mt-5">
       <form class="text-center" id="form">
   <p class="clasificacion">
   <input id="radio1" type="radio" v-if="comentario.calification_id===5" name="estrellas" value="5" disabled checked>
   <input id="radio1" type="radio" v-else name="estrellas" value="5">
   <label for="radio1">★</label>
   <input id="radio2" type="radio" v-if="comentario.calification_id===4" name="estrellas" value="4" disabled checked>
   <input id="radio2" type="radio" v-else name="estrellas" value="4">
   <label for="radio2">★</label>
   <input id="radio3" type="radio" v-if="comentario.calification_id===3" name="estrellas" value="3" disabled checked>
   <input id="radio3" type="radio" v-else name="estrellas" value="3">
   <label for="radio3">★</label>
   <input id="radio4" type="radio" v-if="comentario.calification_id===2" name="estrellas" value="2" disabled checked>
   <input id="radio4" type="radio" v-else name="estrellas" value="2">
   <label for="radio4">★</label>
   <input id="radio5" type="radio" v-if="comentario.calification_id===1" name="estrellas" value="1" disabled checked>
   <input id="radio5" type="radio" v-else name="estrellas" value="1">
   <label for="radio5">★</label>
   </p>
   </form>
   <img :src="src+comentario.user.imagen_url" class="rounded-circle mx-auto d-block img-fluid mt-2 shadow">
     </div>
     <div class="panel-body mt-1">
       <div class="block-quote text-center">
         <p>{{comentario.comment}}</p>
       </div>
     </div>
     <div class="panel-footer mt-1 pb-2">
       <div class="info text-center">
         <div class="name font-weight-bold">{{comentario.user.name}}</div>
         <div class="position font-weight-bold">{{comentario.created_at}}</div>
       </div>
     </div>

   </div>

   </div>
</template>

<script>
    export default {
      data(){
        return {
          comentarios:[],
          comentario:[],
          src:'/storage/img_web/login_img/',
          token   : window.CSRF_TOKEN,

        }
      },

        mounted() {

                let hostal='Hostal Mirakuru Gran Familia';
                let cant=0;
                axios.get('/verify-testimonial/'+hostal+'/'+cant)
                    .then(response =>{
                      this.comentarios=response.data;

                    /*  else{
                        this.comentarios=
                      }*/
                    });

          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
