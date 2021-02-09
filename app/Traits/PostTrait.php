<?php

namespace App\Traits;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

trait PostTrait {
    public function getPosts() {
    $posts=Post::with('users')
                ->where('publicate_state',1)
                ->get();
    return $posts;
    }

    public function getPostsMoreRead($cant){
      $posts_more_read;
      if($cant===''){
      $posts_more_read=Post::with('users')
                           ->where('publicate_state',1)
                           ->orderBy('cant_access_read','DESC')
                           ->get();
                    }
      else {
        $posts_more_read=Post::with('users')
                             ->where('publicate_state',1)
                             ->take($cant)
                             ->orderBy('cant_access_read','DESC')
                             ->get();
      }
      return $posts_more_read;
    }

    public function getTranslatedPostByLang($lang,$post_id){
      $id_lang=$this->getLangIdByName($lang);
      $post_translated=$this->getTranslatedTransPost($id_lang,$post_id);
      $post=$this->getPost($post_id);
      $post->title=$post_translated['title']['content_trans'];
      $post->content=$post_translated['content']['content_trans'];
      $post->summary=$post_translated['summary']['content_trans'];
      return $post;
    }

    public function getPost($post){
      $posts=Post::with('categoriaPosts')
                   ->with('keywords')
                   ->where('id',$post)
                   ->first();

       if($posts->publicate_state===0){
         $posts->show=false;
       }
       else{
         $posts->show=true;
        }

                   return $posts;
    }

    public function getTranslatedPostBySigLang($lang,$post_id){
      $id_lang=$this->getLangIdBySigla($lang);
      $post_translated=$this->getTranslatedTransPost($id_lang,$post_id);
      $post=$this->getPost($post_id);
      if(count($post_translated)!=0){
        $post->title=$post_translated['title']['content_trans'];
        $post->content=$post_translated['content']['content_trans'];
        $post->summary=$post_translated['summary']['content_trans'];
        return $post;
      }
      else{
        return $post;
      }

    }

    public function getPostsMoreLikes($cant){
      $posts_more_liked;
      if($cant===''){
      $posts_more_liked=Post::with('users')
                           ->where('publicate_state',1)
                           ->orderBy('cant_likes','DESC')
                           ->get();
                    }
      else {
        $posts_more_liked=Post::with('users')
                             ->where('publicate_state',1)
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
                           ->where('publicate_state',1)
                           ->orderBy('created_at','DESC')
                           ->get();
                    }
      else {
        $latest_posts=Post::with('users')
                             ->where('publicate_state',1)
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

        if($post->default_lang!=app()->getLocale()){
          $post_lang=$this->getTranslatedPostBySigLang(app()->getLocale(),$post->id);
          $post->title=$post_lang->title;
          $post->content=$post_lang->content;
          $post->summary= $post_lang->summary;
        }
      return view('/posts/show',['post'=>$post]);
    }

          $this->authorize('preViewPost',$post);
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
