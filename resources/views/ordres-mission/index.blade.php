@extends('layouts.app')

@section('content')
<div class="w-full py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4 print:hidden">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Ordres de Mission</h1>
            <p class="text-sm text-gray-500 mt-1">Centre Régional d'Éducation (CRE) Manouba — SD TIC</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-800 hover:bg-gray-900 text-white font-medium text-sm rounded-xl shadow-sm transition-all">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Imprimer la liste
            </button>
            <a href="{{ route('ordres-mission.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-lg shadow-indigo-100 transition-all duration-200">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nouvel Ordre de Mission
            </a>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8 print:hidden">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="text-sm font-medium text-gray-500">Total Missions</div>
            <div class="text-2xl font-bold text-gray-900 mt-2">{{ $ordres->count() }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="text-sm font-medium text-gray-500">En cours</div>
            <div class="text-2xl font-bold text-amber-600 mt-2">{{ $ordres->where('statut', 'En cours')->count() }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="text-sm font-medium text-gray-500">Validés</div>
            <div class="text-2xl font-bold text-blue-600 mt-2">{{ $ordres->where('statut', 'Validé')->count() }}</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="text-sm font-medium text-gray-500">Terminés</div>
            <div class="text-2xl font-bold text-emerald-600 mt-2">{{ $ordres->where('statut', 'Terminé')->count() }}</div>
        </div>
    </div>

    <!-- Filtres de Recherche -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8 print:hidden">
        <form method="GET" action="{{ route('ordres-mission.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="md:col-span-5">
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Recherche</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="N°, technicien ou établissement..." class="pl-10 w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                </div>
            </div>
            
            <div class="md:col-span-4">
                <label class="block font-semibold text-xs text-gray-600 uppercase tracking-wider mb-2">Statut</label>
                <select name="statut" class="w-full border-gray-200 bg-gray-50/50 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    <option value="">Tous les statuts</option>
                    <option value="Créé" {{ request('statut') == 'Créé' ? 'selected' : '' }}>Créé</option>
                    <option value="En cours" {{ request('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Validé" {{ request('statut') == 'Validé' ? 'selected' : '' }}>Validé</option>
                    <option value="Terminé" {{ request('statut') == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <div class="md:col-span-3 flex space-x-2">
                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm py-2.5 px-4 rounded-xl transition-all shadow-sm flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filtrer
                </button>
                <a href="{{ route('ordres-mission.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium text-sm py-2.5 px-3 rounded-xl transition-all flex items-center justify-center" title="Réinitialiser">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </a>
            </div>
        </form>
    </div>

    <!-- Tableau moderne -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/70 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">N° OM</th>
                        <th class="px-6 py-4">Technicien</th>
                        <th class="px-6 py-4">Établissement</th>
                        <th class="px-6 py-4">Objet</th>
                        <th class="px-6 py-4">Date Mission</th>
                        <th class="px-6 py-4">Statut</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-sm">
                    @php
                        $ordresCollection =$ordres ?? collect();
                    @endphp

                    @if($ordresCollection->count() > 0)
                        @php
                            foreach($ordresCollection as$ordre) {
                                $badgeColor = match($ordre->statut) {
                                    'Validé' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'Terminé' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'En cours' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    default => 'bg-gray-50 text-gray-700 border-gray-200',
                                };
                                echo '<tr class="hover:bg-gray-50/50 transition-colors">';
                                echo '<td class="px-6 py-4 whitespace-nowrap font-semibold text-indigo-600">' . htmlspecialchars($ordre->numero_om) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">' . htmlspecialchars($ordre->agent_nom) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-gray-600">' . htmlspecialchars($ordre->etablissement) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-gray-600 max-w-xs truncate">' . htmlspecialchars($ordre->objet) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap text-gray-500 font-mono text-xs">' . htmlspecialchars($ordre->date_mission) . '</td>';
                                echo '<td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full border ' . $badgeColor . '">' . htmlspecialchars($ordre->statut) . '</span></td>';
                                
                                echo '<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-1">';
                                echo '<button onclick="printOmDetails(\'' . addslashes($ordre->numero_om) . '\', \'' . addslashes($ordre->agent_nom) . '\', \'' . addslashes($ordre->etablissement) . '\', \'' . addslashes($ordre->objet) . '\', \'' . addslashes($ordre->date_mission) . '\', \'' . addslashes($ordre->statut) . '\', \'' . addslashes($ordre->type_technicien) . '\', \'' . addslashes($ordre->societe_prestataire ?? 'N/A') . '\', \'' . addslashes($ordre->vehicule_matricule ?? 'Non attribué') . '\', \'' . addslashes($ordre->chauffeur_nom ?? 'Non assigné') . '\')" class="inline-flex items-center justify-center p-2 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-lg transition-colors border border-gray-200" title="Imprimer"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg></button>';
                                echo '<a href="' . route('ordres-mission.edit', $ordre->id) . '" class="inline-flex items-center justify-center p-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg transition-colors border border-indigo-100" title="Modifier"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>';
                                echo '<form action="' . route('ordres-mission.destroy', $ordre->id) . '" method="POST" class="inline-block" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet ordre de mission ?\');">';
                                echo csrf_field();
                                echo method_field('DELETE');
                                echo '<button type="submit" class="inline-flex items-center justify-center p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors border border-red-100" title="Supprimer"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        @endphp
                    @else
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Aucun ordre de mission trouvé.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script d'impression individuelle -->
<script>
function printOmDetails(numero, agent, etablissement, objet, date, statut, type, prestataire, vehicule, chauffeur) {
    let printWindow = window.open('', '_blank', 'width=850,height=700');
    
    let htmlContent = `
        <html>
        <head>
            <title>Ordre de Mission - ${numero}</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 40px; color: #000; line-height: 1.5; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h2, .header h3, .header h4 { margin: 4px 0; font-size: 14px; }
                .header h2 { font-size: 16px; }
                hr { border: 1px solid #000; margin: 20px 0; }
                .title { text-align: center; font-size: 22px; font-weight: bold; text-transform: uppercase; margin: 30px 0; letter-spacing: 1px; }
                .grid { display: flex; justify-content: space-between; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; font-size: 15px; }
                .grid div { width: 48%; }
                .box { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-top: 20px; border-radius: 6px; font-size: 14px; }
                .signatures { display: flex; justify-content: space-between; margin-top: 100px; font-size: 14px; }
                .signatures div { text-align: center; width: 40%; }
                .space { height: 70px; }
            </style>
        </head>
        <body onload="window.print(); window.close();">
            <div class="header">
                <h2>République Tunisienne - Ministère de l'Éducation</h2>
                <h3>Centre Régional d'Éducation (CRE) Manouba</h3>
                <h4>Sous-Direction des Technologies de l'Information et de la Communication (SD TIC)</h4>
            </div>
            <hr>
            <div class="title">Ordre de Mission N° : ${numero}</div>

            <div class="grid">
                <div><strong>Statut du Technicien :</strong> ${type}</div>
                <div><strong>Nom du Technicien :</strong> ${agent}</div>
            </div>
            <div class="grid">
                <div><strong>Établissement Cible :</strong> ${etablissement}</div>
                <div><strong>Société Prestataire :</strong> ${prestataire}</div>
            </div>
            <div style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; font-size: 15px;">
                <strong>Objet / Précisions de la Mission :</strong>
                <p style="background: #f9f9f9; padding: 10px; margin-top: 5px; border-radius: 4px;">${objet}</p>
            </div>
            <div class="grid">
                <div><strong>Date de Mission :</strong> ${date}</div>
                <div><strong>Statut Global :</strong> ${statut}</div>
            </div>
            <div class="box">
                <div style="margin-bottom: 8px;"><strong>Véhicule Attribué (SD Bâtiment) :</strong> ${vehicule}</div>
                <div><strong>Chauffeur Assigné (SD Bâtiment) :</strong> ${chauffeur}</div>
            </div>

            <div class="signatures">
                <div>
                    <strong>Le Sous-Directeur TIC</strong>
                    <div class="space"></div>
                    <p>Signature & Cachet</p>
                </div>
                <div>
                    <strong>Visa de l'Établissement d'Arrivée</strong>
                    <div class="space"></div>
                    <p>Cachet de l'établissement</p>
                </div>
            </div>
        </body>
        </html>
    `;

    printWindow.document.write(htmlContent);
    printWindow.document.close();
}
</script>
@endsection