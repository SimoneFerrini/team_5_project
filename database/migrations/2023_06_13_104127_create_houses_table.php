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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

           $table->unsignedBigInteger('user_id');
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('title', 100)->required();
            $table->text('description', 500)->required();
            $table->tinyInteger('rooms')->required();
            $table->smallInteger('beds')->required();
            $table->tinyInteger('bathrooms')->required();
            $table->smallInteger('square_mt')->required();
            $table->string('street')->required();
            $table->smallInteger('house_number')->required();
            $table->string('city')->required();
            $table->string('postal_code')->required();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->text('thumbnail')->required();
            $table->boolean('visibility'); 
            $table->boolean('sponsorship')->default(false);           

            

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
        Schema::dropIfExists('houses');
        
    }
};
