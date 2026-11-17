<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->timestamp('reschedule_requested_at')->nullable()->after('cancelled_at');
            $table->timestamp('reschedule_responded_at')->nullable()->after('reschedule_requested_at');
            $table->date('reschedule_proposed_date')->nullable()->after('reschedule_responded_at');
            $table->string('reschedule_proposed_time', 20)->nullable()->after('reschedule_proposed_date');
            $table->text('reschedule_note')->nullable()->after('reschedule_proposed_time');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'reschedule_requested_at',
                'reschedule_responded_at',
                'reschedule_proposed_date',
                'reschedule_proposed_time',
                'reschedule_note',
            ]);
        });
    }
};
