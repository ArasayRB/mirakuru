<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\KeywordTrait;
use App\Traits\ImageTrait;
use App\Traits\CategoryPostTrait;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Traits\PostTrait;

class PostController extends Controller
{
  use KeywordTrait; use CategoryPostTrait; use ImageTrait; use ContentTypeTrait; use TranslateTrait; use LanguageTrait;  use PostTrait;
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        return view('admin.posts.index');
    }

    public function getPostAutentUser(){
      if(auth()->user()->roles->contains('slug','admin')||auth()->user()->roles->contains('slug','publisher-content')){
        $posts=Post::with('categoriaPosts')
                     ->with('keywords')
                     ->with('users')
                     ->orderBy('created_at','asc')
                     ->get();
      }
      else{
      $posts=Post::with('categoriaPosts')
                   ->with('keywords')
                   ->with('users')
                   ->where('user_id',auth()->user()->id)
                   ->orderBy('created_at','asc')
                   ->get();
                 }
      for($i=0;$i<count($posts);$i++){
        if($posts[$i]->publicate_state===0){
          $posts[$i]->show=false;
        }
        else{
          $posts[$i]->show=true;
        }
      }
                   return $posts;
    }

    public function previewPost($slug){
      return $this->show($slug,'preview');
    }

    public function publicatePost($idPost,$state){
      $post=Post::find($idPost);
      $this->authorize('publicate',$post);
      $post->publicate_state=$state;
      $post->update();
      if($post->publicate_state===0){
      $post->show=false;
    }
    else{

      $post->show=true;
    }
      return $this->getPost($post->id);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories=$this->getCategories();

        return view('admin.posts.create',['categories'=>$categories]);
    }

    public function getCategories()
    {
      $post=Post::first();
      $categories=$this->allCategories();

        return $categories;
    }

    public function getTags()
    {
      $post=Post::first();
      $tags=$post->existingTags();
      $tags_array=[];
      foreach ($tags as $tag) {
        $tags_array[]=array('key'=>'',
                            'value'=>$tag->name);
      }

        return $tags_array;
    }

    public function availableKeys()
    {
      $keywords=$this->getAllKeyword();
      $keywords_array=[];
      foreach ($keywords as $keyword) {
        $keywords_array[]=array('key'=>'',
                                'value'=>$keyword->name);
      }

        return $keywords_array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $dataPost=request()->validate([
          'title'=> 'required|max:255',
          'default-lang'=> 'required',
          'image'=> 'required|image',
          'category'=> 'required',
          'checkEditSummary'=> 'required',
          'checkEditContent'=> 'required',
          'tags'=> 'required',
        ]);
        $newFileName=$this->manageImage(request('image'));

        $tags;
        $keywords;
        if(strpos(request('tags'), ',')){
          $tags = explode(",", request('tags'));
        }
        else{
          $tags=request('tags');
        }

        if(strpos(request('keywords'), ',')){
          $keywords = explode(",", request('keywords'));
        }
        else{
          $keywords=request('keywords');
        }
        $post= new Post();
        $post->title=request('title');
        $post->default_lang=request('default-lang');
        $post->content=request('checkEditContent');
        $post->publicate_state=false;
        $post->summary=request('checkEditSummary');
        $post->img_url=$newFileName;
        $post->user_id=auth()->user()->id;
        $post->category_id=request('category');
        $post->cant_access_read=0;
        $post->cant_likes=0;
        $post->cant_shares=0;
        $post->tags=request('tags');
        $post->slug=Str::slug($post->title, '-');
        $post->keywords=request('keywords');
        $this->authorize('store',$post);
        $post->save();
        $post->qr_img_url='qrcode_'.$post->id.'_'.$post->slug.'.svg';
        $post->update();
        QrCode::format('svg')->color(33, 56, 175)->generate(url('/post-list/'.$post->id),public_path('storage/qrcodes/posts/qrcode_'.$post->id.'_'.$post->slug.'.svg'));
        $post->tag($tags);
        if(is_array($keywords)){
          foreach($keywords as $keyword){
            $existKey=$this->getKeywordIf($keyword);

            $post->keywords()->attach($existKey->id);
          }
        }
        else{
          $existKey=$this->getKeywordIf($keywords);
          $post->keywords()->attach($existKey->id);
        }



        $postToAdd=$this->getPost($post->id);
        return $postToAdd;
    }

    public function addTranslate(Request $request){
      $dataPost=request()->validate([
        'title'=> 'required|max:255',
        'lang'=> 'required',
        'checkEditSummary'=> 'required',
        'checkEditContent'=> 'required',
      ]);

      $post=Post::find(request('post_id'));
      $this->authorize('storeTranslate',$post);
      $contentType='Post';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->findLanguageName(request('lang'));


      $data_trans=array(
        ['id_content_trans'=>$post->id,
        'content'=>$post['content'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'content',
        'content_trans'=>request('checkEditContent')],
        ['id_content_trans'=>$post->id,
        'content'=>$post['summary'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'summary',
        'content_trans'=>request('checkEditSummary')],
        ['id_content_trans'=>$post->id,
        'content'=>$post['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>request('lang'),
        'indice_content'=>'title',
        'content_trans'=>request('title')]
      );
      $this->storeTranslate($data_trans);

      $postToAdd=$this->getPost($post->id);
      return $postToAdd;
    }

    public function getTranslatedPostById($id){
      $array_translates_posts=$this->getPostTranslatesById($id);
      dd($array_translates_posts);
    }

    public function getTranslatedLanguagePostById($id){
      $array_trans_lang_post=$this->getPostTranslatesLanguageById($id);
      return $array_trans_lang_post;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post=Post::find($post->id);
        return $post;
        //return view('admin.posts.edit',['post'=>$post,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

      /*if(Gate::denies('admin')){
        abort('403');
      }*/
      $this->authorize('update',$post);

      $post= Post::findOrFail($post->id);
      $newFileName;
      $dataPost;
      if (request('img_url')!=""){
        $dataPost=request()->validate([
          'title'=> 'required|max:255',
          'default-lang'=> 'required',
          'img_url'=> 'required|image',
          'category_id'=> 'required',
          'summary'=> 'required',
          'content'=> 'required',
          'tags'=> 'required',
          'keywords'=> 'required',
        ]);
        $newFileName=$this->manageImage(request('img_url'));

        $this->delImage($post->img_url);
          $post->img_url=$newFileName;
      }
      else{
        $dataPost=request()->validate([
          'title'=> 'required|max:255',
          'default-lang'=> 'required',
          'category_id'=> 'required',
          'summary'=> 'required',
          'content'=> 'required',
          'tags'=> 'required',
          'keywords'=> 'required',
        ]);
      }

        $tags = explode(",", request('tags'));
        $keywords = explode(",", request('keywords'));
        $slug = Str::slug($post->title, '-');
        $post->title=request('title');
        $post->default_lang=request('default-lang');
        $post->content=request('content');
        $post->publicate_state=false;
        $post->summary=request('summary');
        $post->category_id=request('category_id');
        $post->cant_access_read=0;
        $post->cant_likes=0;
        $post->cant_shares=0;
        $post->tags=request('tags');
        $post->keywords=request('keywords');
        $post->slug=Str::slug($post->title, '-');
        $post->qr_img_url='qrcode_'.$post->id.'_'.$post->slug.'.svg';
        $post->update();
        QrCode::format('svg')->color(33, 56, 175)->generate(url('/post-list/'.$post->id),public_path('storage/qrcodes/posts/qrcode_'.$post->id.'_'.$post->slug.'.svg'));
        $post->retag($tags);
        $post->keywords()->detach();
        foreach($keywords as $keyword){
          $existKey=$this->getKeywordIf($keyword);


          $post->keywords()->attach($existKey->id);
        }

        $postToUpd=$this->getPost($post->id);
        return $postToUpd;
    }

    public function updateTranslatedPostByLang($post_id,$lang_name, Request $request){
      $dataPost=request()->validate([
        'title'=> 'required|max:255',
        'content'=> 'required',
        'summary'=> 'required',
      ]);

      $post=Post::find(request('post_id'));
       $this->authorize('updateTranslate',$post);
      $contentType='Post';
      $tipo_content=$this->findContentId($contentType);

      $lang=$this->getLangIdByName($lang_name);


      $data_trans=array(
        ['id_content_trans'=>$post_id,
        'content'=>request('content'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'content',
        'content_trans'=>request('content')],
        ['id_content_trans'=>$post_id,
        'content'=>request('summary'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'summary',
        'content_trans'=>request('summary')],
        ['id_content_trans'=>$post_id,
        'content'=>request('title'),
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'title',
        'content_trans'=>request('title')]
      );
      $result=$this->updateTranslate($data_trans);

      $postToAdd=$this->getPost($post_id);
      return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {

      $this->authorize('delete',$post);
        $post=Post::find($post->id);
        $this->delImage($post->img_url);
        $post->delete();
        $post->untag();
        $post->keywords()->detach();
        $file_path = public_path("storage/qrcodes/posts/$post->qr_img_url");

       if(File::exists($file_path)) File::delete($file_path);
        return response()->json('Post deleted');
    }
}
