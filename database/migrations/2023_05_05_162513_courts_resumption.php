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
        Schema::connection('two')->create('courts_resumption', function (Blueprint $table){
            $table->id();
            $table->string('deal_id')->nullable();
            $table->string('deal_into_id')->nullable();
            $table->text('reasons_resuming')->nullable(); ///*/ Причины, по которым возобновляется производство ///*/
            $table->text('initiator')->nullable(); ///*/ Инициатор ///*/
            $table->text('stage_resumption')->nullable(); ///*/ Стадия возобновления ///*/
            //$table->text('strategy')->nullable(); ///*/ Стратегия ///*/

            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::connection('two')->dropIfExists('courts_resumption');}
}
