<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('email');
            $table->date('birth_date')->nullable()->after('phone_number');
            $table->string('zodiac_sign', 50)->nullable()->after('birth_date');
            $table->text('address')->nullable()->after('zodiac_sign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'birth_date', 'zodiac_sign', 'address']);
        });
    }
};
