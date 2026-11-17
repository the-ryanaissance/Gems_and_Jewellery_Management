<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('consultation_requests')) {
            return;
        }

        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('consultant_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('request_number', 40)->unique();
            $table->enum('request_kind', ['Consultation'])->default('Consultation')->index();
            $table->string('request_type', 120);
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time', 20)->nullable();
            $table->string('appointment_mode', 50)->nullable();
            $table->string('contact_number', 30)->nullable();
            $table->text('customer_note');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled'])->default('Pending')->index();
            $table->text('consultant_note')->nullable();
            $table->string('chat_thread_id', 120)->nullable()->index();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
