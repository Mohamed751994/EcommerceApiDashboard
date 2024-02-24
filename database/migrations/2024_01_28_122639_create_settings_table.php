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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('map')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('tiktok')->nullable();
            $table->text('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
