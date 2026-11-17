<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_jewellery_quotations', function (Blueprint $table) {
            $table->string('quotation_image')->nullable()->after('quotation_note');
        });
    }

    public function down(): void
    {
        Schema::table('custom_jewellery_quotations', function (Blueprint $table) {
            $table->dropColumn('quotation_image');
        });
    }
};
