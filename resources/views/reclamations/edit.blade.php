@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Modifier la Réclamation</h1>
        <p class="text-sm text-gray-500 mt-1">Centre Régional d'Éducation (CRE) Manouba — SD TIC</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <form action="{{ route('reclamations.update', $reclamation->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Établissement Cible Groupé par Délégation -->
            <div>
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Établissement Demandeur</label>
                <select name="etablissement" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                    <option value="">-- Sélectionner un établissement --</option>
                    
                    <optgroup label="Délégation de Manouba">
                        <option value="Lycée Ibn Khaldoun Manouba" {{ $reclamation->etablissement == 'Lycée Ibn Khaldoun Manouba' ? 'selected' : '' }}>Lycée Ibn Khaldoun Manouba</option>
                        <option value="Collège Exemple Manouba" {{ $reclamation->etablissement == 'Collège Exemple Manouba' ? 'selected' : '' }}>Collège Exemple Manouba</option>
                        <option value="Collège ibn abi dhiaf la manouba" {{ $reclamation->etablissement == 'Collège ibn abi dhiaf la manouba' ? 'selected' : '' }}>Collège Ibn Abi Dhiaf</option>
                    </optgroup>

                    <optgroup label="Délégation de Oued Ellil">
                        <option value="École Préparatoire Oued Ellil" {{ $reclamation->etablissement == 'École Préparatoire Oued Ellil' ? 'selected' : '' }}>École Préparatoire Oued Ellil</option>
                    </optgroup>

                    <optgroup label="Délégation de Tebourba">
                        <option value="Lycée Tébourba" {{ $reclamation->etablissement == 'Lycée Tébourba' ? 'selected' : '' }}>Lycée Tébourba</option>
                        <option value="Lycée Chouigui" {{ $reclamation->etablissement == 'Lycée Chouigui' ? 'selected' : '' }}>Lycée Chouigui</option>
                    </optgroup>

                    <optgroup label="Délégation de Menzel Habib">
                        <option value="Lycée Menzel Habib" {{ $reclamation->etablissement == 'Lycée Menzel Habib' ? 'selected' : '' }}>Lycée Menzel Habib</option>
                    </optgroup>

                    <optgroup label="Délégation de Borj El Amri">
                        <option value="Collège Borj El Amri" {{ $reclamation->etablissement == 'Collège Borj El Amri' ? 'selected' : '' }}>Collège Borj El Amri</option>
                    </optgroup>

                    <optgroup label="Délégation de Denden">
                        <option value="Lycée Denden" {{ $reclamation->etablissement == 'Lycée Denden' ? 'selected' : '' }}>Lycée Denden</option>
                    </optgroup>

                    <optgroup label="Administration Régionale">
                        <option value="Direction Régionale de l'Éducation Manouba" {{ $reclamation->etablissement == 'Direction Régionale de l\'Éducation Manouba' ? 'selected' : '' }}>Direction Régionale de l'Éducation Manouba</option>
                    </optgroup>
                </select>
            </div>

            <!-- Objet / Problème -->
            <div>
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Objet de la Réclamation</label>
                <input type="text" name="objet" value="{{ old('objet', $reclamation->objet) }}" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
            </div>

            <!-- Description détaillée -->
            <div>
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Description Détaillée</label>
                <textarea name="description" rows="4" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>{{ old('description', $reclamation->description) }}</textarea>
            </div>

            <!-- Statut -->
            <div>
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Statut</label>
                <select name="statut" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    <option value="Nouvelle" {{ ($reclamation->statut ?? '') == 'Nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                    <option value="En cours" {{ ($reclamation->statut ?? '') == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Résolue" {{ ($reclamation->statut ?? '') == 'Résolue' ? 'selected' : '' }}>Résolue</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('reclamations.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition-all">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-indigo-100 transition-all">
                    Mettre à jour la Réclamation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection