<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreauditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeaudits', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('audit')->default(0);//审核是否通过默认是否（0）
            $table->text('Auditopinion')->comment('审核意见');
            $table->string('Auditor')->comment('审核人员');//审核日期申请日期归为created和update
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
        Schema::dropIfExists('storeaudits');
    }
}
