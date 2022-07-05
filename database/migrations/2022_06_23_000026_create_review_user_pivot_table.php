<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('review_user', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id');
            $table->foreign('review_id', 'review_id_fk_6852295')->references('id')->on('reviews')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_6852295')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
