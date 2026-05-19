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
        Schema::create('tai_lieus', function (Blueprint $table) {

    $table->id('tai_lieu_id');

    $table->string('tieu_de', 255);

    $table->string('slug')->unique();

    $table->string('ten_file');

    $table->text('duong_dan');

    $table->string('file_extension', 20)->nullable();

    $table->bigInteger('kich_thuoc')->nullable();

    $table->integer('luot_tai')->default(0);

    $table->text('mo_ta')->nullable();

    $table->boolean('is_public')->default(true);

    $table->string('ma_mon', 20);

    $table->foreign('ma_mon')
        ->references('ma_mon')
        ->on('mon_hocs')
        ->cascadeOnDelete();

    $table->foreignId('loai_id')
        ->constrained('loai_tai_lieus', 'loai_id')
        ->restrictOnDelete();

    $table->foreignId('nguoi_upload')
        ->nullable()
        ->references('user_id')
        ->on('users')
        ->nullOnDelete();

    $table->timestamps();

    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_lieus');
    }
};