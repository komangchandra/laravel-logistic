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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('unit_name');
            $table->foreignId('station_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('flowmeter_start')->nullable();
            $table->integer('flowmeter_end')->nullable();
            $table->integer('volume');
            $table->float('hour_meter', 8, 2)->nullable();
            $table->date('transaction_date')->nullable();
            $table->time('transaction_time')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('fuelman')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
