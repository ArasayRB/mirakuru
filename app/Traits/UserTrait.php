<?php

namespace App\Traits;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait UserTrait {
    public function getUserById($idUser) {
    $user=User::with('permissions')
               ->with('roles')
               ->find($idUser);
    return $user;
    }


}
