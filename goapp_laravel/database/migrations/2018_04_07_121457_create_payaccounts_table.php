<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payaccounts', function (Blueprint $table) {
            $table->increments('id');
          //  $table->foreign('username')->references('username')->on('userinfos');
            $table->string('wechat_number');
            $table->string('alipay_number');
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
        Schema::dropIfExists('payaccounts');
    }
}
