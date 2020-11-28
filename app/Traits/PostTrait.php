<?php

namespace App\Traits;
use App\Models\Post;

trait PostTrait {
    public function getPosts() {
    $posts=Post::with('users')
    ->get();
    return $posts;
    }

    public function show($idPost){
      $post=Post::with('users')
                  ->find($idPost);
      return view('/posts/show',['post'=>$post]);
    }


}
