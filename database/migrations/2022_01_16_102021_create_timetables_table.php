<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('title_id');
            $table->date('day')->comment('開催日');
            $table->time('start')->comment('開始時間');
            $table->time('end')->comment('終了時間'); 
            $table->string('place')->nullable()->comment('住所');
            $table->string('shop_name')->nullable()->comment('開催するお店');
            $table->text('mailmap')->nullable()->comment('mail用地図');
            $table->text('map')->nullable()->comment('地図');         
            $table->string('name')->nullable()->comment('名前');
            $table->string('email')->nullable()->comment('email');
            $table->integer('member')->nullable()->comment('人数');
            $table->text('memo')->nullable()->comment('コメント');
            $table->integer('flg')->nullable();
            $table->integer('mail_flg')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('title_id')->references('id')->on('titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
