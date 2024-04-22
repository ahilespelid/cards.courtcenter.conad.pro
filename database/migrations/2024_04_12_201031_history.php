<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class History extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('one')->create('history', function (Blueprint $table) {
            $table->id();
            
            $table->string('instance')->nullable();
            $table->string('name')->nullable();
            $table->string('key')->nullable();
            $table->text('value')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::connection('one')->dropIfExists('history');}
}
