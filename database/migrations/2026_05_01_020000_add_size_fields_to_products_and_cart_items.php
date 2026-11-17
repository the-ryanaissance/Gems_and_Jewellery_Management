<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('size_label', 100)->nullable()->after('stock');
            $table->text('size_options')->nullable()->after('size_label');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('size_value', 120)->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('size_value');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['size_label', 'size_options']);
        });
    }
};
