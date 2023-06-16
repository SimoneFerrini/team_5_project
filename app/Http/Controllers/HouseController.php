<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $houses = House::where('user_id', $user_id)->get();
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

        $this->validation($formData);

        $newHouse = new House();

        if($request->hasFile('thumbnail')){
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
        return view('houses.show', compact('house'));
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

        return view('houses.edit', compact('house', 'services'));
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

        if($request->hasFile('thumbnail')){
            if($house->thumbnail){
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
        if($house->thumbnail){
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
            "thumbnail.required" => 'Inserisci una foto.',
            "thumbnail.image" => 'Il tipo di file non è supportato.',
            "thumbnail.max" => "Il peso dell'immagine non va bene.",
        ])->validate();
        return $validator;
    }
}
