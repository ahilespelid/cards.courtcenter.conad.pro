<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FirstInstance extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('first_instance', function (Blueprint $table) {
            $table->id();
            $table->text('name_and_number'); ///*/ Название сделки, внутренний номер ///*/ 
            $table->text('parties_to_case'); ///*/ Стороны по делу ///*/ 
            $table->text('who_represent'); ///*/ Кого представляем ///*/ 
            $table->text('subject_dispute'); ///*/ Предмет спора ///*/ 
            $table->text('deposit'); ///*/ Залог ///*/ 
            //$table->text('strategy'); ///*/ Стратегия ///*/
            //$table->text('claim'); ///*/ Претензия ///*/
            //$table->integer('claim_price')->nullable(); ///*/ Цена иска ///*/
            //$table->integer('state_duty')->nullable(); ///*/ Госпошлина ///*/
            $table->timestamp('date_start')->nullable(); ///*/ Дата начала дела ///*/ 
            $table->text('number_case'); ///*/ Номер дела в суде первой инстанции ///*/ 
            $table->text('court_judge'); ///*/ Суд, Судья ///*/ 
            $table->text('link'); ///*/ Ссылка на дело на сайте суда ///*/ 
            //$table->text('information_progress'); ///*/ Информация о ходе дела ///*/
            //$table->timestamp('date_upcoming_case')->nullable(); ///*/ Дата предстоящего судебного заседания ///*/
            $table->text('information_case'); ///*/ Информация о наложении обеспечительных мер ///*/
            //$table->text('current_state_case'); ///*/ Текущее состояние дела ///*/ 
            $table->text('result_case'); ///*/ Результат рассмотрения дела ///*/ 
            $table->integer('sum_case')->nullable(); ///*/ Сумма заявленных требований и удовлетворенных судом ///*/ 
            $table->timestamp('date_force_case')->nullable(); ///*/ Дата вступления судебного акта в законную силу ///*/ 
            $table->text('time_limit'); ///*/ Срок на обжалование ///*/ 
            $table->timestamp('date_production_case')->nullable(); ///*/ Дата фактического изготовления судом решения ///*/ 
            $table->timestamp('date_receipt_case')->nullable(); ///*/ Дата получения решения ///*/ 
            $table->text('appeal_case'); ///*/ Сведения о необходимости обжалования судебного акта ///*/ 
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
    public function down(){Schema::dropIfExists('first_instance');}
}
