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
        Schema::create('ad_gets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_moderation_id')->nullable()->constrained('status_moderation')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('ad_gender_type_id')->nullable()->constrained('ad_gender_types')->nullOnDelete();
            $table->integer('rooms_count')->default(1);
            $table->integer('roommate_count')->default(1);
            $table->integer('price')->default(0);
            $table->integer('price_from')->default(0);
            $table->string('coordinates')->nullable();
            $table->string('location')->nullable();
            $table->boolean('animals')->nullable();
            $table->text('description')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('phone_number')->nullable();
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
        Schema::dropIfExists('ad_gets');
    }
};
