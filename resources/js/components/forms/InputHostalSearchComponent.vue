<template>
  <div>
  <div class="text-center">
        <input type="search" aria-label="Search" v-model="searcher" @keyup="getHostals" class="form-control form-control-navbar text-center text-dark text-uppercase" title="Search you HOSTAL" placeholder="Find your HOSTAL">

    </div>
  <div class="panel-footer" v-if="hostals.length">
    <ul class="list-group">
      <li class="list-group-item" v-for="(hostal,index) in hostals">
        <a @click="openHostal(hostal)" type="submit" class="dropdown-item" v-on:click.prevent="searcher=hostal.name">
          <span v-html="hostal.word_black"></span>
        </a>
      </li>
    </ul>
  </div>
  </div>
</template>
<script>
export default {
  data(){
    return {
      hostals:[],
      hostal:[],
      searcher:'',
      setTimeOUTSearcher:'',
      token   : window.CSRF_TOKEN,

    }
  },
  methods:{
    getHostals:function(){
      axios.get('/all-hostals',{
        params:{
          searcher:this.searcher
        }
      })
          .then(response =>{
            this.hostals=response.data;
          });
    },
    openHostal:function(hostal){
      window.location.href = window.location.origin +'/hostal/'+hostal.slug;
    },
    searchHostal:function(){
      clearTimeout(this.setTimeOUTSearcher)
      this.setTimeOUTSearcher=setTimeout(this.getHostals, 360)
    },
  },
  created: function () {
   this.getHostals();
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
