<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'lower_admin', 'content_manager', 'consultant', 'customer') DEFAULT 'customer'");
    }

    public function down(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'consultant', 'customer') DEFAULT 'customer'");
    }
};
