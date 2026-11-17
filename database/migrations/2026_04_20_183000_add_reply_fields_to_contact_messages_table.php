<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'reply_message')) {
                $table->longText('reply_message')->nullable()->after('source');
            }

            if (!Schema::hasColumn('contact_messages', 'replied_at')) {
                $table->timestamp('replied_at')->nullable()->after('reply_message');
            }

            if (!Schema::hasColumn('contact_messages', 'replied_by')) {
                $table->foreignId('replied_by')->nullable()->after('replied_at')->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            if (Schema::hasColumn('contact_messages', 'replied_by')) {
                $table->dropConstrainedForeignId('replied_by');
            }
            if (Schema::hasColumn('contact_messages', 'replied_at')) {
                $table->dropColumn('replied_at');
            }
            if (Schema::hasColumn('contact_messages', 'reply_message')) {
                $table->dropColumn('reply_message');
            }
        });
    }
};
