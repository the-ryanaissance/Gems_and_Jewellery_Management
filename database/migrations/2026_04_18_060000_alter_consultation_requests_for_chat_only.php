<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('consultation_requests')) {
            return;
        }

        DB::statement("ALTER TABLE consultation_requests MODIFY preferred_date DATE NULL");
        DB::statement("ALTER TABLE consultation_requests MODIFY preferred_time VARCHAR(20) NULL");
        DB::statement("ALTER TABLE consultation_requests MODIFY appointment_mode VARCHAR(50) NULL");
        DB::statement("ALTER TABLE consultation_requests MODIFY contact_number VARCHAR(30) NULL");
    }

    public function down(): void
    {
        if (!Schema::hasTable('consultation_requests')) {
            return;
        }

        DB::statement("ALTER TABLE consultation_requests MODIFY preferred_date DATE NOT NULL");
        DB::statement("ALTER TABLE consultation_requests MODIFY preferred_time VARCHAR(20) NOT NULL");
        DB::statement("ALTER TABLE consultation_requests MODIFY appointment_mode VARCHAR(50) NULL");
        DB::statement("ALTER TABLE consultation_requests MODIFY contact_number VARCHAR(30) NULL");
    }
};
