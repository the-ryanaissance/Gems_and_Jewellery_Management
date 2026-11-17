<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_posts', function (Blueprint $table) {
            if (Schema::hasColumn('content_posts', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('content_posts', function (Blueprint $table) {
            if (!Schema::hasColumn('content_posts', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0);
            }
        });
    }
};
