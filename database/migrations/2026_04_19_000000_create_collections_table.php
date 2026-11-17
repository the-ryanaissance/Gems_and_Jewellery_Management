<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('collection_id');
            $table->unsignedInteger('product_id')->unique();
            $table->string('occasion', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('gemstone', 255)->nullable();
            $table->string('metal', 255)->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
