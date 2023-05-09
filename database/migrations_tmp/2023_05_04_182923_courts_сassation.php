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
            $table->string('deal_id')->nullable();
            $table->string('deal_into_id')->nullable();
            $table->text('applicant_complaint')->nullable(); ///*/ Заявитель жалобы ///*/
            //$table->text('strategy')->nullable(); ///*/ Стратегия ///*/
            $table->integer('state_duty')->nullable(); ///*/ Госпошлина ///*/
            $table->text('complaint')->nullable(); ///*/ Кассационная жалоба ///*/
            $table->text('objections')->nullable(); ///*/ Возражения на кассационную жалобу ///*/
            $table->text('court_judge')->nullable(); ///*/ Суд, Судья ///*/
            //$table->timestamp('date_upcoming_case')->nullable(); ///*/ Дата назначения к слушанию ///*/
            $table->text('number_case')->nullable(); ///*/ Номер дела в суде кассационной инстанции ///*/
            $table->text('link')->nullable(); ///*/ Ссылка на дела в суде кассационной инстанции ///*/
            //$table->text('information_progress')->nullable(); ///*/ Информация о ходе рассмотрения кассационной жалобы ///*/
            $table->text('result_case')->nullable(); ///*/ Результат рассмотрения ///*/
            $table->integer('sum_case')->nullable(); ///*/ Сумма заявленных требований и удовлетворенных судом ///*/
            $table->string('date_production_case')->nullable(); ///*/ Дата фактического изготовления судебного акта ///*/ 
            $table->string('date_receipt_case')->nullable(); ///*/ Дата получения постановления суда кассационной инстанции ///*/ 
            $table->text('information_case')->nullable(); ///*/ Информация о дальнейших действиях ///*/
            $table->integer('sum_services')->nullable(); ///*/ Сумма оказанных юридических услуг ///*/
                                    
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
    public function down(){Schema::dropIfExists('courts_сassation');}
}
