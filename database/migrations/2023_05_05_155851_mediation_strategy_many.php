<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MediationStrategyMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('mediation_strategy__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mediation_id')->unsigned();
            $table->unsignedBigInteger('strategy_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('mediation_id')->references('id')->on('mediation')->onDelete('cascade');
           $table->foreign('strategy_id')->references('id')->on('mediation_strategy')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('mediation_strategy__many');}
}