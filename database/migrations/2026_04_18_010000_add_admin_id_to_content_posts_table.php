<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('content_posts', 'admin_id')) {
            return;
        }

        $adminId = DB::table('users')
            ->where('role', 'admin')
            ->orderBy('id')
            ->value('id');

        if (!$adminId) {
            $adminId = DB::table('users')
                ->orderBy('id')
                ->value('id');
        }

        if ($adminId) {
            DB::table('content_posts')
                ->whereNull('admin_id')
                ->update(['admin_id' => $adminId]);
        }

        Schema::table('content_posts', function (Blueprint $table) {
            $table->foreignId('admin_id')
                ->after('id')
                ->constrained('users')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('content_posts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('admin_id');
        });
    }
};
