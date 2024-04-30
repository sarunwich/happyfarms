<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('picture',255);
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types');
            $table->unsignedBigInteger('packaging_id')->nullable();
            $table->foreign('packaging_id')->references('id')->on('packagings');
            $table->integer('unit')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->longText('recommen')->nullable();
            $table->longText('information')->nullable();
            $table->longText('details')->nullable();
            $table->unsignedBigInteger('farm_id')->nullable();
            $table->foreign('farm_id')->references('id')->on('farms');
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
