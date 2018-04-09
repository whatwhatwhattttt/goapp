<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();//账号唯一
            $table->integer('phone');//限制手机长度 int类型 integer 默认11长度
            $table->string('password','40');//密码限制长度
            $table->string('Realname','40');//真实姓名
            $table->string('gander','10');//性别
            $table->string('nickname','30')->unique();//昵称唯一
            $table->string('email')->unique();//邮箱唯一
            $table->integer('age');//年龄
            $table->string('QQ');//QQ
            $table->rememberToken();//实现自动登录
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
        Schema::dropIfExists('userinfos');
    }
}
