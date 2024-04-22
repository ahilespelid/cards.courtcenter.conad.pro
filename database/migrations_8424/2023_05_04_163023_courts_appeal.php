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
            $table->string('deal_id')->nullable();
            $table->string('deal_into_id')->nullable();
            $table->text('applicant_complaint')->nullable(); ///*/ Заявитель жалобы ///*/
            //$table->text('strategy')->nullable(); ///*/ Стратегия ///*/
            $table->integer('state_duty')->nullable()->nullable(); ///*/ Госпошлина ///*/
            $table->text('brief_complaint')->nullable(); ///*/ Краткая апелляционная жалоба ///*/
            $table->text('complaint')->nullable(); ///*/ Апелляционная жалоба ///*/
            $table->text('objections')->nullable(); ///*/ Возражения на апелляционную жалобу ///*/
            $table->string('date_filing_complaint')->nullable(); ///*/ Дата подачи жалобы ///*/
            $table->string('date_acceptance_complaint')->nullable(); ///*/ Дата принятия жалобы судом ///*/
            $table->text('court_judge')->nullable(); ///*/ Суд, Судья ///*/
            //$table->timestamp('date_upcoming_case')->nullable(); ///*/ Дата назначения к слушанию ///*/
            $table->text('number_case')->nullable(); ///*/ Номер дела в суде апелляционной инстанции ///*/
            $table->text('link')->nullable(); ///*/ Ссылка на дело в суде апелляционной инстанции ///*/
            $table->text('information_case')->nullable(); ///*/ Информация о ходе рассмотрения апелляционной жалобы ///*/ 
            $table->text('result_case')->nullable(); ///*/ Результат рассмотрения апелляционной жалобы ///*/
            $table->integer('sum_case')->nullable(); ///*/ Сумма заявленных требований и удовлетворенных судом ///*/ 
            $table->string('date_production_case')->nullable(); ///*/ Дата фактического изготовления апелляционного определения ///*/ 
            $table->string('date_receipt_case')->nullable(); ///*/ Дата получения апелляционного определения ///*/ 
            //$table->text('information_progress')->nullable(); ///*/ Информация о необходимости обжалования апелляционного определения ///*/
            $table->string('date_filing_appeal')->nullable(); ///*/ Дата подачи жалобы ///*/ 
            $table->string('date_acceptance_appeal')->nullable(); ///*/ Дата принятия жалобы ///*/ 
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
    public function down(){Schema::dropIfExists('courts_appeal');}
}
