<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_review', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id');
            $table->foreign('review_id', 'review_id_fk_6852296')->references('id')->on('reviews')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_6852296')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
