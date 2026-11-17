<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('appointments')->where('status', 'Approved')->update(['status' => 'Confirmed']);
        DB::table('appointments')->where('status', 'Rejected')->update(['status' => 'Cancelled']);
    }

    public function down(): void
    {
        DB::table('appointments')->where('status', 'Confirmed')->update(['status' => 'Approved']);
        DB::table('appointments')->where('status', 'Cancelled')->update(['status' => 'Rejected']);
    }
};
