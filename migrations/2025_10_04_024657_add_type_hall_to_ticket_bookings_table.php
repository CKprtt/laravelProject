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
        Schema::table('ticket_bookings', function (Blueprint $table) {
            $table->enum('type_hall', ['Yes','No'])->default('No')->after('qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_bookings', function (Blueprint $table) {
            $table->dropColumn('type_hall');
        });
    }
};
