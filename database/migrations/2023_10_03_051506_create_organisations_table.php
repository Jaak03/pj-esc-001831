<?php

use App\Enums\ORGANISATION_TYPES;
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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_name');
            $table->string('trade_name');
            $table->enum('organisation_type', ORGANISATION_TYPES::getOptions());
            $table->string('registration_number');
            $table->string('tax_number');
            $table->timestamps();
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table
                ->foreignId('organisation_id')
                ->nullable()
                ->constrained('organisations')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropForeign(['organisation_id']);
            $table->dropColumn('organisation_id');
        });
        Schema::dropIfExists('organisations');
    }
};
