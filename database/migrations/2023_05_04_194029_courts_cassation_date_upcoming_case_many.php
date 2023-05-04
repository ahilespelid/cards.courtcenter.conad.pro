<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsCassationDateUpcomingCaseMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_cassation_date_upcoming_case__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courts_cassation_id')->unsigned();
            $table->unsignedBigInteger('courts_cassation_date_upcoming_case_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();

           $table->foreign('courts_cassation_id')->references('id')->on('courts_cassation')->onDelete('cascade');
           $table->foreign('courts_cassation_date_upcoming_case_id')->references('id')->on('courts_cassation_date_upcoming_case')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('courts_cassation_date_upcoming_case__many');}
}
