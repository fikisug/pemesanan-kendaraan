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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->text('purpose');
            $table->enum('status', ['pending', 'approved_lvl1', 'approved_lvl2', 'rejected'])->default('pending');
            $table->unsignedBigInteger('approver_1_id')->nullable();
            $table->unsignedBigInteger('approver_2_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
