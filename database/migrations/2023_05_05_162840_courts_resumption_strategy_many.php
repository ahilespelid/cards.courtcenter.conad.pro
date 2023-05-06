<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsResumptionStrategyMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_resumption_strategy__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courts_resumption_id')->unsigned();
            $table->unsignedBigInteger('strategy_id')->unsigned();
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

           $table->foreign('courts_resumption_id')->references('id')->on('courts_resumption')->onDelete('cascade');
           $table->foreign('strategy_id')->references('id')->on('courts_resumption_strategy')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('courts_resumption_strategy__many');}
}