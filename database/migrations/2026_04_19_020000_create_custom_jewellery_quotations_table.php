<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('custom_jewellery_quotations');

        Schema::create('custom_jewellery_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_jewellery_request_id')->constrained('custom_jewellery_requests')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('quotation_number', 40)->unique();
            $table->decimal('quotation_amount', 12, 2);
            $table->text('quotation_note')->nullable();
            $table->enum('status', ['Sent', 'Accepted', 'Rejected', 'Paid'])->default('Sent');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['custom_jewellery_request_id', 'status'], 'cjq_request_status_idx');
            $table->index(['user_id', 'status'], 'cjq_user_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_jewellery_quotations');
    }
};
