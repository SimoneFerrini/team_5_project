<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        $services = array (
            array('name' => 'Wi-Fi', 'icon' => 'fa-solid fa-wifi'),
            array('name' => 'Piscina', 'icon' => 'fa-solid fa-person-swimming'),
            array('name' => 'Lavanderia', 'icon' => 'fa-solid fa-socks'),
            array('name' => 'Parcheggio privato', 'icon' => 'fa-solid fa-square-parking'),
            array('name' => 'Tv', 'icon' => 'fa-solid fa-tv'),
            array('name' => 'Condizionatore', 'icon' => 'fa-solid fa-temperature-low'),
            array('name' => 'Pet Friendly', 'icon' => 'fa-solid fa-dog'),
            array('name' => 'Zona Fumatori', 'icon' => 'fa-solid fa-smoking'),
            array('name' => 'Biancheria da letto', 'icon' => 'fa-solid fa-bed'),
            array('name' => 'Frigo Bar', 'icon' => 'fa-solid fa-martini-glass-citrus'),
        );
        
        foreach($services as $service) {
            Service::create([
                'name' => $service['name'],
                'icon' => $service['icon'],
            ]);
        }
    }
}