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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // tidak pakai foreign key
            $table->string('user_name')->nullable(); // tambahan jika user dihapus
            $table->string('action'); // contoh: create, update, delete, approve, reject
            $table->string('target_type')->nullable(); // Model: App\Models\Reservation
            $table->unsignedBigInteger('target_id')->nullable(); // ID dari model
            $table->text('description')->nullable(); // deskripsi bebas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
