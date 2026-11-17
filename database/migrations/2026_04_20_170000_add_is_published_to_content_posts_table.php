<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('content_posts') || Schema::hasColumn('content_posts', 'is_published')) {
            return;
        }

        Schema::table('content_posts', function (Blueprint $table) {
            $table->boolean('is_published')
                ->default(true)
                ->after('published_at');
        });

        DB::table('content_posts')->update(['is_published' => true]);
    }

    public function down(): void
    {
        if (Schema::hasTable('content_posts') && Schema::hasColumn('content_posts', 'is_published')) {
            Schema::table('content_posts', function (Blueprint $table) {
                $table->dropColumn('is_published');
            });
        }
    }
};
