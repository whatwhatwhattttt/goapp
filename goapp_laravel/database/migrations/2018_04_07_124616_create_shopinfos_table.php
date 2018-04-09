<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopinfos', function (Blueprint $table) {
            $table->increments('id');
          //  $table->foreign('sellerid')->references('id')->on('userinfos');
            $table->text('Shopintroduction')->comment('店铺介绍');
            $table->string('starlevel')->comment('星级');
            $table->string('evaluation')->comment('用户评价');
            $table->string('starnumber')->comment('用户星数');
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
        Schema::dropIfExists('shopinfos');
    }
}
