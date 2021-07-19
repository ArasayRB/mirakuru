<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ImageTrait {
    public function manageImage($image) {
      $fileImageNameExtencion=$image->getClientOriginalName();

      $fileName=pathInfo($fileImageNameExtencion, PATHINFO_FILENAME);

      $fileExtencion=$image->getClientOriginalExtension();

      $newFileName=$fileName."_".time().".".$fileExtencion;

      $saveAs=$image->storeAs('public/img_web/posts_img',$newFileName);
      return $newFileName;
    }

    public function manageImageFile($image,$folderPath) {
      $fileImageNameExtencion=$image->getClientOriginalName();

      $fileName=pathInfo($fileImageNameExtencion, PATHINFO_FILENAME);
      $slugFileName=Str::slug($fileName, '-');

      $fileExtencion=$image->getClientOriginalExtension();

      $newFileName=$slugFileName."_".time().".".$fileExtencion;

      $saveAs=$this->save($newFileName,$folderPath,$image);
      return $newFileName;
    }

    public function save($file, $path,$image){
      return $image->storeAs('public/'.$path,$file);
    }

    public function delImage($image){
      $oldImg=public_path().'/storage/img_web/posts_img/'.$image;
      if(file_exists($oldImg)){
        unlink($oldImg);
      }
    }

    public function delImageFile($image,$path){
      $oldImg=public_path().'/storage/'.$path.'/'.$image;
      if(file_exists($oldImg)){
        unlink($oldImg);
      }
    }

}
