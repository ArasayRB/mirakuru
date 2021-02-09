<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before($user,$ability)
    {
      if($user->isAdmin()){
        return true;
      }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if($user->permissions->contains('slug','update-post') && $post->user_id==$user->id){
          return true;
        }
        elseif ($post->user_id==$user->id) {
          return true;
        }
        elseif($user->roles->contains('slug','manager-content')){
          return true;
        }
        return false;
    }


    public function store(User $user, Post $post)
    {
        if($user->permissions->contains('slug','create-post')){
          return true;
        }
        return false;
    }


    public function storeTranslate(User $user,Post $post){
      if($user->permissions->contains('slug','translate-post')){
        return true;
      }
      return false;
    }

    public function updateTranslate(User $user,Post $post){
      if($user->permissions->contains('slug','edit-translate-post')){
        return true;
      }
      return false;
    }

    public function preViewPost(User $user,Post $post){
      if($user->permissions->contains('slug','pre-view-post')){
        return true;
      }
      return false;
    }

    public function publicate(User $user,Post $post){
      if($user->permissions->contains('slug','publish-post')){
        return true;
      }
      return false;
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
      if($user->permissions->contains('slug','delete-post')){
        return true;
      }
      return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
