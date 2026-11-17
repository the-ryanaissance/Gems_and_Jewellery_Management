<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('pickup_only')->default(false)->after('shipping_cost');
            $table->decimal('deposit_amount', 12, 2)->default(0)->after('pickup_only');
            $table->decimal('balance_due', 12, 2)->default(0)->after('deposit_amount');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['pickup_only', 'deposit_amount', 'balance_due']);
        });
    }
};
