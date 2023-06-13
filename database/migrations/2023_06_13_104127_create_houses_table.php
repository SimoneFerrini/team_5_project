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
           $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');//verificare se cascade va bene cosi 

            $table->string('title', 100)->required();
            $table->text('description', 500)->required();
            $table->tinyInteger('rooms')->required();
            $table->smallInteger('beds')->required();
            $table->tinyInteger('bathrooms')->required();
            $table->smallInteger('square_mt')->required();
            $table->string('street')->required();
            $table->string('city')->required();
            $table->smallInteger('house_number')->required();
            $table->double('latitude');
            $table->double('longitude');
            $table->text('thumbnail')->required();
            $table->boolean('visibility');           
            

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
