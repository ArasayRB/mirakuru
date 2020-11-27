<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\KeywordTrait;
use App\Traits\ImageTrait;
use App\Traits\CategoryPostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
  use KeywordTrait; use CategoryPostTrait; use ImageTrait;
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
      $posts=Post::with('categoriaPosts')
                   ->with('keywords')
                   ->where('user_id',auth()->user()->id)
                   ->orderBy('created_at','asc')
                   ->get();
                   return $posts;
    }

    public function getPost($post){
      $posts=Post::with('categoriaPosts')
                   ->with('keywords')
                   ->where('id',$post)
                   ->first();
                   return $posts;
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

        return $tags;
    }

    public function availableKeys()
    {
      $keywords=$this->getAllKeyword();

        return $keywords;
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
          'image'=> 'required|image',
          'category'=> 'required',
          'checkEditSummary'=> 'required',
          'checkEditContent'=> 'required',
          'tags'=> 'required',
        ]);
        $newFileName=$this->manageImage(request('image'));

        $tags = explode(",", request('tags'));
        $keywords = explode(",", request('keywords'));
        $post= new Post();
        $slug = Str::slug($post->title, '-');
        $post->title=request('title');
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
        $post->slug=$slug;
        $post->keywords=request('keywords');
        $post->save();
        $post->tag($tags);
        foreach($keywords as $keyword){
          $existKey=$this->getKeywordIf($keyword);

          $post->keywords()->attach($existKey->id);
        }

        $postToAdd=$this->getPost($post->id);
        return $postToAdd;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

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
      $post= Post::findOrFail($post->id);
      $newFileName;
      $dataPost;
      if (request('img_url')!=""){
        $dataPost=request()->validate([
          'title'=> 'required|max:255',
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
        $post->content=request('content');
        $post->publicate_state=false;
        $post->summary=request('summary');
        $post->category_id=request('category_id');
        $post->cant_access_read=0;
        $post->cant_likes=0;
        $post->cant_shares=0;
        $post->tags=request('tags');
        $post->slug=$slug;
        $post->update();
        $post->retag($tags);
        $post->keywords()->detach();
        foreach($keywords as $keyword){
          $existKey=$this->getKeywordIf($keyword);


          $post->keywords()->attach($existKey->id);
        }

        $postToUpd=$this->getPost($post->id);
        return $postToUpd;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {
        $post=Post::find($post->id);
        $this->delImage($post->img_url);
        $post->delete();
        $post->untag();
        $post->keywords()->detach();
        return response()->json('Post deleted');
    }
}
