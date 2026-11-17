<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jewellery', function (Blueprint $table) {
            $table->string('metal_purity', 20)->nullable()->after('metal');
            $table->decimal('making_charge', 12, 2)->default(0)->after('metal_weight');
            $table->decimal('wastage_percent', 5, 2)->default(0)->after('making_charge');
            $table->decimal('market_factor', 5, 3)->default(0.800)->after('wastage_percent');
            $table->string('pricing_mode', 20)->default('dynamic')->after('market_factor');
        });
    }

    public function down(): void
    {
        Schema::table('jewellery', function (Blueprint $table) {
            $table->dropColumn([
                'metal_purity',
                'making_charge',
                'wastage_percent',
                'market_factor',
                'pricing_mode',
            ]);
        });
    }
};
