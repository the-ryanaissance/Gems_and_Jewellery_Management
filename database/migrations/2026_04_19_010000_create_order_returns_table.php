<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete()->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('request_number', 40)->unique();
            $table->text('reason');
            $table->enum('decision', ['Pending Review', 'Approved', 'Rejected'])->default('Pending Review');
            $table->enum('refund_status', ['In Progress', 'Refunded'])->default('In Progress');
            $table->decimal('refund_amount', 12, 2)->nullable();
            $table->text('admin_note')->nullable();
            $table->foreignId('reviewed_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();

            $table->index(['decision', 'refund_status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_returns');
    }
};
