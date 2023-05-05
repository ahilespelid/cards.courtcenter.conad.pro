<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsСassation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_сassation', function (Blueprint $table) {
            $table->id();
            $table->text('applicant_complaint'); ///*/ Заявитель жалобы ///*/
            //$table->text('strategy'); ///*/ Стратегия ///*/
            $table->integer('state_duty')->nullable(); ///*/ Госпошлина ///*/
            $table->text('complaint'); ///*/ Кассационная жалоба ///*/
            $table->text('objections'); ///*/ Возражения на кассационную жалобу ///*/
            $table->text('court_judge'); ///*/ Суд, Судья ///*/
            //$table->timestamp('date_upcoming_case')->nullable(); ///*/ Дата назначения к слушанию ///*/
            $table->text('number_case'); ///*/ Номер дела в суде кассационной инстанции ///*/
            $table->text('link'); ///*/ Ссылка на дела в суде кассационной инстанции ///*/
            //$table->text('information_progress'); ///*/ Информация о ходе рассмотрения кассационной жалобы ///*/
            $table->text('result_case'); ///*/ Результат рассмотрения ///*/
            $table->integer('sum_case')->nullable(); ///*/ Сумма заявленных требований и удовлетворенных судом ///*/
            $table->timestamp('date_production_case')->nullable(); ///*/ Дата фактического изготовления судебного акта ///*/ 
            $table->timestamp('date_receipt_case')->nullable(); ///*/ Дата получения постановления суда кассационной инстанции ///*/ 
            $table->text('information_case'); ///*/ Информация о дальнейших действиях ///*/
            $table->integer('sum_services')->nullable(); ///*/ Сумма оказанных юридических услуг ///*/
                                    
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
    public function down(){Schema::dropIfExists('courts_сassation');}
}
