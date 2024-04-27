<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        //Создание таблицы
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('comment');
            $table->decimal('price', 8, 2);
            $table->year('year');
            $table->unsignedBigInteger('type_category_id');

            $table->foreign('type_category_id')->references('id')->on('type_categories');

            $table->timestamps();
        });
    }

    public function down()
    {
        //удаление таблицы
        Schema::dropIfExists('products');
    }
};
