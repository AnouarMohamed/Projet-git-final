<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_ai_suggestions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->text('summary');
            $table->string('suggested_priority');
            $table->unsignedSmallInteger('estimated_minutes');
            $table->json('subtasks');
            $table->json('risks');
            $table->string('provider')->default('demo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_ai_suggestions');
    }
};
