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
        Schema::create('souvenirs', function (Blueprint $table) {
            $table->id('souvenirs_id');
            $table->string('souvenirs_name');
            $table->integer('quantity_left');
            $table->text('description')->nullable();
            $table->enum('souvenirs_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('artist_id')->references('artist_id')->on('artist_profiles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souvenirs');
    }
};
