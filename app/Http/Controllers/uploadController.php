<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class uploadController extends Controller
{
  function fileUpload(Request $request){
    $path=$request->file('fileKey')->store('images');
$result=DB::table('file')->insert(['path'=>$path]);
if($result==true){
  return 1;
}
else{
  return 0;
}

  }


  function onSelect(){
    return DB::table('file')->get();
  }
}
