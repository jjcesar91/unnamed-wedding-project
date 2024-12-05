<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-4">Registrati</h2>
    
        <form action="#" method="POST">
            <!-- Nome -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
    
          
           
            <!-- Pulsante di invio -->
            <div class="flex justify-center">
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Salva
                </button>
            </div>
        </form>
    </div>
    


</x-app-layout>