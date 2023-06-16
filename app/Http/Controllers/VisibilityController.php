<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\HouseController;

use App\Models\House;

class VisibilityController extends Controller
{
    public function index(House $house)
    {
        if ($house->visibility) {
            $house->update(['visibility' => false]);
        } else {
            $house->update(['visibility' => true]);
        }

        return redirect()->action([HouseController::class, 'index']);
    }
}
