<template>
  <div class="input-group col">
    <div class="input-group-append">
      <input type="search" v-model="searcher" @keyup="searcherItems" class="form-control panel-header bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">


        <button class="btn btn-primary" type="button" @click="getLists">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
      <div class="panel-footer pt-3" v-show="show" v-if="lists.length">
        <ul class="list-group">
          <li class="list-group-item" v-for="(list,index) in lists">
            <a @click="resetList(list.name)" type="button" class="dropdown-item" v-on:click.prevent="searcher=list.name">
              <span v-html="list.word_black"></span>
            </a>
          </li>
        </ul>
      </div>

    </div>
</template>
<script>
export default {
  props:['url','emit','locale'],
  data(){
    return {
      lists:[],
      list:[],
      show:true,
      searcher:'',
      setTimeOUTSearcher:'',
      token   : window.CSRF_TOKEN,

    }
  },
  watch:{
    searcher(val){
      console.log(val);
      if(val===''){
        this.show=false;
        this.$emit('cancelsearch');
      }
      else{
        this.show=true;
      }
    },
  },
  methods:{
    resetList:function(name){
      this.searcher=name;
      this.getLists();
      this.show=false;
    },
    getLists:function(){
      axios.get(window.location.origin +this.url,{
        params:{
          searcher:this.searcher,
        }
      })
          .then(response =>{
            this.lists=response.data;
            if(this.lists.length!=0){
            this.$emit(this.emit+'filter',this.lists);
          }
          else{
            this.show=false;
            this.$emit('cancelsearch');
          }
          });
    },
    filterUser:function(list){
      window.location.href = window.location.origin +'/hostal/'+list.slug;
    },
    searcherItems:function(){
      clearTimeout(this.setTimeOUTSearcher)
      this.setTimeOUTSearcher=setTimeout(this.getLists, 360)
    },
  },
  created: function () {
   this.getLists();
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
