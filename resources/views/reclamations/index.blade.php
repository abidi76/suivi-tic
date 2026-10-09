@extends('layouts.app')

@section('content')
<div class="w-full py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4 print:hidden">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Gestion des Réclamations IT</h1>
            <p class="text-sm text-gray-500 mt-1">Centre Régional d'Éducation (CRE) Manouba — SD TIC</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-800 hover:bg-gray-900 text-white font-medium text-sm rounded-xl shadow-sm transition-all">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Imprimer la liste
            </button>
            <a href="{{ route('reclamations.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-indigo-100 transition-all duration-200">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nouvelle Réclamation
            </a>
        </div>
    </div>

    <!-- SECTION 1 : Récapitulatif & Filtres -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8 print:hidden">
        <!-- Cartes Récapitulatives (Stats) -->
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</div>
                <div class="text-2xl font-bold text-gray-900 mt-2">{{ isset($reclamations) ? $reclamations->total() : 0 }}</div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div class="text-xs font-semibold text-blue-500 uppercase tracking-wider">Nouvelles</div>
                <div class="text-2xl font-bold text-blue-600 mt-2">
                    {{ \App\Models\Reclamation::where('statut', 'Nouvelle')->count() }}
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div class="text-xs font-semibold text-emerald-500 uppercase tracking-wider">Résolues</div>
                <div class="text-2xl font-bold text-emerald-600 mt-2">
                    {{ \App\Models\Reclamation::where('statut', 'Résolue')->count() }}
                </div>
            </div>
        </div>

        <!-- Bloc Filtres -->
        <div class="lg:col-span-5 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center">
            <form method="GET" action="{{ route('reclamations.index') }}" class="w-full flex items-center gap-3">
                <div class="flex-1">
                    <select name="statut" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                        <option value="">Tous les statuts</option>
                        <option value="Nouvelle" {{ request('statut') == 'Nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                        <option value="En cours" {{ request('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                        <option value="Résolue" {{ request('statut') == 'Résolue' ? 'selected' : '' }}>Résolue</option>
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center justify-center">
                    Filtrer
                </button>
                <a href="{{ route('reclamations.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium text-sm px-3 py-2.5 rounded-xl transition-all flex items-center justify-center" title="Réinitialiser">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </a>
            </form>
        </div>
    </div>

    <!-- SECTION 2 : Tableau des lignes avec détails et boutons -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/70 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">N° Réclamation</th>
                        <th class="px-6 py-4">Établissement</th>
                        <th class="px-6 py-4">Matériel / Objet & Détails</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Statut</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-sm">
                    @isset($reclamations)
                        @forelse($reclamations as $reclamation)
                            @php
                                $badgeColor = match($reclamation->statut ?? 'Nouvelle') {
                                    'Résolue' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'En cours' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    default => 'bg-blue-50 text-blue-700 border-blue-200',
                                };
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-indigo-600">{{ $reclamation->numero_reclamation ?? 'REC-'.$reclamation->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">{{ $reclamation->etablissement }}</td>
                                <td class="px-6 py-4 text-gray-600 max-w-sm">
                                    <div class="font-semibold text-gray-900">{{ $reclamation->objet }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5 truncate">{{ $reclamation->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-mono text-xs">{{ $reclamation->created_at ? $reclamation->created_at->format('Y-m-d') : '' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full border {{ $badgeColor }}">
                                        {{ $reclamation->statut ?? 'Nouvelle' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-1">
                                    <!-- Bouton Modifier / Traiter (Technicien / SD TIC) -->
                                    <a href="{{ route('reclamations.edit', $reclamation->id) }}" class="inline-flex items-center justify-center p-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg transition-colors border border-indigo-100" title="Traiter / Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    <!-- Bouton Supprimer -->
                                    <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors border border-red-100" title="Supprimer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                    Aucune réclamation trouvée.
                                </td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($reclamations) && method_exists($reclamations, 'links'))
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $reclamations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection