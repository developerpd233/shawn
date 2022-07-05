<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('order_transaction', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id', 'transaction_id_fk_6852405')->references('id')->on('transactions')->onDelete('cascade');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk_6852405')->references('id')->on('orders')->onDelete('cascade');
        });
    }
}
