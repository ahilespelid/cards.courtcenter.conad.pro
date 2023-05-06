<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FirstInstanceInformationProgressMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('first_instance_information_progress__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('first_instance_id')->unsigned();
            $table->unsignedBigInteger('information_progress_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('first_instance_id')->references('id')->on('first_instance')->onDelete('cascade');
           $table->foreign('information_progress_id')->references('id')->on('first_instance_information_progress')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('first_instance_information_progress__many');}
}
