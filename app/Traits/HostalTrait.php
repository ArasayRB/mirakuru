<?php
namespace App\Traits;
use Illuminate\Http\Request;
use App\Models\Hostal;

trait HostalTrait {


  public function getHostalByName($name){
    $hostal=Hostal::where('name',$name)
                    ->get();
  return  $hostal;
  }


  public function getHostalServiceActive($nameHostal){
    $serviceHostalActive=Hostal::with('services')
                    ->where('name',$nameHostal)
                    ->get();
  return  $serviceHostalActive;
  }

  public function getHostalIdByName($nameHostal){
    $id=Hostal::where('name',$nameHostal)
                    ->get();
  return  $id[0]->id;
  }

  public function getNameHostalById($id){
    $name=Hostal::with('services')
                ->with('owners')
                ->with('facilities')
                ->with('closePlaces')
                ->find($id);
    return $name;
  }

  public function getHostalBySlug($slug){
    $hostal=Hostal::with('services')
                  ->with('owners')
                  ->with('facilities')
                  ->with('closePlaces')
                  ->where('slug',$slug)
                  ->get();
                  return $hostal;

  }
  public function getHostal($hostal){
    $hostals=Hostal::with('keywords')
                 ->where('id',$hostal)
                 ->first();

     if($hostals->publicate_state===0){
       $hostals->show=false;
     }
     else{
       $hostals->show=true;
      }

                 return $hostals;
  }

  public function getAllHostals(Request $request){
    $filter=$request->searcher;
    $hostals=Hostal::filterByNameAdress($filter)
                    ->get();
    $hostals_searched=[];
    foreach($hostals as $hostal){
      $findAddress=stristr($hostal->address,$filter);
      $findText=stristr($hostal->name,$filter);
      if(!empty($findText)){
        $prop='name';
        $hostal->finded==$findText;
        $small_word=substr($findText,0,strlen($filter));
        $hostal->substr=$small_word;
        $hostal->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$hostal->name);
        $hostals_searched[]=$hostal;
      }
      if(!empty($findAddress)){

          $prop='address';
          $hostal->finded==$findAddress;
          $small_word=substr($findAddress,0,strlen($filter));
          $hostal->substr=$small_word;
          $hostal->word_black=str_ireplace($filter,'<b>'.$small_word.'</b>',$hostal->address);
          $hostals_searched[]=$hostal;
      }
    }
    return $hostals_searched;
  }
}
