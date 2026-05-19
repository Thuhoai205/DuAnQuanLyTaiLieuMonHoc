<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mon_hocs', function (Blueprint $table) {

            $table->string('ma_mon', 20)->primary();

            $table->string('ten_mon', 150);

            $table->string('slug')->unique();

            $table->text('mo_ta')->nullable();

            $table->string('thumbnail')->nullable();

            $table->string('icon')->nullable();

            $table->string('color', 30)->default('blue');

            $table->integer('tong_tai_lieu')->default(0);

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mon_hocs');
    }
};