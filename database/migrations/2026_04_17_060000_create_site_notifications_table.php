<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('recipient_role', ['all', 'admin', 'consultant', 'customer'])->default('customer');
            $table->string('category', 60)->default('General');
            $table->string('title', 255);
            $table->text('message');
            $table->enum('status', ['Unread', 'Read'])->default('Unread');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['recipient_role', 'recipient_user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_notifications');
    }
};
