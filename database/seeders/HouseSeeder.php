<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayHouses = config('houses');

        foreach($arrayHouses as $singleHouse){
            $newHouse = new House();

            $newHouse->user_id = $singleHouse['user_id'];
            $newHouse->title = $singleHouse['title'];
            $newHouse->description = $singleHouse['description'];
            $newHouse->rooms =$singleHouse['rooms'];
            $newHouse->beds = $singleHouse['beds'];
            $newHouse->bathrooms =$singleHouse['bathrooms'];
            $newHouse->square_mt =$singleHouse['square_mt'];
            $newHouse->street =$singleHouse['street'];
            $newHouse->city =$singleHouse['city'];
            $newHouse->house_number =$singleHouse['house_number'];
            $newHouse->postal_code =$singleHouse['postal_code'];
            $newHouse->latitude =$singleHouse['latitude'];
            $newHouse->longitude =$singleHouse['longitude'];
            $newHouse->thumbnail =$singleHouse['thumbnail'];
            $newHouse->visibility =$singleHouse['visibility'];
            

            $newHouse->save();
            
        }
    }
}