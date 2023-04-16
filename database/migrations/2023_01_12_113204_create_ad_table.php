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
        Schema::create('ad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('apartment_condition_id')->nullable()->constrained('apartment_conditions')->nullOnDelete();
            $table->foreignId('apartment_furniture_status_id')->nullable()->constrained('apartment_furniture_statuses')->nullOnDelete();
            $table->foreignId('ad_gender_type_id')->nullable()->constrained('ad_gender_types')->nullOnDelete();
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_com')->nullable();
            $table->integer('price_pledge')->nullable();
            $table->integer('roommate_count');
            $table->integer('rooms_count')->default(1);
            $table->integer('bathrooms_count')->default(1);
            $table->integer('balconies_count')->default(0);
            $table->integer('loggias_count')->default(0);
            $table->integer('floor_from')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('square_general');
            $table->integer('square_living')->nullable();
            $table->integer('square_kitchen')->nullable();
            $table->boolean('kitchen_studio')->default(0);
            $table->string('coordinates')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('location')->nullable();
            $table->bigInteger('views')->default(0);
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
        Schema::dropIfExists('ad');
    }
};
