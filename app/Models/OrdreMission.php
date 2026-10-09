<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdreMission extends Model
{
    use HasFactory;

    // Préciser explicitement le nom exact de la table en base de données
    protected $table = 'ordre_missions';

    protected $fillable = [
    'numero_om',
    'agent_nom',
    'etablissement',
    'objet',
    'date_mission',
    'statut',
    'origine_type',
    'reclamation_id',
    'type_om',
    'demande_voiture_ref',
    'valide_chef_service',
    'valide_sd_batiments',
    'valide_secretaire_general',
    'vehicule_marque',
    'vehicule_matricule',
    'chauffeur_nom',
    'chauffeur_immat',
    'statut_transport',
];

}