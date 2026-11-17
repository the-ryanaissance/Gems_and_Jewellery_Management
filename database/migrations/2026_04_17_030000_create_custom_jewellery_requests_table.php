<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_jewellery_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('request_number', 40)->unique();
            $table->unsignedInteger('jewellery_type_id')->index();
            $table->unsignedInteger('gem_product_id')->index();
            $table->string('metal', 50);
            $table->string('measurement_label', 120)->nullable();
            $table->string('size_value', 120)->nullable();
            $table->string('engraving', 255)->nullable();
            $table->text('notes');
            $table->json('type_details')->nullable();
            $table->json('reference_images')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Quoted', 'Rejected', 'Paid'])->default('Pending');
            $table->decimal('quotation_amount', 12, 2)->nullable();
            $table->text('quotation_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_jewellery_requests');
    }
};
