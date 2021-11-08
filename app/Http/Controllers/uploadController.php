<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class uploadController extends Controller
{
  function fileUpload(Request $request){
$result=$request->file('fileKey')->store('images');
return $result;
  }
}
