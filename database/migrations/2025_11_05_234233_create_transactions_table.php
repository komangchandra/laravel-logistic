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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('transaction_type');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->integer('flowmeter_start');
            $table->integer('flowmeter_end');
            $table->integer('volume');
            $table->float('hour_meter', 8, 2);
            $table->date('transaction_date');
            $table->time('transaction_time');
            $table->string('driver_name');
            $table->string('fuelman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
