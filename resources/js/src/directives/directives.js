import Vue from 'vue'

Vue.directive('can', function (el, binding, vnode) {

        var valores=binding.value;
        var lista=valores.split(',');
        if(lista.length===2){
          if((Permissions.indexOf(lista[0]) !== -1)&&(UserId.name===lista[1])){
                el.hidden = false;
            }
            else if(UserId.name===lista[1]){
              el.hidden = false;
            }
            else if(UserId.name!==lista[1]){
              if(UserId.roles[0].slug==='admin'||UserId.roles[0].slug==='manager-content'){
                el.hidden = false;
              }
              else{
              el.hidden = true;
            }
            }
            else{
              el.hidden = false;
            }
        }



    });

    Vue.directive('can-user', function (el, binding, vnode) {
             if(Permissions.indexOf(binding.value)!==-1){
               el.hidden=false;
             }
             else{
               el.hidden=true;
             }



        });
