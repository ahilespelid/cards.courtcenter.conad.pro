<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MediationSecondOfferDebtorMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('mediation_second_offer_debtor__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mediation_id')->unsigned();
            $table->unsignedBigInteger('second_offer_debtor_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('mediation_id')->references('id')->on('mediation')->onDelete('cascade');
           $table->foreign('second_offer_debtor_id')->references('id')->on('mediation_second_offer_debtor')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('mediation_second_offer_debtor__many');}
}