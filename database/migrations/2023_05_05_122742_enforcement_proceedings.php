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
            $table->text('recoverer'); ///*/ Взыскатель ///*/ 
            $table->text('debtor'); ///*/ Должник ///*/
            $table->timestamp('date_force')->nullable(); ///*/ Дата вступления решения в законную силу ///*/
            $table->text('time_limit'); ///*/ Срок для предъявления исполнительного листа к исполнению ///*/
            $table->integer('sum_case')->nullable(); ///*/ Сумма денежных требований ///*/
            $table->text('information_mortgaged_property'); ///*/ Сведения о заложенном имуществе ///*/
            //$table->text('strategy'); ///*/ Стратегия ///*/
            $table->timestamp('date_submission_fssp')->nullable(); ///*/ Дата подачи исполнительного листа в ФССП ///*/
            $table->timestamp('date_initiation_fssp')->nullable(); ///*/ Дата возбуждения исполнительного производства ///*/
            $table->text('contact_bailiff'); ///*/ ФИО судебного пристава-исполнителя, контактные данные ///*/
            $table->text('link'); ///*/ Ссылка на исполнительное производство на сайте ФССП ///*/
            //$table->text('information_progress'); ///*/ Информация о ходе исполнительного производства ///*/
            $table->text('arrests, bans, encumbrances'); ///*/ Аресты, запреты, обременения ///*/
            //$table->timestamp('date_visit_bailiff')->nullable(); ///*/ Даты посещения судебного пристава-исполнителя для контроля его действий и уточнения информации ///*/
            $table->text('property_valuation'); ///*/ Оценка имущества ///*/
            //$table->text('information_auction'); ///*/ Сведения о торгах, дата ///*/
            $table->text('information_auction_result'); ///*/ Сведения о результатах проведения торгов ///*/
            $table->text('offer_recoverer'); ///*/ Предложение взыскателю оставить имущество за собой ///*/
            $table->timestamp('date_transfer_founds')->nullable(); ///*/ Планируемая дата перечисления денежных средств ///*/
            $table->text('information_provision_debt_fssp'); ///*/ Информация о предоставлении в ФССП актуальной информации о задолженности, с учетом процентов на день взыскания ///*/
            $table->timestamp('date_transfer_founds_recoverer')->nullable(); ///*/ Дата поступления денежных средств взыскателю ///*/
            $table->timestamp('date_completion')->nullable(); ///*/ Дата завершения исполнительного производства ///*/
            $table->timestamp('date_end_execution')->nullable(); ///*/ Дата окончания следующей подачи исполнительного листа ///*/
                        
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
    public function down(){Schema::dropIfExists('enforcement_proceedings');}
}
