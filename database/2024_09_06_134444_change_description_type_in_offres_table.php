<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('offres')->get()->each(function($offre) {
            // Assuming that the 'description' column holds plain text or simple key-value pairs
            DB::table('offres')->where('id', $offre->id)
                ->update(['description' => json_encode(['text' => $offre->description])]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offres', function (Blueprint $table) {
        //    $table->text('description')->change();
        });
    }
};
