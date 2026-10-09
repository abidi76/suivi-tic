<?php

namespace App\Http\Controllers;

use App\Models\OrdreMission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdreMissionController extends Controller
{
    public function index(Request $request)
    {
        $query = OrdreMission::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero_om', 'like', "%{$search}%")
                  ->orWhere('agent_nom', 'like', "%{$search}%")
                  ->orWhere('etablissement', 'like', "%{$search}%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $ordres = $query->latest()->get();

        return view('ordres-mission.index', compact('ordres'));
    }

    public function create()
    {
        return view('ordres-mission.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_technicien' => 'nullable|string',
            'agent_nom' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'motif_mission' => 'nullable|string',
            'objet' => 'required|string|max:255',
            'statut_transport' => 'nullable|string',
            'statut' => 'required|string',
        ]);

        $currentYear = Carbon::now()->year;
        $lastOrder = OrdreMission::whereYear('created_at', $currentYear)->latest('id')->first();

        if ($lastOrder && preg_match('/OM-' . $currentYear . '-(\d+)/', $lastOrder->numero_om, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        $numeroOm = sprintf('OM-%d-%03d', $currentYear, $nextNumber);

        OrdreMission::create([
            'numero_om' => $numeroOm,
            'type_technicien' => $request->type_technicien,
            'agent_nom' => $request->agent_nom,
            'societe_prestataire' => $request->societe_prestataire,
            'offre_appel_offre' => $request->offre_appel_offre,
            'etablissement' => $request->etablissement,
            'motif_mission' => $request->motif_mission,
            'objet' => $request->objet,
            'statut_transport' => $request->statut_transport ?? 'En attente',
            'date_mission' => $request->date_mission,
            'vehicule_matricule' => $request->vehicule_matricule,
            'chauffeur_nom' => $request->chauffeur_nom,
            'statut' => $request->statut,
        ]);

        return redirect()->route('ordres-mission.index')->with('success', 'Ordre de mission créé avec succès.');
    }

    public function edit($id)
    {
        $ordre = OrdreMission::findOrFail($id);
        return view('ordres-mission.edit', compact('ordre'));
    }

    public function update(Request $request, $id)
    {
        $ordre = OrdreMission::findOrFail($id);

        $request->validate([
            'type_technicien' => 'nullable|string',
            'agent_nom' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'motif_mission' => 'nullable|string',
            'objet' => 'required|string|max:255',
            'statut_transport' => 'nullable|string',
            'statut' => 'required|string',
        ]);

        $dateMission = $ordre->date_mission;
        if ($ordre->statut_transport !== 'Confirmé') {
            $dateMission = $request->date_mission;
        }

        $ordre->update([
            'type_technicien' => $request->type_technicien,
            'agent_nom' => $request->agent_nom,
            'societe_prestataire' => $request->type_technicien === 'Prestataire' ? $request->societe_prestataire : null,
            'offre_appel_offre' => $request->type_technicien === 'Prestataire' ? $request->offre_appel_offre : null,
            'etablissement' => $request->etablissement,
            'motif_mission' => $request->motif_mission,
            'objet' => $request->objet,
            'statut_transport' => $request->statut_transport,
            'date_mission' => $dateMission,
            'statut' => $request->statut,
        ]);

        return redirect()->route('ordres-mission.index')->with('success', 'Ordre de mission mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $ordre = OrdreMission::findOrFail($id);
        $ordre->delete();

        return redirect()->route('ordres-mission.index')->with('success', 'Ordre de mission supprimé avec succès.');
    }
}