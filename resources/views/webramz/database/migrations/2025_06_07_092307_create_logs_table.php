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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->timestamp('date')->useCurrent();
            // اضافه کردن نام سفارشی برای کلید خارجی
            $table->foreignId('project_id')
                ->constrained('projects')
                ->onDelete('cascade')
                ->index()
                ->name('logs_project_id_foreign'); // نام سفارشی برای کلید خارجی
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->index()
                ->name('logs_user_id_foreign'); // نام سفارشی برای کلید خارجی
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
