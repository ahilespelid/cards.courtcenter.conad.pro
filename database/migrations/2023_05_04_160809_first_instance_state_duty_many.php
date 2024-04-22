<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FirstInstanceStateDutyMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::connection('two')->create('first_instance_state_duty__many', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('first_instance_id')->unsigned()->nullable();
            $table->unsignedBigInteger('state_duty_id')->unsigned()->nullable();
            
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();

           $table->foreign('first_instance_id')->references('id')->on('first_instance')->onDelete('cascade');
           $table->foreign('state_duty_id')->references('id')->on('first_instance_state_duty')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::connection('two')->dropIfExists('first_instance_state_duty__many');}
}
