<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
