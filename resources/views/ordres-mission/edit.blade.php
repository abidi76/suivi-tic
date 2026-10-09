@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Modifier l'Ordre de Mission : {{ $ordre->numero_om }}</h1>
        <p class="text-sm text-gray-500 mt-1">Centre Régional d'Éducation (CRE) Manouba — SD TIC</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <form action="{{ route('ordres-mission.update', $ordre->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statut du Technicien -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Statut du Technicien</label>
                    <select name="type_technicien" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        <option value="Interne" {{ $ordre->type_technicien == 'Interne' ? 'selected' : '' }}>Interne (SD TIC)</option>
                        <option value="Prestataire" {{ $ordre->type_technicien == 'Prestataire' ? 'selected' : '' }}>Prestataire (Sous-traitant)</option>
                    </select>
                </div>

                <!-- Nom du Technicien -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Nom du Technicien</label>
                    <input type="text" name="agent_nom" value="{{ old('agent_nom', $ordre->agent_nom) }}" placeholder="Nom complet..." class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Établissement Cible Groupé par Délégation -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Établissement Cible</label>
                    <select name="etablissement" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                        <option value="">-- Sélectionner un établissement --</option>
                        
                        <optgroup label="Délégation de Manouba">
                            <option value="Lycée Ibn Khaldoun Manouba" {{ $ordre->etablissement == 'Lycée Ibn Khaldoun Manouba' ? 'selected' : '' }}>Lycée Ibn Khaldoun Manouba</option>
                            <option value="Collège Exemple Manouba" {{ $ordre->etablissement == 'Collège Exemple Manouba' ? 'selected' : '' }}>Collège Exemple Manouba</option>
                            <option value="Collège ibn abi dhiaf la manouba" {{ $ordre->etablissement == 'Collège ibn abi dhiaf la manouba' ? 'selected' : '' }}>Collège Ibn Abi Dhiaf</option>
                        </optgroup>

                        <optgroup label="Délégation de Oued Ellil">
                            <option value="École Préparatoire Oued Ellil" {{ $ordre->etablissement == 'École Préparatoire Oued Ellil' ? 'selected' : '' }}>École Préparatoire Oued Ellil</option>
                        </optgroup>

                        <optgroup label="Délégation de Tebourba">
                            <option value="Lycée Tébourba" {{ $ordre->etablissement == 'Lycée Tébourba' ? 'selected' : '' }}>Lycée Tébourba</option>
                            <option value="Lycée Chouigui" {{ $ordre->etablissement == 'Lycée Chouigui' ? 'selected' : '' }}>Lycée Chouigui</option>
                        </optgroup>

                        <optgroup label="Délégation de Menzel Habib">
                            <option value="Lycée Menzel Habib" {{ $ordre->etablissement == 'Lycée Menzel Habib' ? 'selected' : '' }}>Lycée Menzel Habib</option>
                        </optgroup>

                        <optgroup label="Délégation de Borj El Amri">
                            <option value="Collège Borj El Amri" {{ $ordre->etablissement == 'Collège Borj El Amri' ? 'selected' : '' }}>Collège Borj El Amri</option>
                        </optgroup>

                        <optgroup label="Délégation de Denden">
                            <option value="Lycée Denden" {{ $ordre->etablissement == 'Lycée Denden' ? 'selected' : '' }}>Lycée Denden</option>
                        </optgroup>

                        <optgroup label="Administration Régionale">
                            <option value="Direction Régionale de l'Éducation Manouba" {{ $ordre->etablissement == 'Direction Régionale de l\'Éducation Manouba' ? 'selected' : '' }}>Direction Régionale de l'Éducation Manouba</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Date de Mission -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Date de Mission</label>
                    <input type="date" name="date_mission" value="{{ old('date_mission', $ordre->date_mission) }}" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                </div>
            </div>

            <!-- Objet de la mission -->
            <div>
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Objet / Précisions de la Mission</label>
                <textarea name="objet" rows="3" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>{{ old('objet', $ordre->objet) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statut Global -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Statut Global</label>
                    <select name="statut" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        <option value="Créé" {{ $ordre->statut == 'Créé' ? 'selected' : '' }}>Créé</option>
                        <option value="En cours" {{ $ordre->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                        <option value="Validé" {{ $ordre->statut == 'Validé' ? 'selected' : '' }}>Validé</option>
                        <option value="Terminé" {{ $ordre->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>

                <!-- Société Prestataire (Optionnel) -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Société Prestataire (si applicable)</label>
                    <input type="text" name="societe_prestataire" value="{{ old('societe_prestataire', $ordre->societe_prestataire) }}" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('ordres-mission.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition-all">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-indigo-100 transition-all">
                    Mettre à jour l'Ordre de Mission
                </button>
            </div>
        </form>
    </div>
</div>
@endsection