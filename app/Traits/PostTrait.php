<?php

namespace App\Traits;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

trait PostTrait {
    public function getPosts() {
    $posts=Post::with('users')
    ->get();
    return $posts;
    }

    public function show($idPost){
      $post=Post::with('users')
                  ->find($idPost);
                  if(Cache::has($idPost)==false){
        Cache::add($idPost,'contador',0.30);
        $post->cant_access_read++;
        $post->save();
    }
      return view('/posts/show',['post'=>$post]);
    }

    public function addLovePost($idPost){
      $post=Post::with('users')
                  ->find($idPost);
        $post->cant_likes++;
        $post->save();
      return $post;
    }

    public function sharePostMediaSocial($idPost,$idMedia){
      $post=Post::with('users')
                  ->find($idPost);
        $post->cant_shares++;
        $post->save();
      return $post;
    }


}
