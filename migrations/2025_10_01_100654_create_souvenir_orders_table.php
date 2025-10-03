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
        Schema::create('souvenir_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('souvenirs_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['users_id', 'souvenirs_id']);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('souvenirs_id')->references('souvenirs_id')->on('souvenirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souvenir_orders');
    }
};
