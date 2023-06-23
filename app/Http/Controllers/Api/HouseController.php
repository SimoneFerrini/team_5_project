<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Service;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    //class HouseController extends Controller


    //ricordati di aggiungere le altre tabelle collegate ad es, messaggi, statistiche e premium nel with
    public function index(Request $request)
    {
        $filtri = $request->all();


        if ($request->has('filtri') && $filtri) {
            $services_ids = explode(',', $filtri['filtri']);

            $houses = House::whereHas('services', function ($query) use ($services_ids) {
                $query->whereIn('service_id', $services_ids);
            }, '=', count($services_ids))
                ->with('services')->get();

            return response()->json([
                'success' => true,
                'results' => $houses
            ]);
        } else {
            $results = House::with('services')->get();

            return response()->json([
                'success' => true,
                'results' => $results
            ]);
        }
    }
    public function show($id)
    {
        $house = House::where('id', $id)->with('services')->first();

        if ($house) {
            return response()->json([
                'success' => true,
                'house' => $house,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'House not found'
            ]);
        }
    }
}
