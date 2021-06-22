<?php

namespace App\Traits;

trait ImageTrait {
    public function manageImage($image) {
      $fileImageNameExtencion=$image->getClientOriginalName();

      $fileName=pathInfo($fileImageNameExtencion, PATHINFO_FILENAME);

      $fileExtencion=$image->getClientOriginalExtension();

      $newFileName=$fileName."_".time().".".$fileExtencion;

      $saveAs=$image->storeAs('public/img_web/posts_img',$newFileName);
      return $newFileName;
    }

    public function delImage($image){
      $oldImg=public_path().'/storage/img_web/posts_img/'.$image;
      if(file_exists($oldImg)){
        unlink($oldImg);
      }
    }

}
