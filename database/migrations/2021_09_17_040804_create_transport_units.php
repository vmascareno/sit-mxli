<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('fuel', ['Gas', 'Diesel']);
            $table->float('fuel_unit_price');
            $table->float('tollbooth_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_units');
    }
}
