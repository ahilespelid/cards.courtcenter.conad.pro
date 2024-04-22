<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MediationTypeDebt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::connection('two')->create('mediation_type_debt', function (Blueprint $table) {
            $table->id();
            $table->text('option')->nullable();
            
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
        });

        DB::table('mediation_type_debt')->insert(
        ['option' => 'Медиативный'],
        ['option' => 'Коммерческий'],
        ['option' => 'Принципиальный'],
        ['option' => 'Бесперспективный']
        );
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){Schema::connection('two')->dropIfExists('mediation_type_debt');}
}