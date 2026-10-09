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
    Schema::create('ordre_missions', function (Blueprint $table) {
        $table->id();
        $table->string('numero_om'); // Ex: OM-2026-001
        $table->string('agent_nom'); // Nom du technicien / agent
        $table->string('etablissement'); // Établissement de destination
        $table->text('objet'); // Objet de la mission
        $table->date('date_mission'); // Date de la mission
        $table->string('statut')->default('En cours'); // En cours, Validé, Clôturé
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordre_missions');
    }
};
