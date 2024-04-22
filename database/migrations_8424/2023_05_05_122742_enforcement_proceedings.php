<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnforcementProceedings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('enforcement_proceedings', function (Blueprint $table){
            $table->id();
            $table->string('deal_id')->nullable();
            $table->string('deal_into_id')->nullable();
            $table->text('recoverer')->nullable(); ///*/ Взыскатель ///*/ 
            $table->text('debtor')->nullable(); ///*/ Должник ///*/
            $table->string('date_force')->nullable(); ///*/ Дата вступления решения в законную силу ///*/
            $table->text('time_limit')->nullable(); ///*/ Срок для предъявления исполнительного листа к исполнению ///*/
            $table->integer('sum_case')->nullable(); ///*/ Сумма денежных требований ///*/
            $table->text('information_mortgaged_property')->nullable(); ///*/ Сведения о заложенном имуществе ///*/
            //$table->text('strategy')->nullable(); ///*/ Стратегия ///*/
            $table->string('date_submission_fssp')->nullable(); ///*/ Дата подачи исполнительного листа в ФССП ///*/
            $table->string('date_initiation_fssp')->nullable(); ///*/ Дата возбуждения исполнительного производства ///*/
            $table->text('contact_bailiff')->nullable(); ///*/ ФИО судебного пристава-исполнителя, контактные данные ///*/
            $table->text('link')->nullable(); ///*/ Ссылка на исполнительное производство на сайте ФССП ///*/
            //$table->text('information_progress')->nullable(); ///*/ Информация о ходе исполнительного производства ///*/
            $table->text('arrests_bans_encumbrances')->nullable(); ///*/ Аресты, запреты, обременения ///*/
            //$table->timestamp('date_visit_bailiff')->nullable(); ///*/ Даты посещения судебного пристава-исполнителя для контроля его действий и уточнения информации ///*/
            $table->text('property_valuation')->nullable(); ///*/ Оценка имущества ///*/
            //$table->text('information_auction')->nullable(); ///*/ Сведения о торгах, дата ///*/
            $table->text('information_auction_result')->nullable(); ///*/ Сведения о результатах проведения торгов ///*/
            $table->text('offer_recoverer')->nullable(); ///*/ Предложение взыскателю оставить имущество за собой ///*/
            $table->string('date_transfer_founds')->nullable(); ///*/ Планируемая дата перечисления денежных средств ///*/
            $table->text('information_provision_debt_fssp')->nullable(); ///*/ Информация о предоставлении в ФССП актуальной информации о задолженности, с учетом процентов на день взыскания ///*/
            $table->string('date_transfer_founds_recoverer')->nullable(); ///*/ Дата поступления денежных средств взыскателю ///*/
            $table->string('date_completion')->nullable(); ///*/ Дата завершения исполнительного производства ///*/
            $table->string('date_end_execution')->nullable(); ///*/ Дата окончания следующей подачи исполнительного листа ///*/
                        
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
    public function down(){Schema::dropIfExists('enforcement_proceedings');}
}
