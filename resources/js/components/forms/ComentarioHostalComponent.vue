<template>
<div id="testimonial" class="contenedor-testimonios">
  <div class="contenedor-slider-testimonios">
    <div class="testimonial-slider">
      <div class="slider-overflow"><h1 class="text-center text-light text-uppercase">{{ $trans('messages.Testimonials') }}</h1>
        <div class="slider-carousel">
<div class="carousel slide" id="demo" data-ride="carousel">
  <!--Indicadores-->
  <ul class="carousel-indicators">
    <li data-target="demo" :id="'control'+index" :data-slide-to="index" v-for="(comentario,index) in comentarios" :class="index==0?activeClass:'active'"></li>

  </ul>
  <!--Imagenes-->
  <div class="carousel-inner">
    <div class="carousel-item" :id="'coment'+index" v-for="(comentario,index) in comentarios" :class="index==0?activeClass:'active'">
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
     <img :src="src+comentario.user.imagen_url" class="rounded-circle mx-auto d-block img-fluid">
    <div class="block-quote">
      <p>{{comentario.comment}}</p>
    </div>
    <div class="info">
      <div class="name">{{comentario.user.name}}</div>
      <div class="position">{{comentario.created_at}}</div>
    </div>
  </div>

</div>

  </div>
  <!--Controladores izq derecha-->
  <a href="#demo" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
  <a href="#demo" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
</div>
</div>
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
          activeClass:'',
          src:'/storage/img_web/login_img/',
          token   : window.CSRF_TOKEN,

        }
      },

        mounted() {

                let hostal='Hostal Mirakuru Gran Familia';

                axios.get('/verify-testimonial/'+hostal)
                    .then(response =>{
                      this.comentarios=response.data;
                      if(this.comentarios.length===0){
                   $("#testimonial").hide(true);
                      }
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
