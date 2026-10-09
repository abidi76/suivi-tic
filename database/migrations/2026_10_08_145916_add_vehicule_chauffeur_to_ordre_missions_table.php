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
    Schema::table('ordre_missions', function (Blueprint $table) {
        $table->string('vehicule_marque')->nullable(); // Marque de la voiture
        $table->string('vehicule_matricule')->nullable(); // Immatriculation du véhicule
        $table->string('chauffeur_nom')->nullable(); // Nom du chauffeur
        $table->string('chauffeur_immat')->nullable(); // Numéro/Permis du chauffeur
        $table->string('statut_transport')->default('En attente'); // Confirmé, Ajourné, En attente
    });
}

public function down(): void
{
    Schema::table('ordre_missions', function (Blueprint $table) {
        $table->dropColumn([
            'vehicule_marque',
            'vehicule_matricule',
            'chauffeur_nom',
            'chauffeur_immat',
            'statut_transport'
        ]);
    });
}
};
