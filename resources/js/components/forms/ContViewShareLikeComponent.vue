<template>

  <div class="position-fixed">
    <div class="row ml-1">
     <strong class="d-inline-block mb-2 text-primary"><p class="text-info"><i title="Reads/ Lecturas"  class="fa fa-eye"></i> {{cant_read}} | </p>
     <a href="#" @click="addLove()"> <p class="text-info"><i title="Show your love/ Muestra tu amor" class="fa fa-heart"></i> {{likes}} </p></a></strong>
    </div>

        <div class="row ml-1">
        <a href="#" class="social-button ml-1" @click="shareSocialMedia('facebook')"><i title="Share/ Compartir" class="fab fa-facebook "></i></a>
        <a href="#" class="social-button ml-1" @click="shareSocialMedia('twitter')"><i title="Share/ Compartir" class="fab fa-twitter-square "></i></a>
        </div>
        <p class="row ml-1 text-info">{{sharess}}</p>

    </div>

</template>

<script>
    export default {
      props:['id_post','cant_read', 'cant_shares', 'cant_likes', 'title', 'url_post'],
      data(){
        return {
          model:this.$attrs.model,
          likes:'',
          sharess:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        shareSocialMedia:function(media){
        let url='/share/'+this.id_post+'/'+media;
        let urlSocial;
        if(media==='facebook'){
          urlSocial='http://www.facebook.com/sharer.php?u='+this.url_post+'&t='+this.title;
        }

        else if (media==='twitter'){
          urlSocial='https://twitter.com/share?url='+this.url_post+'&text='+this.title;
        }
        var lba = document.getElementsByClassName("social-button")

       function myPopup() {
           window.open(urlSocial, 'mywin',
                   'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
           event.preventDefault();
           return false;
       }

       for (var i = 0; i < lba.length; i++) {
           lba[i].addEventListener("click", myPopup, false);
       }

      axios.post(url)
        .then(response=>{
          let shar=response.data;
          this.sharess=shar.cant_shares;

        })
             .catch(error => this.errors.push(error));

      },
      addLove:function(){
        let url='/post-love/'+this.id_post;
        axios.post(url)
        .then(response=>{

            let lik=response.data;
          swal({title:this.$trans('messages.Thanks!'),
                text:this.$trans('messages.Thank you, we love you to!'),
                icon:'success',
                closeOnClickOutside:false,
                closeOnEsc:false
              }).then(select=>{
                if (select){
                  this.likes=lik.cant_likes;
                }
              });
        })
             .catch(error => this.errors.push(error));
      },
      },
        mounted() {
          this.likes=this.cant_likes;
          this.sharess=this.cant_shares;
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
