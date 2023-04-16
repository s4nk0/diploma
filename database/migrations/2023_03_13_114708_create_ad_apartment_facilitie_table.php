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
        Schema::create('ad_apartment_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ad')->cascadeOnDelete();
            $table->foreignId('apartment_facilities_id')->constrained('apartment_facilities')->cascadeOnDelete();
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
        Schema::dropIfExists('ad_apartment_facilitie');
    }
};
