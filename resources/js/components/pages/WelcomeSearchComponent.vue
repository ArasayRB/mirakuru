<template>
  <div id="container-fluid" class="container-fluid col-12">
    <div class="row" id="home" name="home">
      <div class="col-12">
        <div  class="contenedor-welcome-page"><!--SECTION TESTIMONIOS-->
          <div class="slider-welcome-page">
            <div class="welcome-page-slider">
              <div class="slider-overflow">
                <input-hostal-search-component>
              </input-hostal-search-component>
                </div>
                <div id="last-news" class="slider-carousel">
        <div class="carousel slide pt-5" id="demonews" data-ride="carousel">
          <!--Indicadores-->
          <ul class="carousel-indicators">
          <li data-target="demonews" :id="'control-news'+index" :data-slide-to="index" v-for="(noticia,index) in noticias" :class="index==0?activeClass='active':''"></li>
          </ul>
          <!--Imagenes-->
          <div class="carousel-inner">
            <div class="carousel-item" :id="'content-news'+index" v-for="(noticia,index) in noticias" :class="index==0?activeClass='active':''">

                <h2 class="pt-2 text-uppercase font-weight-bold">{{ $trans('messages.News') }} {{ $trans('messages.About') }}!!- {{noticia.tema_name}}</h2>
                <h1 class="text-warning text-uppercase">{{noticia.title}} </h1>
                <div class="block-quote">
                  <p>{{noticia.description}}...</p>
                </div>
                <div class="info">
                  <div class="name">{{noticia.hostal_name}}</div>
                  <div class="position mb-5">

                    <div class="card shadow mt-5">
                      <!-- Card Header - Accordion -->
                      <a href="#collapseCardExample" class="d-block card-header py-3 bg-warning" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold bg-warning text- dark wow animate__animated animate__heartBeat animate__infinite">{{ $trans('messages.Continue reading') }}!...  </h6>
                      </a>
                      <!-- Card Content - Collapse -->
                      <div class="collapse" id="collapseCardExample">
                        <div class="card-body">
                          <div id="view-new" class="card align-content-center">
                            <div class="card-body h-5 w-5">

                              <img :src="src+noticia.img_url" class="img-fluid w-50 h-50 mx-auto d-block rounded-circle">
                              <p class="text-dark">{{noticia.noticia}}</p>
                            </div>
                            <div class="card-footer">
                              <h3 class="card-title text-dark text-uppercase text-center">{{ $trans('messages.Writed By') }}: </h3>
                              <div class="row">
                                  <h4 class="text-dark text-uppercase col-12">
                                    <img :src="src_user+noticia.user_name.imagen_url" class="img-fluid w-10 h-10 rounded-circle border border-marning shadow">
                                    {{noticia.user_name.name}}
                                  </h4>
                                    <p class="text-dark font-weight-bold text-center col-12">{{noticia.user_name.profile}}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div></div>
                </div>

            </div>
          </div>
        </div>

          <!--Controladores izq derecha-->
          <a href="#demonews" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
          <a href="#demonews" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
        </div>



        </div>
        </div>
        </div>
        </div><!--Fin SECTION TESTIMONIOS-->
     </div>
   </div>
  </div>
</div>
</template>
<script>
export default {
  data(){
    return {
      src:'/storage/img_web/news_img/',
      src_user:'/storage/img_web/login_img/',
      noticias:[],
      noticia:[],
      token   : window.CSRF_TOKEN,

    }
  },
  methods:{
    getNoticias:function(){
      let cant=3;
      axios.get('/read-news')
          .then(response =>{
            this.noticias=response.data;
            if(this.noticias.length===0){
         $("#last-news").hide(true);
            }
          /*  else{
              this.comentarios=
            }*/
          });
    },
  },
  created: function () {
   this.getNoticias();
     },
  mounted(){

if (this.$attrs.locale) {
   this.$lang.setLocale(this.$attrs.locale);
   }
else {
this.$lang.setLocale('en');
}
  }
}
</script>
