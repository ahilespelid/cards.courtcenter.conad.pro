<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsAppealStrategyMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_appeal_strategy__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courts_appeal_id')->unsigned();
            $table->unsignedBigInteger('strategy_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('courts_appeal_id')->references('id')->on('courts_appeal')->onDelete('cascade');
           $table->foreign('strategy_id')->references('id')->on('courts_appeal_strategy')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('courts_appeal_strategy__many');}
}
