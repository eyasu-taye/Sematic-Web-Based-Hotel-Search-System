<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\models\hotels;
use App\models\swthotels;
// use hotels;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});
// Route::get('/xml', 'hotelController@savetodb');
Route::get('/ontology', function ()
    {
        $xmlString = file_get_contents(public_path('hotelowl.xml'));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $DataProperty;
        $NamedIndividual;
        $Literal;
        $dpiri;
        $niiri;
        // $Hotel_Price;

        // Convert JSON data from an array to a string
// $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
// // Write in the file
// $fp = fopen('I:\xampp\htdocs\swt\public', 'w');
// fwrite($fp, $phpArray);
// fclose($fp);

        // dd($phpArray[14]['ObjectPropertyAssertion']);
        dd($phpArray);
        $DataPropertyAssertion = $phpArray["DataPropertyAssertion"];
   
        // dd($DataPropertyAssertion);

        for ($i=0; $i < count($DataPropertyAssertion); $i++) { 
            # code...
            $DataPropertyAssertion_n = $DataPropertyAssertion[$i];
            // dd($DataPropertyAssertion_n);
            for ($j=0; $j < count($DataPropertyAssertion_n); $j++) { 
                # code...
                $DataProperty = $DataPropertyAssertion_n["DataProperty"];
                // dd($DataProperty);
                for ($k=0; $k <count($DataProperty) ; $k++) { 
                    # code...
                    $DataPropertyAttr = $DataProperty["@attributes"];
                    $dpiri = $DataPropertyAttr["IRI"];
                    // dd($dpiri);
                }
                $NamedIndividual = $DataPropertyAssertion_n["NamedIndividual"];
                for ($k=0; $k <count($NamedIndividual) ; $k++) { 
                    # code...
                    $NamedIndividualAttr = $NamedIndividual["@attributes"];
                    $niiri = $NamedIndividualAttr["IRI"];
                }
                $Literal = $DataPropertyAssertion_n["Literal"];
                // dd($Literal);
            }
                // dd($DataPropertyAssertion_n["Literal"]);
                
                $hotel = new swthotels();
                $hotel->DataProperty = $dpiri;
                $hotel->NamedIndividual = $niiri;
                $hotel->Literal = $Literal;
                // $hotel->save();

        }

        // function showhotels(Request $request){
     # code...
       $hotels = DB::select('select * from swthotels');    
      for($i=0; $i < count($hotels) ; $i++) { 
        # code...
        // dd($hotels);
        if($hotels[$i]->NamedIndividual == "#Hotel_1"){
            // return $hotels[$i]->NamedIndividual;
                $hotel = new hotels();
                $hotel->Hotel_Name=$hotels[$i]->Literal ;
                $hotel->Hotel_Category = "Five Star";
                $hotel->Hotel_Price = 300;
                $hotel->Hotel_City = "Addis Ababa";
                $hotel->save();
                }elseif ($hotels[$i]->NamedIndividual == "#Hotel_2") {
                    # code...
                    $hotel = new hotels();
                $hotel->Hotel_Name=$hotels[$i]->Literal ;
                $hotel->Hotel_Category = "Four Star";
                $hotel->Hotel_Price = 200;
                $hotel->Hotel_City = "Bahrdar";
                $hotel->save();
                }elseif ($hotels[$i]->NamedIndividual == "#Hotel_3") {
                    # code...
                $hotel->Hotel_Name=$hotels[$i]->Literal ;
                $hotel->Hotel_Category = "Three Star";
                $hotel->Hotel_Price = 100;
                $hotel->Hotel_City = "Adama";
                $hotel->save();
                }
            }
});

Route::get('/convertontologytordb', function ()
    {
        $xmlString = file_get_contents(public_path('hotelowl.xml'));
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $DataProperty;
        $NamedIndividual;
        $Literal;
        $dpiri;
        $niiri;
        // dd($phpArray);
        $DataPropertyAssertion = $phpArray["DataPropertyAssertion"];
        for ($i=0; $i < count($DataPropertyAssertion); $i++) { 
            # code...
            $DataPropertyAssertion_n = $DataPropertyAssertion[$i];
            // dd($DataPropertyAssertion_n);
            for ($j=0; $j < count($DataPropertyAssertion_n); $j++) { 
                # code...
                $DataProperty = $DataPropertyAssertion_n["DataProperty"];
                // dd($DataProperty);
                for ($k=0; $k <count($DataProperty) ; $k++) { 
                    # code...
                    $DataPropertyAttr = $DataProperty["@attributes"];
                    $dpiri = $DataPropertyAttr["IRI"];
                    // dd($dpiri);
                }
                $NamedIndividual = $DataPropertyAssertion_n["NamedIndividual"];
                for ($k=0; $k <count($NamedIndividual) ; $k++) { 
                    # code...
                    $NamedIndividualAttr = $NamedIndividual["@attributes"];
                    $niiri = $NamedIndividualAttr["IRI"];
                }
                $Literal = $DataPropertyAssertion_n["Literal"];
                // dd($Literal);
            }
                // dd($DataPropertyAssertion_n["Literal"]);
                
                $hotel = new swthotels();
                $hotel->DataProperty = $dpiri;
                $hotel->NamedIndividual = $niiri;
                $hotel->Literal = $Literal;
                $hotel->save();
        }
        dd("ontology converted to relational database successfully");
});
Route::get('/structuredata',function (){
      $hotels = DB::select('select * from swthotels');    
      for($i=0; $i < count($hotels) ; $i++) { 
        # code...
        // dd($hotels);
        if($hotels[$i]->NamedIndividual == "#Hotel_1"){
            // return $hotels[$i]->NamedIndividual;
                $hotel = new hotels();
                $hotel->Hotel_Name=$hotels[$i]->Literal ;
                $hotel->Hotel_Category = "Five Star";
                $hotel->Hotel_Price = 300;
                $hotel->Hotel_City = "Addis Ababa";
                $hotel->save();
                }elseif ($hotels[$i]->NamedIndividual == "#Hotel_2") {
                    # code...
                    $hotel = new hotels();
                $hotel->Hotel_Name=$hotels[$i]->Literal ;
                $hotel->Hotel_Category = "Four Star";
                $hotel->Hotel_Price = 200;
                $hotel->Hotel_City = "Bahrdar";
                $hotel->save();
                }elseif ($hotels[$i]->NamedIndividual == "#Hotel_3") {
                    # code...
                $hotel->Hotel_Name=$hotels[$i]->Literal ;
                $hotel->Hotel_Category = "Three Star";
                $hotel->Hotel_Price = 100;
                $hotel->Hotel_City = "Adama";
                $hotel->save();
                }
            }
            dd("data formated successfully");
});
Route::post('/searchhotel',function(){

});

function showhotelsearch(Request $request){
    $response = array(
              'status' => 'success',
               'pend' => "Messaging started",
     );//      
     // hotels = DB::select('select * from swthotels');
     $hotels = hotels::select()->where('Hotel_Name', $request->shval)->orderBy('Hotel_Price', 'desc')->get();
          $Hotel_Name[] = null;
          $Hotel_Price[] = null;
          $Hotel_Quality[] = null;
          foreach ($hotels as $ht) {
            # code...
              $Hotel_Name[] = $ht->Hotel_Name;
              $Hotel_Price[] = $ht->Hotel_Price;
              $Hotel_Quality[] = $ht->Hotel_Category;
          }
              $response2 = array(
                      'Hotel_Name' => $Hotel_Name,
                      'Hotel_Price' => $Hotel_Price,
                      'Hotel_Quality' => $Hotel_Quality,
              );
        return response()->json($response2); 
}
Route::match(['get', 'post'], 'searchHotelByName',  function (Request $request)
    {     
          $keyword = $request->keyword;
          $option = $request->option;
          
        if ($option == "All" && $keyword!="") {
          # code...
          $hotels = hotels::where('Hotel_Name', 'like', '%'.$keyword.'%')->orWhere( 'Hotel_Category', 'like', '%'.$keyword.'%')->orWhere('Hotel_Price', 'like', '%'.$keyword.'%')->orWhere('Hotel_City', 'like', '%'.$keyword.'%')->get();
          $Hotel_Name[] = null;
          $Hotel_Category[] = null;
          $Hotel_Price[] = null;
          $Hotel_City[] = null;
          foreach ($hotels as $ht) {
            # code...
              $Hotel_Name[] = $ht->Hotel_Name;
              $Hotel_Category[] = $ht->Hotel_Category;
              $Hotel_Price[] = $ht->Hotel_Price;
              $Hotel_City[] = $ht->Hotel_City;
          }
          $countHotel_Name = count($Hotel_Name);
              $response2 = array(
                      'Hotel_Name' => $Hotel_Name,
                      'Hotel_Category' => $Hotel_Category,
                      'Hotel_Price' => $Hotel_Price,
                      'Hotel_City' => $Hotel_City,
                      'countHotel_Name'=>$countHotel_Name,
              );
        return response()->json($response2);
        }elseif ($option == "Name" && $keyword!="") {
            # code...
            # code...
          $hotels = hotels::where( 'Hotel_Name', 'like', '%'.$keyword.'%')->get();
          $Hotel_Name[] = null;
          $Hotel_Category[] = null;
          $Hotel_Price[] = null;
          $Hotel_City[] = null;
          foreach ($hotels as $ht) {
            # code...
              $Hotel_Name[] = $ht->Hotel_Name;
              $Hotel_Category[] = $ht->Hotel_Category;
              $Hotel_Price[] = $ht->Hotel_Price;
              $Hotel_City[] = $ht->Hotel_City;
          }
          $countHotel_Name = count($Hotel_Name);
              $response2 = array(
                      'Hotel_Name' => $Hotel_Name,
                      'Hotel_Category' => $Hotel_Category,
                      'Hotel_Price' => $Hotel_Price,
                      'Hotel_City' => $Hotel_City,
                      'countHotel_Name'=>$countHotel_Name,
              );
              return response()->json($response2);
        }elseif ($option == "Quality" && $keyword!="") {
            # code...
            # code...
          $hotels = hotels::where( 'Hotel_Category', 'like', '%'.$keyword.'%')->get();
          $Hotel_Name[] = null;
          $Hotel_Category[] = null;
          $Hotel_Price[] = null;
          $Hotel_City[] = null;
          foreach ($hotels as $ht) {
            # code...
              $Hotel_Name[] = $ht->Hotel_Name;
              $Hotel_Category[] = $ht->Hotel_Category;
              $Hotel_Price[] = $ht->Hotel_Price;
              $Hotel_City[] = $ht->Hotel_City;
          }
          $countHotel_Name = count($Hotel_Name);
              $response2 = array(
                      'Hotel_Name' => $Hotel_Name,
                      'Hotel_Category' => $Hotel_Category,
                      'Hotel_Price' => $Hotel_Price,
                      'Hotel_City' => $Hotel_City,
                      'countHotel_Name'=>$countHotel_Name,
              );
              return response()->json($response2);
        }elseif ($option == "Price" && $keyword!="") {
            # code...
            # code...
          $hotels = hotels::where( 'Hotel_Price', 'like', '%'.$keyword.'%')->get();
          $Hotel_Name[] = null;
          $Hotel_Category[] = null;
          $Hotel_Price[] = null;
          $Hotel_City[] = null;
          foreach ($hotels as $ht) {
            # code...
              $Hotel_Name[] = $ht->Hotel_Name;
              $Hotel_Category[] = $ht->Hotel_Category;
              $Hotel_Price[] = $ht->Hotel_Price;
              $Hotel_City[] = $ht->Hotel_City;
          }
          $countHotel_Name = count($Hotel_Name);
              $response2 = array(
                      'Hotel_Name' => $Hotel_Name,
                      'Hotel_Category' => $Hotel_Category,
                      'Hotel_Price' => $Hotel_Price,
                      'Hotel_City' => $Hotel_City,
                      'countHotel_Name'=>$countHotel_Name,
              );
              return response()->json($response2);
        }elseif ($option == "City" && $keyword!="") {
            # code...
            # code...
          $hotels = hotels::where( 'Hotel_City', 'like', '%'.$keyword.'%')->get();
          $Hotel_Name[] = null;
          $Hotel_Category[] = null;
          $Hotel_Price[] = null;
          $Hotel_City[] = null;
          foreach ($hotels as $ht) {
            # code...
              $Hotel_Name[] = $ht->Hotel_Name;
              $Hotel_Category[] = $ht->Hotel_Category;
              $Hotel_Price[] = $ht->Hotel_Price;
              $Hotel_City[] = $ht->Hotel_City;
          }
          $countHotel_Name = count($Hotel_Name);
              $response2 = array(
                      'Hotel_Name' => $Hotel_Name,
                      'Hotel_Category' => $Hotel_Category,
                      'Hotel_Price' => $Hotel_Price,
                      'Hotel_City' => $Hotel_City,
                      'countHotel_Name'=>$countHotel_Name,
              );
              return response()->json($response2);
        }else
        {$keyword = $request->keyword;
                  $option = $request->options;
                  $hotel = hotels::where('Hotel_Name', 'like', '%'.$keyword.'%');}
});
