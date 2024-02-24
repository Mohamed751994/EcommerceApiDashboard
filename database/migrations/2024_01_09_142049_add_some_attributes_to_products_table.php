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
        Schema::table('products', function (Blueprint $table) {
            $table->string('weight')->nullable()->after('offer');
            $table->bigInteger('quantity')->default(0)->after('weight');
            $table->bigInteger('calories')->nullable()->default(0)->after('quantity');
            $table->bigInteger('carbohydrates')->nullable()->default(0)->after('calories');
            $table->bigInteger('fiber')->nullable()->default(0)->after('carbohydrates');
            $table->bigInteger('cholesterol')->nullable()->default(0)->after('fiber');
            $table->bigInteger('sugar')->nullable()->default(0)->after('cholesterol');
            $table->bigInteger('fats')->nullable()->default(0)->after('sugar');
        });
        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->dropColumn('quantity');
            $table->dropColumn('calories');
            $table->dropColumn('carbohydrates');
            $table->dropColumn('fiber');
            $table->dropColumn('cholesterol');
            $table->dropColumn('sugar');
            $table->dropColumn('fats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
