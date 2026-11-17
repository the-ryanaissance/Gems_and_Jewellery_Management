<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('content_posts') || !Schema::hasColumn('content_posts', 'published_at')) {
            return;
        }

        DB::statement('ALTER TABLE content_posts MODIFY published_at DATE NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE content_posts MODIFY published_at TIMESTAMP NULL DEFAULT NULL');
    }
};
