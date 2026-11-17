<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->date('date');
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['Unread', 'Read', 'Replied'])->default('Unread');
            $table->string('source')->default('customer-contact-form');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};