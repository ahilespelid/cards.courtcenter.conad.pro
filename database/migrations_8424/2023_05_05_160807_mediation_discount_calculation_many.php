<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MediationDiscountCalculationMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('mediation_discount_calculation__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mediation_id')->unsigned()->nullable();
            $table->unsignedBigInteger('discount_calculation_id')->unsigned()->nullable();
            
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();

           $table->foreign('mediation_id')->references('id')->on('mediation')->onDelete('cascade');
           $table->foreign('discount_calculation_id')->references('id')->on('mediation_discount_calculation')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('mediation_discount_calculation__many');}
}