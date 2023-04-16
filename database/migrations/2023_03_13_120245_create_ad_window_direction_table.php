<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_window_direction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ad')->cascadeOnDelete();
            $table->foreignId('ad_window_direction_id')->constrained('window_directions')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_window_direction');
    }
};
