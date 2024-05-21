<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        //Создание таблицы
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        //удаление таблицы
        Schema::dropIfExists('product_images');
    }
};
