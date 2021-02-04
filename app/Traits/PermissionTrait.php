<?php

namespace App\Traits;
use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

trait PermissionTrait {

    public function allPermissions(){
      $permission=Permission::all();
      return $permission;
    }


}
