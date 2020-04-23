<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Response;
use Image;
class ImageService extends Controller
{
  protected $noImage="noImage.jpg";
  public function avatar($imageName="noImage.jpg")
  {
    $path = public_path() .'/'. config('global.picturePaths.avatar');
    return $this->getImage($path,$imageName);
  }
  public function sPLogo($imageName="noImage.jpg"){
    $path = public_path() .'/'. config('global.picturePaths.CHRLServiceProvider');
    return $this->getImage($path,$imageName);
  }
  public function getImage($path,$imageName){
    if (!File::exists($path.$imageName)) {
        $path=$path.$this->$noImage;
    }else{
        $path=$path.$imageName;
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
  }
  public function storeAvatar(Request $request){
    if ($request->file('avatarPreview')) {
      $image = $request->file('avatarPreview');
      $fileNameToStore  = $request->fileName;
      $path = config('global.picturePaths.avatar') . $fileNameToStore;
      Image::make($image->getRealPath())->resize(300, 300)->save($path);
      return response()->json(['message'=>"image saved successfully"],200);
    }
      return response()->json(['message'=>"something went wrong"],500);
  }
  public function storeSPLogo(Request $request){
    if ($request->file('logoPreview')) {
      $image = $request->file('logoPreview');
      $fileNameToStore  = $request->fileName;
      $path = config('global.picturePaths.CHRLServiceProvider') . $fileNameToStore;
      Image::make($image->getRealPath())->resize(300, 300)->save($path);
      return response()->json(['message'=>"image saved successfully"],200);
    }
      return response()->json(['message'=>"something went wrong"],500);
  }
}
