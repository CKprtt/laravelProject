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
        Schema::create('ticket_bookings', function (Blueprint $table) {
            $table->id('bookings_id');
            $table->string('tracking_numbers');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('zones_id');
            $table->unsignedBigInteger('events_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('zones_id')->references('zones_id')->on('hall_zones')->onDelete('cascade');
            $table->foreign('events_id')->references('events_id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_bookings');
    }
};
