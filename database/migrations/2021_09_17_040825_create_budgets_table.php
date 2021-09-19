<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->enum('travel_type', ['One way', 'Round trip']);
            $table->foreignId('one_way_route_id')->constrained('routes');
            $table->foreignId('return_route_id')->constrained('routes')->nullable();
            $table->timestamp('departure_time');
            $table->timestamp('return_time')->nullable();
            $table->integer('passengers');
            $table->foreignId('transport_unit_id')->constrained('transport_units');
            $table->integer('amount');
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
        Schema::dropIfExists('budgets');
    }
}
