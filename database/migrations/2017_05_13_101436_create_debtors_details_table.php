<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtorsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_due_listing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cust_acno');
            $table->integer('cust_id');
            $table->integer('cust_mobile_number');
            $table->string('cust_name');
            $table->integer('loan_amount');
            $table->integer('loan_balance');
            $table->dateTime('loan_due_date');
            $table->dateTime('loan_issue_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_due_listing');
    }
}
