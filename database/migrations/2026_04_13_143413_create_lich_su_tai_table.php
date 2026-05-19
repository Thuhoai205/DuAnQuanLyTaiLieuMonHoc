<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('lich_su_tai', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained('users', 'user_id')
        ->nullOnDelete();

    $table->foreignId('tai_lieu_id')
        ->constrained('tai_lieus', 'tai_lieu_id')
        ->cascadeOnDelete();

    $table->timestamp('ngay_tai')->useCurrent();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_su_tai');
    }
};