<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users') || Schema::hasColumn('users', 'account_status')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->enum('account_status', ['Active', 'Inactive', 'Blocked'])
                ->default('Active')
                ->after('role');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('users') || !Schema::hasColumn('users', 'account_status')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_status');
        });
    }
};
