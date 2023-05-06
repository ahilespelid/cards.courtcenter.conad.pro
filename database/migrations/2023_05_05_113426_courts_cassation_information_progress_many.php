<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsCassationInformationProgressMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_сassation_information_progress__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courts_сassation_id')->unsigned();
            $table->unsignedBigInteger('information_progress_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('courts_сassation_id')->references('id')->on('courts_сassation')->onDelete('cascade');
           $table->foreign('information_progress_id')->references('id')->on('courts_сassation_information_progress')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('courts_сassation_information_progress__many');}
}
