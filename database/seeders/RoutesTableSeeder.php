<?php

namespace Database\Seeders;

use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Route::insert([
            [
                'name' => 'Mexicali-Tecate-Tijuana-Rosarito-Ensenada',
                'distance' => 289.78,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ensenada-Rosarito-Tijuana-Tecate-Mexicali',
                'distance' => 289.78,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mexicali-Tecate',
                'distance' => 129.75,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tecate-Mexicali',
                'distance' => 129.75,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mexicali-Tecate-Ensenada',
                'distance' => 269.69,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ensenada-Tecate-Mexicali',
                'distance' => 269.69,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mexicali-Tijuana',
                'distance' => 171.56,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tijuana-Mexicali',
                'distance' => 171.56,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
