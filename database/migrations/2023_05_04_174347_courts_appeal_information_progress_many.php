<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsAppealInformationProgressMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_appeal_information_progress__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courts_appeal_id')->unsigned();
            $table->unsignedBigInteger('information_progress_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('courts_appeal_id')->references('id')->on('courts_appeal')->onDelete('cascade');
           $table->foreign('information_progress_id')->references('id')->on('courts_appeal_information_progress')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('courts_appeal_information_progress__many');}
}
