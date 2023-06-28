<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\House;
use App\Models\Service;

class SponsoredHouseController extends Controller
{
    public function index(Request $request)
    {
        $filtri = $request->all();


        if ($request->has('filtri') && $filtri) {
            $services_ids = explode(',', $filtri['filtri']);

            $houses = House::whereHas('services', function ($query) use ($services_ids) {
                $query->whereIn('service_id', $services_ids);
            }, '=', count($services_ids))
                ->with('services')->where('visibility', true)->where('sponsorship', true)->get();

            return response()->json([
                'success' => true,
                'results' => $houses
            ]);
        } else {
            $results = House::with('services')->where('visibility', true)->where('sponsorship', true)->get();

            return response()->json([
                'success' => true,
                'results' => $results
            ]);
        }
    }
}
