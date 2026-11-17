<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jewellery', function (Blueprint $table) {
            if (! Schema::hasColumn('jewellery', 'market_factor')) {
                $table->decimal('market_factor', 5, 3)->default(0.800)->after('wastage_percent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jewellery', function (Blueprint $table) {
            if (Schema::hasColumn('jewellery', 'market_factor')) {
                $table->dropColumn('market_factor');
            }
        });
    }
};
