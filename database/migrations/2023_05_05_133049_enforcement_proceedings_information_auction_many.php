<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnforcementProceedingsInformationAuctionMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('enforcement_proceedings_information_auction__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enforcement_proceedings_id')->unsigned();
            $table->unsignedBigInteger('information_auction_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('enforcement_proceedings_id')->references('id')->on('enforcement_proceedings')->onDelete('cascade');
           $table->foreign('information_auction_id')->references('id')->on('enforcement_proceedings_information_auction')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('enforcement_proceedings_information_auction__many');}
}
