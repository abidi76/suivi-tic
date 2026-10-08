<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Réclamations et Pannes TIC') }}
            </h2>
            <a href="{{ route('reclamations.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                + Signaler une panne
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre / Équipement</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Demandeur</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priorité</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($reclamations as $reclamation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $reclamation->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $reclamation->titre }}</div>
                                            <div class="text-sm text-gray-500">{{ $reclamation->equipement ?? 'Non spécifié' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $reclamation->auteur->name ?? 'Inconnu' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($reclamation->priorite == 'critique') bg-red-100 text-red-800
                                                @elseif($reclamation->priorite == 'haute') bg-orange-100 text-orange-800
                                                @elseif($reclamation->priorite == 'moyenne') bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ ucfirst($reclamation->priorite) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($reclamation->statut == 'resolue') bg-green-100 text-green-800
                                                @elseif($reclamation->statut == 'en_cours') bg-blue-100 text-blue-800
                                                @elseif($reclamation->statut == 'rejetee') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst(str_replace('_', ' ', $reclamation->statut)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <!-- Gestion interactive Alpine.js pour l'édition rapide du statut (réservé technique/admin) -->
                                            <div x-data="{ openModal: false }">
                                                <button @click="openModal = true" class="text-indigo-600 hover:text-indigo-900">Gérer</button>

                                                <!-- Modal de mise à jour -->
                                                <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                                                    <div class="bg-white p-6 rounded-lg w-full max-w-md">
                                                        <h3 class="text-lg font-medium text-gray-900 mb-4">Mettre à jour la réclamation #{{ $reclamation->id }}</h3>
                                                        
                                                        <form action="{{ route('reclamations.update', $reclamation) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-4">
                                                                <label class="block text-sm font-medium text-gray-700">Statut</label>
                                                                <select name="statut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                                    <option value="en_attente" @selected($reclamation->statut == 'en_attente')>En attente</option>
                                                                    <option value="en_cours" @selected($reclamation->statut == 'en_cours')>En cours</option>
                                                                    <option value="resolue" @selected($reclamation->statut == 'resolue')>Résolue</option>
                                                                    <option value="rejetee" @selected($reclamation->statut == 'rejetee')>Rejetée</option>
                                                                </select>
                                                            </div>

                                                            @if(in_array(Auth::user()->role, ['technicien', 'prestataire', 'admin', 'directeur_tic']) && !$reclamation->technicien_id)
                                                                <div class="mb-4 flex items-center">
                                                                    <input type="checkbox" name="assign_me" id="assign_me_{{ $reclamation->id }}" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                                    <label for="assign_me_{{ $reclamation->id }}" class="ml-2 text-sm text-gray-600">M'assigner cette tâche</label>
                                                                </div>
                                                            @endif

                                                            <div class="mb-4">
                                                                <label class="block text-sm font-medium text-gray-700">Commentaire technique</label>
                                                                <textarea name="commentaire_technicien" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $reclamation->commentaire_technicien }}</textarea>
                                                            </div>

                                                            <div class="flex justify-end space-x-3">
                                                                <button type="button" @click="openModal = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm">Annuler</button>
                                                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">Enregistrer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Aucune réclamation trouvée.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $reclamations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>