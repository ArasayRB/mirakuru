<template>

  <div class="alert alert-success bg-dark panel" id="leave-comment" v-if="booksForReview.length!=0">
    <slot clss="panel-body">
      <button type="button" class="modal-default-button btn btn-lg" @click="closeLeaveComment()"><span class ="text-light" aria-hidden="true">&times;</span></button>
    <h4 class="font-weght-bold text-center text-light">{{ $trans('messages.Could be awsome if you want leave a comment about your last visit clicking below!') }}</h4>

    </slot>
    <div class="text-center panel-footer">
    <a href="#" @click="ventanaReview = true" type="button" class="btn btn-warning  wow animate__animated animate__heartBeat animate__infinite">{{ $trans('messages.Leave your review') }}</a>
    </div>
    <create-coment-hostal-component :books="booksForReview" @closereviewmodal="closeReviewModal" v-if="ventanaReview" @close="ventanaReview = false">
    </create-coment-hostal-component>
  </div>

</template>

<script>
    export default {
      data(){
        return {
        booksForReview:[],
        ventanaReview:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        closeLeaveComment:function(){
          $('#leave-comment').hide(true);
        },
        closeReviewModal:function(){
          this.ventanaReview=false;
          this.noMakedReviews();
        },
        noMakedReviews:function(){
          axios.get('/comment-book')
               .then(response =>{
                 this.booksForReview=response.data;
               });
        },
      },
      created:function(){
        this.noMakedReviews();
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
