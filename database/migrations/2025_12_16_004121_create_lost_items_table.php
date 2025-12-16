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
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('category', 50);
            $table->string('color', 30)->nullable(); // 色は必須でない
            $table->string('found_place', 100);
            $table->date('found_date');
            $table->string('image_path', 255)->nullable(); // 画像は後で登録される可能性を考慮
            $table->text('description')->nullable();
            $table->string('status', 20)->default('保管中'); // 初期値は「保管中」
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
