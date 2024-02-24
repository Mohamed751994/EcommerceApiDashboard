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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['parent', 'child'])->default('parent');
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('model_name');
            $table->string('icon')->default('bi bi-house-fill');
            $table->string('route_name');
            $table->integer('status')->default(0);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
