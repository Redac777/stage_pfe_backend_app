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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('equipement_id')->nullable();
            $table->foreign('equipement_id')->references('id')->on('equipements')->onDelete('cascade');
            $table->foreignId('planning_id')->constrained('plannings')->onDelete('cascade');
            $table->float('start_time');
            $table->float('ends_time');
            $table->boolean('role')->nullable();
            $table->boolean('break')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
