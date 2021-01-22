<?php

namespace App\Traits;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait UserTrait {
    public function getUserById($idUser) {
    $user=User::find($idUser);
    return $user;
    }


}
