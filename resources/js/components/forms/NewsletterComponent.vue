<template>

  <form action="" class="mt-5">
    <div class="container mt-5"><h4 class="text-uppercase text-center mt-5 mb-5">Suscríbete y recibe nuestras ofertas e informaciones</h4>
      <div class="row justify-content-center">
        <div class="col-2 d-block">
        </div>
        <div class="col-6"><input type="text" class="form-control font-italic" placeholder="Déjanos tu email..."></div>
        <div class="col-2"><img src="/images/img/enviar.png" alt="" type="button" id="enviar-news" class="btn rounded px-2 py-2 newsletter"></div>
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
