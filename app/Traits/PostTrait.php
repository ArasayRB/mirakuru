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

    public function getPostsMoreRead($cant){
      $posts_more_read;
      if($cant===''){
      $posts_more_read=Post::with('users')
                           ->orderBy('cant_access_read','DESC')
                           ->get();
                    }
      else {
        $posts_more_read=Post::with('users')
                             ->take($cant)
                             ->orderBy('cant_access_read','DESC')
                             ->get();
      }
      return $posts_more_read;
    }

    public function getPostsMoreLikes($cant){
      $posts_more_liked;
      if($cant===''){
      $posts_more_liked=Post::with('users')
                           ->orderBy('cant_likes','DESC')
                           ->get();
                    }
      else {
        $posts_more_liked=Post::with('users')
                             ->take($cant)
                             ->orderBy('cant_likes','DESC')
                             ->get();
      }
      return $posts_more_liked;
    }

    public function getLatestPosts($cant){
      $latest_posts;
      if($cant===''){
      $latest_posts=Post::with('users')
                           ->orderBy('created_at','DESC')
                           ->get();
                    }
      else {
        $latest_posts=Post::with('users')
                             ->take($cant)
                             ->orderBy('created_at','DESC')
                             ->get();
      }
      return $latest_posts;
    }

    public function existPost(){
      $post=Post::all();
                  return count($post);

    }

    public function show($idPost,$type){
      $post=Post::with('users')
                  ->find($idPost);
                  if(Cache::has($idPost)==false){
        Cache::add($idPost,'contador',0.30);
        $post->cant_access_read++;
        $post->save();
    }
    if($type==="real"){
      return view('/posts/show',['post'=>$post]);
    }
     return view('/posts/show',['post'=>$post,'preview'=>'vista previa']);
    }

    public function relationedPostByTags($id){
      $post=Post::with('users')
                ->find($id);
      $relationed_posts=[];
      $tags=$post->tags;
      $posts=$this->getPosts();
      foreach ($posts as $poste) {
        foreach ($poste->tags as $tagg) {
      foreach ($tags as $tag) {
        if(($tagg->id===$tag->id) && ($post->id!=$poste->id) && (in_array($poste,$relationed_posts)===false)){
          $relationed_posts[]=$poste;
        }
      }
      }
      }
                return ['tags'=>$tags,'relationed_posts'=>$relationed_posts];
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
