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
        Schema::create('ad_apartment_furniture', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ad')->cascadeOnDelete();
            $table->foreignId('apartment_furniture_id')->constrained('apartment_furniture')->cascadeOnDelete();
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
        Schema::dropIfExists('ad_apartment_furniture');
    }
};
