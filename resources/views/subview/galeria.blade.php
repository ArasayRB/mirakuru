<div class="gallery-container">
  @for ($i=0; $i < count($hostal->pictures); $i++)
  <div class="gallery-card">
  <a href="{!! asset('/storage/hostales/'.$hostal[0]->slug.'/'.$hostal->pictures[$i]->area_picture.'/'.$hostal->pictures[$i]->img_url) !!}" data-lightbox="roadtrip">
    <img src="{!! asset('/storage/hostales/'.$hostal[0]->slug.'/'.$hostal->pictures[$i]->area_picture.'/'.$hostal->pictures[$i]->img_url) !!}" alt="Imagen">
  </a>
  </div>
  @endfor
</div>
