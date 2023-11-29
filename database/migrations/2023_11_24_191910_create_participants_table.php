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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('invoice', 50);
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('sid_number', 50);
            $table->json('institutional_origin')->nullable();
            $table->string('whatsapp', 30);
            $table->json('payment')->nullable();
            $table->string('pay_sender', 50);
            $table->text('pay_proof');
            $table->string('recom_by')->nullable();
            $table->integer('price');
            $table->boolean('is_paid')->default('0');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('reason')->nullable();
            $table->text('certificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
