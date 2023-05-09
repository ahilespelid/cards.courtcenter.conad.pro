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
            $table->string('deal_id')->nullable();
            $table->string('deal_into_id')->nullable();
            $table->text('procedural_succession')->nullable(); ///*/ Процессуальное правопреемство ///*/
            $table->text('assessment_property')->nullable(); ///*/ Оценка имущества ///*/
            //$table->text('strategy')->nullable(); ///*/ Стратегия ///*/
            $table->integer('type_debt')->nullable(); ///*/ Определение типа долга ///*/ 
            $table->text('contact_debtor')->nullable(); ///*/ Контакт должника ///*/
            //$table->text('discount_calculation')->nullable(); ///*/ Расчет дисконта ///*/
            $table->text('first_offer_debtor')->nullable(); ///*/ Первое предложение должнику ///*/
            //$table->text('second_offer_debtor')->nullable(); ///*/ Второе предложение должнику ///*/ 
            $table->text('third_offer_debtor')->nullable(); ///*/ Третье предложение должнику ///*/ 
            $table->text('fourth_offer_debtor')->nullable(); ///*/ Четвертое предложение должнику ///*/
            $table->text('fifth_offer_debtor')->nullable(); ///*/ Пятое предложение ///*/                                    

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
    public function down(){Schema::dropIfExists('mediation');}
}
