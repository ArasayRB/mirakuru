<?php

namespace App\Traits;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;

trait RoleTrait {

    public function allRoles(){
      $roles=Role::with('permissions')
                 ->get();
      return $roles;
    }


}
