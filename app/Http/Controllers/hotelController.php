<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Hotel;
use DB;

class hotelController extends Controller
{
    //
function savetodb()
    {
        $xmlString = file_get_contents(public_path('hotelowl.xml'));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $DataPropertyAssertion;
        $NamedIndividual;
        $iri;
        $litral;

        // Convert JSON data from an array to a string
// $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
// // Write in the file
// $fp = fopen('I:\xampp\htdocs\swt\public', 'w');
// fwrite($fp, $phpArray);
// fclose($fp);

        // dd($phpArray[14]['ObjectPropertyAssertion']);
        $DataPropertyAssertion = $phpArray["DataPropertyAssertion"];
   
        // dd($DataPropertyAssertion);

        for ($i=0; $i < count($DataPropertyAssertion); $i++) { 
        	# code...
        	$DataPropertyAssertion_n = $DataPropertyAssertion[$i];
            // dd($DataPropertyAssertion_n);
        	for ($j=0; $j < count($DataPropertyAssertion_n); $j++) { 
        		# code...
        		// dd($DataPropertyAssertion_n["Literal"]);
        		$NamedIndividual = $DataPropertyAssertion_n["NamedIndividual"];
                dd($NamedIndividual);
        		for ($k=0; $k <count($NamedIndividual) ; $k++) { 
        			# code...
        			$iri = $NamedIndividual["@attributes"];
        			// dd($iri["IRI"]);
        		}
        	}
        		dd($DataPropertyAssertion_n["Literal"]);
        }

    }
}
