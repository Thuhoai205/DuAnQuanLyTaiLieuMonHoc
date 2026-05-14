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
        
        Schema::create('users', function (Blueprint $table) {
    $table->id('user_id');
    $table->string('username', 50)->unique();
    $table->string('password', 255);
    $table->string('full_name', 100)->nullable();
    $table->string('email', 100)->unique()->nullable();
    $table->text('avatar')->nullable();
    $table->foreignId('role_id')->constrained('roles', 'role_id');
    $table->boolean('is_active')->default(true);
    
    // Xóa dòng này: $table->timestamp('created_at')->useCurrent(); 
    
    $table->timestamps(); // Lệnh này đã bao gồm cả created_at và updated_at rồi
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};