<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordre de Mission - {{ $ordres_mission->numero_om }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-300">
        
        <!-- En-tête officiel -->
        <div class="flex justify-between items-center border-b pb-6 mb-6">
            <div class="text-center">
                <p class="text-xs font-bold uppercase">République Tunisienne</p>
                <p class="text-xs uppercase">Ministère de l'Éducation</p>
                <p class="text-xs font-semibold text-indigo-700">Centre Régional d'Éducation (CRE) Manouba</p>
            </div>
            <div>
                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded border border-gray-300">
                    {{ $ordres_mission->numero_om }}
                </span>
            </div>
        </div>

        <div class="text-center my-8">
            <h1 class="text-2xl font-bold uppercase tracking-wide text-gray-800 underline">Ordre de Mission (OM)</h1>
            <p class="text-sm text-gray-500 mt-1">Service des Technologies de l'Information et de la Communication (TIC)</p>
        </div>

        <!-- Corps du document -->
        <div class="space-y-6 text-gray-800 text-sm mt-6">
            <div class="grid grid-cols-2 gap-4 border-b pb-4">
                <div>
                    <span class="font-bold text-gray-500 block text-xs uppercase">Nom de l'Agent / Technicien :</span>
                    <p class="text-lg font-semibold text-indigo-900 mt-1">{{ $ordres_mission->agent_nom }}</p>
                </div>
                <div>
                    <span class="font-bold text-gray-500 block text-xs uppercase">Date de la Mission :</span>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ \Carbon\Carbon::parse($ordres_mission->date_mission)->format('d / m / Y') }}</p>
                </div>
            </div>

            <div class="border-b pb-4">
                <span class="font-bold text-gray-500 block text-xs uppercase">Établissement de Destination :</span>
                <p class="text-base font-medium text-gray-900 mt-1"><i class="bi bi-geo-alt-fill text-red-500 mr-1"></i> {{ $ordres_mission->etablissement }}</p>
            </div>

            <div class="border-b pb-4">
                <span class="font-bold text-gray-500 block text-xs uppercase">Objet de la Mission :</span>
                <p class="text-base text-gray-800 mt-2 p-4 bg-gray-50 rounded border border-gray-200 leading-relaxed">
                    {{ $ordres_mission->objet }}
                </p>
            </div>

            <div class="pt-6 grid grid-cols-2 gap-8 text-center mt-12">
                <div>
                    <p class="text-xs font-bold uppercase text-gray-600 mb-16">Le Sous-Directeur TIC</p>
                    <p class="text-sm font-semibold border-t border-dashed border-gray-400 pt-2 inline-block px-8">Dkhili Abdallah</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase text-gray-600 mb-16">Cachet et Signature de l'Établissement</p>
                    <p class="text-sm font-semibold border-t border-dashed border-gray-400 pt-2 inline-block px-8">&nbsp;</p>
                </div>
            </div>
        </div>

        <!-- Boutons d'action hors impression -->
        <div class="mt-10 text-center no-print space-x-4">
            <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-2 rounded-md font-semibold text-sm hover:bg-indigo-700 shadow transition">
                <i class="bi bi-printer mr-2"></i> Imprimer le document
            </button>
            <a href="{{ route('ordres-mission.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md font-semibold text-sm hover:bg-gray-400 transition">
                Retour à la liste
            </a>
        </div>

    </div>
</body>
</html>