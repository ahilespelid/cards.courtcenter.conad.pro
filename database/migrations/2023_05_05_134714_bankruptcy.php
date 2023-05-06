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
        Schema::create('bankruptcy', function (Blueprint $table){
            $table->id();
            $table->text('applicant'); ///*/ Заявитель ///*/
            $table->text('debtor'); ///*/ Должник ///*/
            $table->text('bankruptcy_trustee'); ///*/ Конкурсный управляющий ///*/
            //$table->text('strategy'); ///*/ Стратегия ///*/
            $table->text('state_duty'); ///*/ Госпошлина ///*/
            $table->text('deposit'); ///*/ Депозит ///*/
            $table->text('number_case'); ///*/ Номер дела ///*/
            $table->text('link'); ///*/ Ссылка на дело в суде ///*/
            //$table->text('stage'); ///*/ Стадия банкротства ///*/
            $table->timestamp('date_current_stage'); ///*/ Дата окончания текущей стадии ///*/
            $table->text('information_creditors'); ///*/ Информация о кредиторах ///*/
            $table->text('property_valuation'); ///*/ Информация об имуществе должника и его оценка ///*/
            $table->text('bank_accounts'); ///*/ Информация о банковских счетах должника ///*/
            $table->text('information_invalidation'); ///*/ Информация о признании сделок/платежей недействительными ///*/
            //$table->text('information_court'); ///*/ Информация об участии финансового управляющего на судебных заседаниях ///*/
            //$table->integer('payments')->nullable(); ///*/ Платежи, сумма оплат, п/п ///*/
            $table->text('subsidiary_liability'); ///*/ Субсидиарная ответственность ///*/
            $table->text('assessment_property'); ///*/ Оценка имущества должностных лиц ///*/
            $table->text('result_case'); ///*/ Результат банкротства ///*/
                                    
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
    public function down(){Schema::dropIfExists('bankruptcy');}
}
