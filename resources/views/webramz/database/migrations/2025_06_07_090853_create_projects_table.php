<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->enum('type', ['store', 'company'])->default('store')->index();
            $table->enum('plan', ['basic', 'pro', 'vip', 'elite'])->default('vip')->index();
            $table->enum('lang', [1, 2, 3])->default(1); // بدون تغییر
            $table->integer('figma_count')->default(0);

            $table->integer('days')->nullable();
            $table->timestamp('delivery_date')->nullable()->index();
            $table->timestamp('start_date')->nullable()->index();
            $table->timestamp('sign_date')->nullable()->index();

            $table->string('ticket')->nullable();
            $table->string('demo')->nullable();
            $table->string('figma')->nullable();
            $table->string('domain')->nullable();

            $table->enum('status', [
                'design',
                'development',
                'demo_delivery',
                'waiting_content',
                'reviewing',
                'applying_edits',
                'post_edit_delivery',
                'secondary_language',
                'training_video',
                'final_delivery'
            ])->default('design')->index();

            $table->enum('design_status', [
                'design',
                'design_review',
                'counseling',
                'finished',
            ])->default('counseling')->index();

            $table->foreignId('designer_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('developer_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
