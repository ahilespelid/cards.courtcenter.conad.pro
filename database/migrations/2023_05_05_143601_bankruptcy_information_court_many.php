<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankruptcyInformationCourtMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('bankruptcy_information_court__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bankruptcy_id')->unsigned();
            $table->unsignedBigInteger('information_court_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('bankruptcy_id')->references('id')->on('bankruptcy')->onDelete('cascade');
           $table->foreign('information_court_id')->references('id')->on('bankruptcy_information_court')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('bankruptcy_information_court__many');}
}