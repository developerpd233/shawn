<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('chat_user', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_id');
            $table->foreign('chat_id', 'chat_id_fk_6853256')->references('id')->on('chats')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_6853256')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
