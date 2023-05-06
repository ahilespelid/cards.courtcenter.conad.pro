<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mediation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('mediation', function (Blueprint $table){
            $table->id();
            $table->text('procedural_succession'); ///*/ Процессуальное правопреемство ///*/
            $table->text('assessment_property'); ///*/ Оценка имущества ///*/
            //$table->text('strategy'); ///*/ Стратегия ///*/
            $table->integer('type_debt_id')->nullable(); ///*/ Определение типа долга ///*/ 
            $table->text('contact_debtor'); ///*/ Контакт должника ///*/
            //$table->text('discount_calculation'); ///*/ Расчет дисконта ///*/
            $table->text('first_offer_debtor'); ///*/ Первое предложение должнику ///*/
            //$table->text('second_offer_debtor'); ///*/ Второе предложение должнику ///*/ 
            $table->text('third_offer_debtor'); ///*/ Третье предложение должнику ///*/ 
            $table->text('fourth_offer_debtor'); ///*/ Четвертое предложение должнику ///*/
            $table->text('fifth_offer_debtor'); ///*/ Пятое предложение ///*/                                    

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
    public function down(){Schema::dropIfExists('mediation');}
}
