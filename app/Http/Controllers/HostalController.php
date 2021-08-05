<?php

namespace App\Http\Controllers;

use App\Models\Hostal;
use App\Traits\HostalTrait;
use App\Traits\KeywordTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HostalController extends Controller
{
  use KeywordTrait, ImageTrait, HostalTrait;

     /**
     * Hostals List
     */

     public function getHostalList(){
       $hostals=Hostal::with('keywords')->get();
       return $hostals;
     }

     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hostals.index');
    }

    /**
     * Create Folder for images of hostals
     */

     public function createFolderHostal(string $slug){

       $oldImg=[];
       $oldImg[]=public_path().'/storage/hostales/'.$slug;
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Area_de_Servicio';
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Frente';
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Habitaciones';
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Otras_Areas';
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Sala';
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Saleta';
       $oldImg[]=public_path().'/storage/hostales/'.$slug.'/Terraza';
       foreach ($oldImg as $old) {
         if(!File::exists($old)){
       File::makeDirectory($old);
      }
        }
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
            'name'=> 'required|max:255',
            'phone'=> 'required',
            'image'=> 'required|image',
            'address'=> 'required',
            'email'=> 'required',
            'tags'=> 'required',
            'keywords'=> 'required',
          ]);
          $name_host=request('name');
          $slug=Str::slug($name_host, '-');
          if(!Hostal::where('slug',$slug)->exists()){
          $this->createFolderHostal($slug);
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
          $hostal= new Hostal();
          $hostal->name=$name_host;
          $hostal->phone=request('phone');
          $hostal->active=false;
          $hostal->img_ppal_url='hostal_default.png';
          $hostal->address=request('address');
          $hostal->user_id=auth()->user()->id;
          $hostal->email=request('email');
          $hostal->tags=request('tags');
          $hostal->slug=$slug;
          $hostal->keywords=request('keywords');
          //$this->authorize('store',$hostal);
          $hostal->save();
          $newFileName=$this->manageImageFile(request('image'),'hostales/'.$slug);
          $hostal->img_ppal_url=$newFileName;
          $hostal->update();
          $hostal->qr_img_web_url='qrcode_'.$hostal->id.'_'.$hostal->slug.'.svg';
          $hostal->update();
          QrCode::format('svg')->color(33, 56, 175)->generate(url('/hostal/'.$hostal->slug),public_path('storage/qrcodes/hostals/qrcode_'.$hostal->id.'_'.$hostal->slug.'.svg'));
          $hostal->tag($tags);
          if(is_array($keywords)){
            foreach($keywords as $keyword){
              $existKey=$this->getKeywordIf($keyword);

              $hostal->keywords()->attach($existKey->id);
            }
          }
          else{
            $existKey=$this->getKeywordIf($keywords);
            $hostal->keywords()->attach($existKey->id);
          }



          $hostalToAdd=$this->getHostal($hostal->id);
          return $hostalToAdd;
        }
        return ['exception'=> "Error",'message'=>'An item with the same key is in data base.'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hostal  $hostal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hostal $hostal)
    {

      /*if(Gate::denies('admin')){
        abort('403');
      }
      $this->authorize('update',$hostal);*/

      $hostal= Hostal::findOrFail($hostal->id);
      $newFileName;
      $dataPost;
      if (request('image')!=""){
        $dataPost=request()->validate([
          'name'=> 'required|max:255',
          'phone'=> 'required',
          'image'=> 'required|image',
          'address'=> 'required',
          'email'=> 'required',
          'tags'=> 'required',
          'keywords'=> 'required',
        ]);
        $newFileName=$this->manageImageFile(request('image'),'hostales/'.$hostal->slug);

        $this->delImageFile($hostal->img_ppal_url,'hostales/'.$hostal->slug);
          $hostal->img_ppal_url=$newFileName;
      }
      else{
        $dataPost=request()->validate([
          'name'=> 'required|max:255',
          'phone'=> 'required',
          'address'=> 'required',
          'email'=> 'required',
          'tags'=> 'required',
          'keywords'=> 'required',
        ]);
      }

        $tags = explode(",", request('tags'));
        $keywords = explode(",", request('keywords'));
        $slug = Str::slug($hostal->name, '-');
        $hostal->name=request('name');
        $hostal->phone=request('phone');
        $hostal->active=false;
        $hostal->address=request('address');
        $hostal->user_id=auth()->user()->id;
        $hostal->email=request('email');
        $hostal->tags=request('tags');
        $hostal->slug=Str::slug($hostal->name, '-');
        $hostal->qr_img_web_url='qrcode_'.$hostal->id.'_'.$hostal->slug.'.svg';
        $hostal->update();
        QrCode::format('svg')->color(33, 56, 175)->generate(url('/hostal/'.$hostal->slug),public_path('storage/qrcodes/hostals/qrcode_'.$hostal->id.'_'.$hostal->slug.'.svg'));
        $hostal->retag($tags);
        $hostal->keywords()->detach();
        foreach($keywords as $keyword){
          $existKey=$this->getKeywordIf($keyword);


          $hostal->keywords()->attach($existKey->id);
        }

        $hostalToUpd=$this->getHostal($hostal->id);
        return $hostalToUpd;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hostal  $hostal
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $hostal)
    {

      //$this->authorize('delete',$hostal);
        $hostal=Hostal::find($hostal);
        $this->delImageFile($hostal->img_ppal_url,'hostales/'.$hostal->slug);
        $hostal->delete();
        $hostal->untag();
        $hostal->keywords()->detach();
        $file_path = public_path("storage/hostales/".$hostal->slug);

       if(File::exists($file_path)) File::deleteDirectory($file_path);
        return response()->json('Hostal deleted');
    }
}
