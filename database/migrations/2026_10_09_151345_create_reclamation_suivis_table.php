<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reclamation_suivis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reclamation_id');
            $table->unsignedBigInteger('technicien_id')->nullable();
            $table->string('equipement_concerne')->nullable();
            $table->text('actions_realisees')->nullable();
            $table->text('pieces_rechange')->nullable();
            $table->string('statut_intervention')->default('En cours');
            $table->timestamps();

            // Définition propre des clés étrangères
            $table->foreign('reclamation_id')->references('id')->on('reclamations')->onDelete('cascade');
            $table->foreign('technicien_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reclamation_suivis');
    }
};