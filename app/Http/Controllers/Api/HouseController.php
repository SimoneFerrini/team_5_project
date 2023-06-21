<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    //class HouseController extends Controller


    //ricordati di aggiungere le altre tabelle collegate ad es, messaggi, statistiche e premium nel with
    public function index()
    {

        $houses = House::with('services');

        return response()->json([
            'success' => true,
            'results' => $houses
        ]);
    }

    // public function show($id){
    //     $house = House::where('id', $id)->with('services')->first();
    //
    //     if($house){
    //         return response()->json([
    //             'success' => true,
    //             'house'=> $house,
    //         ]);          
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'error'=> 'House not found'
    //         ]);
    //     }
    // }

}
