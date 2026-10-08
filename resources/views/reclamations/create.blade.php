<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Signaler une nouvelle panne ou réclamation TIC') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('reclamations.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Titre de la panne / Problème</label>
                        <input type="text" name="titre" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ex: Connexion Internet instable au labo info">
                        @error('titre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Équipement concerné (optionnel)</label>
                        <input type="text" name="equipement" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ex: Routeur principal / PC Prof N°4">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Niveau de priorité</label>
                        <select name="priorite" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="faible">Faible</option>
                            <option value="moyenne" selected>Moyenne</option>
                            <option value="haute">Haute</option>
                            <option value="critique">Critique (Urgence)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description détaillée</label>
                        <textarea name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Décrivez précisément le dysfonctionnement constaté..."></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('reclamations.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm">Annuler</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">Envoyer la réclamation</center>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>