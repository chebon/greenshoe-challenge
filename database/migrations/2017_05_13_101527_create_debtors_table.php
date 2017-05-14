<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_numbers');
            $table->integer('clearing_mpesa_trans_id');
            $table->dateTime('date_cleared');
            $table->enum('fully_cleared', ['1', '0']);
            $table->integer('mobile_number');
            $table->integer('national_id');
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
        Schema::dropIfExists('tbl_profiles');
    }
}
