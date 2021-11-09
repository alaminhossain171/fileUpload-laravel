<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class downlodController extends Controller
{
    function onDownload($folderPath,$name){
        $result=Storage::download($folderPath."/".$name);
        return $result;
    }
}
