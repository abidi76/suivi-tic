@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Créer un Ordre de Mission</h1>
        <p class="text-sm text-gray-500 mt-1">Centre Régional d'Éducation (CRE) Manouba — SD TIC</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <form action="{{ route('ordres-mission.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statut du Technicien -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Statut du Technicien</label>
                    <select name="type_technicien" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        <option value="Interne">Interne (SD TIC)</option>
                        <option value="Prestataire">Prestataire (Sous-traitant)</option>
                    </select>
                </div>

                <!-- Nom du Technicien -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Nom du Technicien</label>
                    <input type="text" name="agent_nom" value="{{ old('agent_nom') }}" placeholder="Nom complet..." class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Établissement Cible Groupé par Délégation -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Établissement Cible</label>
                    <select name="etablissement" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                        <option value="">-- Sélectionner un établissement --</option>
                        
                        <optgroup label="Délégation de Manouba">
                            <option value="Lycée Ibn Khaldoun Manouba">Lycée Ibn Khaldoun Manouba</option>
                            <option value="Collège Exemple Manouba">Collège Exemple Manouba</option>
                            <option value="Collège ibn abi dhiaf la manouba">Collège Ibn Abi Dhiaf</option>
                        </optgroup>

                        <optgroup label="Délégation de Oued Ellil">
                            <option value="École Préparatoire Oued Ellil">École Préparatoire Oued Ellil</option>
                        </optgroup>

                        <optgroup label="Délégation de Tebourba">
                            <option value="Lycée Tébourba">Lycée Tébourba</option>
                            <option value="Lycée Chouigui">Lycée Chouigui</option>
                        </optgroup>

                        <optgroup label="Délégation de Menzel Habib">
                            <option value="Lycée Menzel Habib">Lycée Menzel Habib</option>
                        </optgroup>

                        <optgroup label="Délégation de Borj El Amri">
                            <option value="Collège Borj El Amri">Collège Borj El Amri</option>
                        </optgroup>

                        <optgroup label="Délégation de Denden">
                            <option value="Lycée Denden">Lycée Denden</option>
                        </optgroup>

                        <optgroup label="Administration Régionale">
                            <option value="Direction Régionale de l'Éducation Manouba">Direction Régionale de l'Éducation Manouba</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Date de Mission -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Date de Mission</label>
                    <input type="date" name="date_mission" value="{{ old('date_mission') }}" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>
                </div>
            </div>

            <!-- Objet de la mission -->
            <div>
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Objet / Précisions de la Mission</label>
                <textarea name="objet" rows="3" placeholder="Décrivez l'objet de l'intervention..." class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all" required>{{ old('objet') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statut Global -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Statut Global</label>
                    <select name="statut" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        <option value="Créé">Créé</option>
                        <option value="En cours">En cours</option>
                        <option value="Validé">Validé</option>
                        <option value="Terminé">Terminé</option>
                    </select>
                </div>

                <!-- Société Prestataire (Optionnel) -->
                <div>
                    <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Société Prestataire (si applicable)</label>
                    <input type="text" name="societe_prestataire" value="{{ old('societe_prestataire') }}" placeholder="Nom de la société..." class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('ordres-mission.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-xl transition-all">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-indigo-100 transition-all">
                    Enregistrer l'Ordre de Mission
                </button>
            </div>
        </form>
    </div>
</div>
@endsection