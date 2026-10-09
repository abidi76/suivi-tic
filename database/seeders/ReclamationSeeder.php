namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReclamationSeeder extends Seeder
{
    public function run(): void
    {
        $reclamations = [
            [
                'etablissement' => 'Lycée Ibn Khaldoun Manouba',
                'objet' => 'Panne connexion Internet (Switch principal)',
                'description' => 'Coupure totale du réseau câblé et Wi-Fi au bloc administratif.',
                'statut' => 'En cours',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Collège Exemple Manouba',
                'objet' => 'Problème vidéoprojecteur salle info',
                'description' => 'La lampe du vidéoprojecteur s’éteint après 5 minutes d’utilisation.',
                'statut' => 'Nouvelle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Collège ibn abi dhiaf la manouba',
                'objet' => 'Maintenance postes informatiques',
                'description' => 'Installation des mises à jour de sécurité et nettoyage des ventilateurs.',
                'statut' => 'Résolue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'École Préparatoire Oued Ellil',
                'objet' => 'Panne imprimante administrative',
                'description' => 'Bourrage papier persistant et erreur de communication USB.',
                'statut' => 'En cours',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Lycée Tébourba',
                'objet' => 'Câblage réseau endommagé',
                'description' => 'Prise RJ45 arrachée dans la salle des professeurs.',
                'statut' => 'Nouvelle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Lycée Chouigui',
                'objet' => 'Problème d’accès à l’Espace Numérique',
                'description' => 'Blocage des comptes utilisateurs suite à une erreur d’authentification.',
                'statut' => 'Résolue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Lycée Menzel Habib',
                'objet' => 'Remplacement disque dur serveur local',
                'description' => 'Alerte S.M.A.R.T sur le disque principal du serveur pédagogique.',
                'statut' => 'En cours',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Collège Borj El Amri',
                'objet' => 'Panne onduleur salle multimédia',
                'description' => 'L’onduleur ne tient plus la charge en cas de coupure de courant.',
                'statut' => 'Nouvelle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Lycée Denden',
                'objet' => 'Configuration point d’accès Wi-Fi',
                'description' => 'Ajout d’un nouveau répéteur Wi-Fi pour couvrir la bibliothèque.',
                'statut' => 'Résolue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'etablissement' => 'Direction Régionale de l’Éducation Manouba',
                'objet' => 'Problème de messagerie administrative',
                'description' => 'Difficulté d’envoi des pièces jointes lourdes depuis le poste de la direction.',
                'statut' => 'En cours',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('reclamations')->insert($reclamations);
    }
}