<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsResumption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_resumption', function (Blueprint $table){
            $table->id();
            $table->text('reasons_resuming'); ///*/ Причины, по которым возобновляется производство ///*/
            $table->text('initiator'); ///*/ Инициатор ///*/
            $table->text('stage_resumption'); ///*/ Стадия возобновления ///*/
            //$table->text('strategy'); ///*/ Стратегия ///*/

            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::dropIfExists('courts_resumption');}
}
