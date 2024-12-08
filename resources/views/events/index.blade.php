<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h1>{{session('is_created')?? ""}}</h1>

    {{-- @dd($events) --}}
    <div class="flex flex-wrap justify-center gap-6">
        @forelse($events as $event)
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <!-- Immagine -->
                <img class="w-full h-48 object-cover" src="{{$event->img?? 'https://via.placeholder.com/250x250'}}" alt="Immagine della card">
            
                <!-- Contenuto della card -->
                <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800">{{$event->title}}</h2>
                <p class="text-gray-600 mt-2">{{$event->description}}</p>
                
                <!-- Pulsante -->
                <a href="#" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Vai ai dettagli #</a>
                </div>
            </div>
        @empty
            <h1>Non partecipi a nessun evento!</h1>
        @endforelse
    </div>
</x-app-layout>