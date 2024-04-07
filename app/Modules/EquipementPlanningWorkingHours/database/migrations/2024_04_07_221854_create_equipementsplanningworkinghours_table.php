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
        Schema::create('equipementsplanningworkinghours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipement_planning_id')->constrained('equipements_plannings')->onDelete('cascade');
            $table->float('start_time');
            $table->float('end_time');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipementsplanningworkinghours');
    }
};
