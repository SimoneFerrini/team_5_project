<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $houseId = $request->query('id');

        $results = Image::where('house_id', $houseId)->get();

        if ($results->isEmpty()) {
            return response()->json([
                'success' => false,
                'results' => []
            ]);
        }

        $imageData = $results->toArray();

        return response()->json([
            'success' => true,
            'results' => $imageData
        ]);
    }
}
