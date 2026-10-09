<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    // Champs autorisés pour l'insertion en masse
    protected $fillable = [
        'user_id',
        'etablissement',
        'objet',
        'description',
        'statut',
    ];

    /**
     * Relation avec les suivis et comptes-rendus techniques
     */
    public function suivis()
    {
        return $this->hasMany(ReclamationSuivi::class, 'reclamation_id');
    }
}