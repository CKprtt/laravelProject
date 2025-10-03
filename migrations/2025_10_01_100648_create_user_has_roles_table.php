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
        Schema::create('user_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('roles_id');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['users_id', 'roles_id']);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('roles_id')->references('roles_id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_roles');
    }
};
