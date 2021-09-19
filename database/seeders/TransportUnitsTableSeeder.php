<?php

namespace Database\Seeders;

use App\Models\TransportUnit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransportUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportUnit::insert([
            [
                'name' => 'Bus',
                'fuel' => 'Diesel',
                'fuel_unit_price' => '88.10',
                'tollbooth_price' => 321.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Car',
                'fuel' => 'Gas',
                'tollbooth_price' => 123.70,
                'fuel_unit_price' => '25.90',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Van',
                'fuel' => 'Gas',
                'tollbooth_price' => 242.80,
                'fuel_unit_price' => '25.90',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
