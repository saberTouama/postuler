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
        Schema::table('offres', function (Blueprint $table) {
            $table->text('tool1')->nullable()->default(null);
            $table->text('tool2')->nullable()->default(null);
            $table->text('tool3')->nullable()->default(null);
            $table->text('tool4')->nullable()->default(null);
            $table->text('works')->nullable()->default(null);
            $table->text('skills')->nullable()->default(null);
            $table->text('points')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            //
        });
    }
};
