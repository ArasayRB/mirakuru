<template>

            <form action="" class="mt-5">
              <div class="container mt-5"><h1 class="text-center text-light mt-5 mb-5">Haga su reserva AHORA!!</h1>
                <div class="row justify-content-center">
                  <div class="col-6">
                    <input type="text" name="nombre" class="form-control font-italic mb-2" placeholder="Nombre Completo/Full Name...">
                    <input type="text" name="dir" class="form-control font-italic mb-2" placeholder="Dirección/Adress...">
                    <input type="tel" name="tel" class="form-control font-italic mb-2" placeholder="Teléfono/Phone...">
                      <input type="email" name="email" class="form-control font-italic mb-2" placeholder="Correo/Email...">
                  </div>
                  <div class="col-6">
                    <input type="number" name="personas" min="1" step="1" class="form-control font-italic mb-2" placeholder="Huéspedes/Guests...">
                    <input type="number" name="ninos" min="1" step="1" class="form-control font-italic mb-2" placeholder="Niños/Childs...">
                    <input type="date" name="fecha-entrada" class="form-control font-italic mb-2" placeholder="Entrada/In...">
                    <input type="date" name="fecha-salida" class="form-control font-italic mb-2" placeholder="Salida/Out...">
                  </div>
                  <div class="col-2 ">
                    <div class="content-justify-center"><button type="button" class="btn w-20 rounded btn-light btn-lg mt-5 reserva">Reservar</button></div>
                  </div>
                </div>
              </div>
            </form>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
