<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = array(
            array('name' => 'Gold', 'duration' => 24, 'price' => 2.99),
            array('name' => 'Platinum', 'duration' => 72, 'price' => 5.99),
            array('name' => 'Diamond', 'duration' => 144, 'price' => 9.99),
        );

        foreach($sponsorships as $sponsorship) {
            Sponsorship::create([
                'name' => $sponsorship['name'],
                'duration' => $sponsorship['duration'],
                'price' => $sponsorship['price'],
            ]);
        }
    }
}
