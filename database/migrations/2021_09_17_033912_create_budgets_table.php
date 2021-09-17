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
            $table->enum('travel_type', ['Una dirección', 'Viaje redondo']);
            $table->foreignId('one_way_route_id')->constrained('routes');
            $table->foreignId('return_route_id')->constrained('routes')->nullable();
            $table->timestamp('departure_time');
            $table->timestamp('return_time')->nullable();
            $table->string('amount');
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
