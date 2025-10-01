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
        Schema::create('event_requests', function (Blueprint $table) {
            $table->id('event_requests_id');
            $table->string('event_name');
            $table->text('proposal')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('event_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('poster_path')->nullable();
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('events_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('artist_id')->references('artist_id')->on('artist_profiles')->onDelete('cascade');
            $table->foreign('events_id')->references('events_id')->on('events')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_requests');
    }
};
