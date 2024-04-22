<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bankruptcy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::connection('two')->create('bankruptcy', function (Blueprint $table){
            $table->id();
            $table->string('deal_id')->nullable();
            $table->string('deal_into_id')->nullable();
            $table->text('applicant')->nullable(); ///*/ Заявитель ///*/
            $table->text('debtor')->nullable(); ///*/ Должник ///*/
            $table->text('bankruptcy_trustee')->nullable(); ///*/ Конкурсный управляющий ///*/
            //$table->text('strategy')->nullable(); ///*/ Стратегия ///*/
            $table->text('state_duty')->nullable(); ///*/ Госпошлина ///*/
            $table->text('deposit')->nullable(); ///*/ Депозит ///*/
            $table->text('number_case')->nullable(); ///*/ Номер дела ///*/
            $table->text('link')->nullable(); ///*/ Ссылка на дело в суде ///*/
            //$table->text('stage')->nullable(); ///*/ Стадия банкротства ///*/
            $table->string('date_current_stage')->nullable(); ///*/ Дата окончания текущей стадии ///*/
            $table->text('information_creditors')->nullable(); ///*/ Информация о кредиторах ///*/
            $table->text('property_valuation')->nullable(); ///*/ Информация об имуществе должника и его оценка ///*/
            $table->text('bank_accounts')->nullable(); ///*/ Информация о банковских счетах должника ///*/
            $table->text('information_invalidation')->nullable(); ///*/ Информация о признании сделок/платежей недействительными ///*/
            //$table->text('information_court')->nullable(); ///*/ Информация об участии финансового управляющего на судебных заседаниях ///*/
            //$table->integer('payments')->nullable(); ///*/ Платежи, сумма оплат, п/п ///*/
            $table->text('subsidiary_liability')->nullable(); ///*/ Субсидиарная ответственность ///*/
            $table->text('assessment_property')->nullable(); ///*/ Оценка имущества должностных лиц ///*/
            $table->text('result_case')->nullable(); ///*/ Результат банкротства ///*/
                                    
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
    public function down(){Schema::connection('two')->dropIfExists('bankruptcy');}
}
