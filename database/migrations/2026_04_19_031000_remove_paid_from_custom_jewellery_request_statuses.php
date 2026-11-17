<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("UPDATE custom_jewellery_requests SET status = 'Quoted' WHERE status = 'Paid'");
        DB::statement("ALTER TABLE custom_jewellery_requests MODIFY status ENUM('Pending', 'Approved', 'Quoted', 'Rejected') NOT NULL DEFAULT 'Pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE custom_jewellery_requests MODIFY status ENUM('Pending', 'Approved', 'Quoted', 'Rejected', 'Paid') NOT NULL DEFAULT 'Pending'");
    }
};
