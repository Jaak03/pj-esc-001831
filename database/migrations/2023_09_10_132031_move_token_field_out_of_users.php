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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('token');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->string('token');
        });

        Schema::table('buyers', function (Blueprint $table) {
            $table->string('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('token');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('token');
        });

        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
};
