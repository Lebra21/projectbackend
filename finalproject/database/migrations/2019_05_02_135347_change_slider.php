<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('slider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label')->default('asdfasdf');
            $table->string('text')->default('asdfasd');
            $table->string('image')->default('asdfasdf');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('slider')->insert(
        array(
            'label' => '',
            'text' =>'',
            'image'=>''
            
        )
    );
        DB::table('slider')->insert(
        array(
            'label' => '',
            'text' =>'',
            'image'=>''
            
        )
    );
        DB::table('slider')->insert(
        array(
            'label' => '',
            'text' =>'',
            'image'=>''
            
        )
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider');
    }
}
