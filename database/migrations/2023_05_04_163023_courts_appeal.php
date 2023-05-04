<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourtsAppeal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('courts_appeal', function (Blueprint $table) {
            $table->id();
            $table->text('applicant_complaint'); ///*/ Заявитель жалобы ///*/
            //$table->text('strategy'); ///*/ Стратегия ///*/
            $table->integer('state_duty')->nullable(); ///*/ Госпошлина ///*/
            $table->text('brief_complaint'); ///*/ Краткая апелляционная жалоба ///*/
            $table->text('complaint'); ///*/ Апелляционная жалоба ///*/
            $table->text('objections'); ///*/ Возражения на апелляционную жалобу ///*/
            $table->timestamp('date_filing_complaint')->nullable(); ///*/ Дата подачи жалобы ///*/
            $table->timestamp('date_acceptance_complaint')->nullable(); ///*/ Дата принятия жалобы судом ///*/
            $table->text('court_judge'); ///*/ Суд, Судья ///*/
            //$table->timestamp('date_upcoming_case')->nullable(); ///*/ Дата назначения к слушанию ///*/
            $table->text('number_case'); ///*/ Номер дела в суде апелляционной инстанции ///*/
            $table->text('link'); ///*/ Ссылка на дело в суде апелляционной инстанции ///*/
            $table->text('information_case'); ///*/ Информация о ходе рассмотрения апелляционной жалобы ///*/ 
            $table->text('result_case'); ///*/ Результат рассмотрения апелляционной жалобы ///*/
            $table->integer('sum_case')->nullable(); ///*/ Сумма заявленных требований и удовлетворенных судом ///*/ 
            $table->timestamp('date_production_case')->nullable(); ///*/ Дата фактического изготовления апелляционного определения ///*/ 
            $table->timestamp('date_receipt_case')->nullable(); ///*/ Дата получения апелляционного определения ///*/ 
            //$table->text('information_progress'); ///*/ Информация о необходимости обжалования апелляционного определения ///*/
            $table->timestamp('date_filing_appeal')->nullable(); ///*/ Дата подачи жалобы ///*/ 
            $table->timestamp('date_acceptance_appeal')->nullable(); ///*/ Дата принятия жалобы ///*/ 
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
    public function down(){Schema::dropIfExists('courts_appeal');}
}
