<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $houses = House::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return view('welcome', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('houses.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $formData = $request->all();

        $newHouse = new House();

        $this->getCoordinates($newHouse, $formData);

        $this->validation($formData);

        if ($request->hasFile('thumbnail')) {
            $path = Storage::put('houses_img', $request->thumbnail);
            $formData['thumbnail'] = $path;
            $newHouse->thumbnail = $formData['thumbnail'];
        };


        $newHouse->fill($formData);

        $newHouse->user_id = Auth::id();

        if (isset($formData['visibility'])) {
            $newHouse->visibility = true;
        } else {
            $newHouse->visibility = false;
        };
        $newHouse->save();
        if (array_key_exists('services', $formData)) {
            $newHouse->services()->attach($formData['services']);
        }
        return redirect()->route('houses.show', $newHouse);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $user_id = Auth::id();

        return view('houses.show', compact('house', 'user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        $services = Service::all();

        $user_id = Auth::id();

        return view('houses.edit', compact('house', 'services', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {

        $formData = $request->all();

        $this->validation($formData);

        $house = $this->getCoordinates($house, $formData);

        if ($request->hasFile('thumbnail')) {
            if ($house->thumbnail) {
                Storage::delete($house->thumbnail);
            }
            $path = Storage::put('houses_img', $request->thumbnail);
            $formData['thumbnail'] = $path;
        }

        $house->update($formData);

        if (array_key_exists('services', $formData)) {
            $house->services()->sync($formData['services']);
        } else {
            $house->services()->detach();
        }

        return redirect()->route('houses.show', $house);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        if ($house->thumbnail) {
            Storage::delete($house->thumbnail);
        }

        $house->delete();
        return redirect()->route('welcome');
    }

    private function validation($formData)
    {
        $validator = Validator::make($formData, [
            'title' => 'required|max:100|min:3',
            'description' => 'required|max:500',
            'rooms' => 'required|integer|min:0|max:100',
            'beds' => 'required|integer|min:0|max:200',
            'bathrooms' => 'required|max:100|integer|min:0',
            'square_mt' => 'required|integer|min:0|max:32000',
            'street' => 'required|',
            'city' => 'required|',
            'house_number' => 'required|integer|min:0|max:32000',
            'postal_code' => 'required|min:5|max:5',
            'thumbnail' => 'required|image|max:2000',
        ], [
            "title.max" => 'Il titolo può avere al massimo :max caratteri.',
            "title.required" => 'Devi inserire un titolo.',
            "title.min" => 'Il titolo deve essere di almeno :min caratteri.',
            "description.required" => 'Inserisci una descrizione.',
            "rooms.required" => 'Inserisci il numero di stanze.',
            "rooms.min" => 'Il numero di stanze non può essere inferiore a 0.',
            "rooms.max" => 'Il numero di stanze non può essere superiore a 100.',
            "beds.required" => 'Inserisci il numero di letti.',
            "beds.min" => 'Il numero di letti non può essere inferiore a 0.',
            "beds.max" => 'Il numero di letti non può essere superiore a 200.',
            "bathrooms.required" => 'Inserisci il numero di bagni.',
            "bathrooms.max" => 'Non penso tu abbia tutti questi bagni.',
            "bathrooms.min" => 'Il numero di bagni non può essere inferiori a 0.',
            "square_mt.required" => 'Inserisci i metri quadri della casa.',
            "square_mt.max" => 'I metri quadri non possono essere superiori a 32000 Mq.',
            "square_mt.min" => 'I mq non possono essere inferiori a 0.',
            "street.required" => 'Inserisci un indirizzo.',
            "city.required" => 'Inserisci la città.',
            "house_number.required" => 'Inserisci il numero civico della casa.',
            "house_number.min" => 'Il numero civico non può essere negativo.',
            "house_number.max" => 'Il numero civico non può superiore a 32000.',
            "postal_code.required" => 'Devi insirire un codice postale',
            "postal_code.max" => 'Il CAP italiano deve avere 5 caratteri',
            "postal_code.min" => 'Il CAP italiano deve avere 5 caratteri',
            "thumbnail.required" => 'Inserisci una foto.',
            "thumbnail.image" => 'Il tipo di file non è supportato.',
            "thumbnail.max" => "Le dimensioni del file sono troppo grandi.",
        ])->validate();
        return $validator;
    }


    public function getCoordinates(House $newHouse, $formData)
    {
        $response = Http::get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT' . '&streetNumber=' . $formData['house_number'] . '&streetName=' . $formData['street'] . '&municipality=' . $formData['city'] . '&postalCode=' . $formData['postal_code'] . '&maxFuzzyLevel=1' . '&view=Unified&key=5dkGa9b2PDdCXlAFGvkpEYG83DUj9jgv');

        $jsonData = $response->json();

        
        if ($newHouse->latitude) {
            if ($jsonData['results']) {
                $newHouse->latitude->update($jsonData['results'][0]['position']['lat']);
                $newHouse->longitude->update($jsonData['results'][0]['position']['lon']);
            } else {
                $this->validateCoordinates(['latitude' => $newHouse->latitude, 'longitude' => $newHouse->longitude,]);
            }
        } else {
            if ($jsonData['results']) {
                $newHouse->latitude = $jsonData['results'][0]['position']['lat'];
                $newHouse->longitude = $jsonData['results'][0]['position']['lon'];
            } else {
                $this->validateCoordinates(['latitude' => $newHouse->latitude, 'longitude' => $newHouse->longitude,]);
            }
        };


        return $newHouse;
    }

    public function validateCoordinates($newHouse)
    {
        $validator = Validator::make($newHouse, [
            'latitude' => 'required|min:0',
            'longitude' => 'required|min:0',
        ], [
            "latitude.required" => "L'indirizzo non è valido",
            "longitude.required" => "L'indirizzo non è valido",
        ])->validate();
        return $validator;
    }
}
