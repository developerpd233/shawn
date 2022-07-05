<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('blog_type', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->foreign('blog_id', 'blog_id_fk_6853091')->references('id')->on('blogs')->onDelete('cascade');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id', 'type_id_fk_6853091')->references('id')->on('types')->onDelete('cascade');
        });
    }
}
