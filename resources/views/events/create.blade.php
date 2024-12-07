<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-full mx-auto mt-14 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-4">Crea un evento</h2>

        <form action="{{route("events.store")}}" method="POST" class="flex justify-center space-x-32" enctype="multipart/form-data">
            @csrf
  
            <div class="mb-4">

                <div style="max-width: 100%; margin-top: 20px;">
                    <img id="croppedImage" src="your-image.jpg" alt="Image description" class="object-cover w-full h-full" onerror="this.onerror=null;this.src='https://via.placeholder.com/250';">            
                </div>

                <div class="mb-4">
                    <label for="file" name="img" class="block text-sm font-medium text-gray-700">Carica un file</label>
                    <input type="file" id="file" name="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-50 file:text-indigo-700 file:border file:border-indigo-300 file:py-2 file:px-4 file:rounded-full hover:file:bg-indigo-100" />
                </div>
            </div>       
        
            <div class="inputList w-1/3">
        
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
                    <input type="text" id="title" name="title" class="text-black mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
           
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" id="location" name="location" class="text-black mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <div class="w-full mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    Tipo di evento
                    </label>
                    <div class="relative">
                        <select name="type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" required>
                            <option value="" selected>Seleziona Un tipo</option>

                            @foreach($typeList as $type)
                                <option value="{{$type}}">{{$type}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="mb-4 w-1/3">
                    <label for="date" class="block text-sm font-medium text-gray-700">Data</label>
                    <input type="datetime-local" id="date" name="date" value="{{ now()->format('Y-m-d\TH:i') }}" min="{{ now()->format('Y-m-d\TH:i') }}" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>


                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrizione</label>
                    <textarea id="description" name="description" rows="4" maxlength="250" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Salva
                    </button>
                </div>
            </div>
        </form>
    </div>


   {{-- aggiungere modifica? --}}
    <x-modal name="cropModal" :show="false" maxWidth="4xl">
        <h2 class="text-2xl text-center font-semibold">Ritaglia l'Immagine</h2>

        <div class="flex justify-center items-center my-4">
            <img id="image" src="#" alt="Immagine da ritagliare" class="max-w-full max-h-[500px] object-contain" />
        </div>

        <div class="mt-4 flex justify-between">
            <button id="cropButton" class="bg-green-500 text-white px-4 py-2 rounded">Ritaglia</button>
        </div>
    </x-modal>
    

    {{-- @push('styles')
        <style>
            
        </style>
    @endpush --}}
    
    @push('scripts')
        <script>
            const img = document.getElementById("image");
            const fileInput = document.getElementById("file");
            const cropButton = document.getElementById("cropButton");
            const croppedImage = document.getElementById("croppedImage");
            const closeModalButton = document.getElementById("closeModalButton");

            let cropper;
            let isReading = false; // impedisco più eventi


            // Gestione del cambiamento del file
            fileInput.addEventListener("change", function(event) {

                if (isReading) return;

                const file = event.target.files[0];
                if (!file) {
                    console.error("Errore nella selezione del file");
                    return;
                }

                const reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = function(e) {
                    img.src = e.target.result; 
                    
                    if (cropper) {
                        cropper.destroy();
                    }
                    
                    // Inizializzo il cropper con img caricata
                    cropper = new Cropper(img, {
                        aspectRatio: 1, // Mantieni proporzioni 1:1
                        viewMode: 1, // Limita lo spostamento dell'immagine al canvas
                        movable: true, // Permette di spostare l'immagine
                        zoomable: true, // Permette di zoomare
                        scalable: true, // Permette di scalare
                        minContainerWidth: 250,  // Imposta una larghezza minima
                        minContainerHeight: 250,  // Imposta un'altezza minima
                    autoCropArea: 1,
                    });

                    window.dispatchEvent(new CustomEvent('open-modal', { detail: 'cropModal' }));
                };

                // gestione degli stati
                reader.onerror = function(error) {
                    // controllo sugli errori, restituire msg nella modal e tornare al default delle img
                    isReading = false;
                    console.error("Errore nella lettura del file:", error);
                };

                reader.onloadstart = function() {
                    isReading = true;
                };
            });

        //  confermo ritaglio, prendo 250x250 dal canva e lo inserisco nella preview
            cropButton.addEventListener("click", function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        width: 250, 
                        height: 250, 
                    });
                    croppedImage.src = canvas.toDataURL(); 
                    isReading = false;
                    const byteString = atob(croppedDataURL.split(',')[1]);
                    const mimeString = croppedDataURL.split(',')[0].split(':')[1].split(';')[0];
                    const ab = new ArrayBuffer(byteString.length);
                    const ia = new Uint8Array(ab);
                    for (let i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }
                    const blob = new Blob([ab], { type: mimeString });

                    // Crea un File dal Blob (per inviarlo tramite form)
                    const file = new File([blob], "cropped-image.png", { type: mimeString });

                    // Sostituisci il file nell'input
                    fileInput.files = createFileList(file);
                }

                window.dispatchEvent(new CustomEvent('close-modal', { detail: 'cropModal' }));
            });

            function createFileList(file) {
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    return dataTransfer.files;
}

        </script>
    @endpush

</x-app-layout>

