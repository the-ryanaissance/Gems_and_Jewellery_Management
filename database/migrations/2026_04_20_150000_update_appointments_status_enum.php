<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE appointments MODIFY status ENUM('Pending', 'Confirmed', 'Rejected', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE appointments MODIFY status ENUM('Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending'");
    }
};
