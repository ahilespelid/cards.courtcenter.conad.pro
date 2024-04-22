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
        Schema::connection('two')->create('courts_сassation_date_upcoming_case__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courts_сassation_id')->unsigned()->nullable();
            $table->unsignedBigInteger('date_upcoming_case_id')->unsigned()->nullable();
            
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();

           $table->foreign('courts_сassation_id')->references('id')->on('courts_сassation')->onDelete('cascade');
           $table->foreign('date_upcoming_case_id')->references('id')->on('courts_сassation_date_upcoming_case')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::connection('two')->dropIfExists('courts_сassation_date_upcoming_case__many');}
}