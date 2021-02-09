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
              el.hidden = true;
            }
            else{
              el.hidden = false;
            }
        }



    });

    Vue.directive('can-user', function (el, binding, vnode) {
      console.log('create permission-',binding);
        console.log('existe permiso:'+Permissions.indexOf(binding.value)+'-permissions-',Permissions);
             if(Permissions.indexOf(binding.value)!==-1){
               el.hidden=false;
             }
             else{
               el.hidden=true;
             }



        });
