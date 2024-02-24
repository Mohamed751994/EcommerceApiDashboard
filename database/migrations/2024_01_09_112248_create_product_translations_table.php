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
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('language_id')->index();
            $table->enum('type', ['normal','new','featured','offer'])->nullable()->default('normal');
            $table->string('name');
            $table->double('price');
            $table->string('currency')->nullable()->default('ر.س');
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->text('description');
            $table->text('benefits')->nullable();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('calories')->nullable()->default(0);
            $table->bigInteger('carbohydrates')->nullable()->default(0);
            $table->bigInteger('fiber')->nullable()->default(0);
            $table->bigInteger('cholesterol')->nullable()->default(0);
            $table->bigInteger('sugar')->nullable()->default(0);
            $table->bigInteger('fats')->nullable()->default(0);
            $table->unique(['product_id','language_id']);
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
