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
        Schema::create('offer_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained('offres','id');
            $table->foreignId('tool_id')->constrained('tools','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_tools');
    }
};
