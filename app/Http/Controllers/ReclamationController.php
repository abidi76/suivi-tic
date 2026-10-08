<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReclamationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'directeur_tic', 'dg_tic', 'cnte', 'ministere', 'secretaire_generale'])) {
            $reclamations = Reclamation::with(['auteur', 'technicien'])->latest()->paginate(10);
        } elseif (in_array($user->role, ['technicien', 'prestataire'])) {
            $reclamations = Reclamation::with(['auteur', 'technicien'])
                ->where('technicien_id', $user->id)
                ->orWhereNull('technicien_id')
                ->latest()
                ->paginate(10);
        } else {
            $reclamations = Reclamation::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('reclamations.index', compact('reclamations'));
    }

    public function create()
    {
        return view('reclamations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'equipement' => 'nullable|string|max:255',
            'priorite' => 'required|in:faible,moyenne,haute,critique',
        ]);

        Reclamation::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'etablissement_nom' => Auth::user()->name,
            'equipement' => $request->equipement,
            'priorite' => $request->priorite,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('reclamations.index')->with('success', 'Réclamation enregistrée avec succès.');
    }

    public function update(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,resolue,rejetee',
            'commentaire_technicien' => 'nullable|string',
        ]);

        $reclamation->update([
            'statut' => $request->statut,
            'commentaire_technicien' => $request->commentaire_technicien,
            'technicien_id' => $request->has('assign_me') ? Auth::id() : $reclamation->technicien_id,
        ]);

        return back()->with('success', 'Réclamation mise à jour avec succès.');
    }
}