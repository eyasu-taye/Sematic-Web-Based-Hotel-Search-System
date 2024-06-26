<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XMLcontroller extends Controller
{
    //
     public function index()
    {
        $xmlString = file_get_contents(public_path('sample.xml'));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true); 
   
        dd($phpArray);
    }
}
