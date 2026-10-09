<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reclamation;

class ReclamationController extends Controller
{
    /**
     * Afficher la liste des réclamations selon le rôle de l'utilisateur connecté.
     */
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur n'est pas connecté, redirection vers le login
        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Admin / SD TIC : Voient toutes les réclamations
        if (in_array($user->role, ['admin', 'sous-directeur', 'sd-tic', 'directeur'])) {
            $reclamations = Reclamation::latest()->paginate(10);
        } 
        // 2. Technicien : Voit toutes les réclamations pour intervention et suivi
        elseif ($user->role === 'technicien') {
            $reclamations = Reclamation::latest()->paginate(10);
        } 
        // 3. Autres cas par défaut
        else {
            $reclamations = Reclamation::where('user_id', $user->id)
                ->latest()
                ->paginate(10);
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
            'etablissement' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'nullable|string|max:50',
        ]);

        Reclamation::create([
            'user_id' => Auth::id() ?? null,
            'etablissement' => $request->etablissement,
            'objet' => $request->objet,
            'description' => $request->description,
            'statut' => $request->statut ?? 'Nouvelle',
        ]);

        return redirect()->route('reclamations.index')->with('success', 'Réclamation enregistrée avec succès.');
    }

    public function edit($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        return view('reclamations.edit', compact('reclamation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'etablissement' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|string|max:50',
        ]);

        $reclamation = Reclamation::findOrFail($id);
        $reclamation->update([
            'etablissement' => $request->etablissement,
            'objet' => $request->objet,
            'description' => $request->description,
            'statut' => $request->statut,
        ]);

        return redirect()->route('reclamations.index')->with('success', 'Réclamation mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        $reclamation->delete();

        return redirect()->route('reclamations.index')->with('success', 'Réclamation supprimée avec succès.');
    }
}