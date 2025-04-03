<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
    <form method="POST" action="{{ route('community-nights.store') }}"  enctype="multipart/form-data" class="mt-4 space-y-4">

        @csrf

        <h2 class="text-center text-xl font-bold mb-4 text-purple-700">Community avond toevoegen</h2>

        <div>
            <label for="title" class="block text-sm font-semibold">Titel:</label>
            <input type="text" name="title" id="title" placeholder="Titel van het evenement"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">

            @error('title')
            <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-semibold">Afbeelding (optioneel):</label>
            <input type="file" name="image" id="image"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold">Beschrijving:</label>
            <textarea name="description" id="description" placeholder="Beschrijving van het evenement"
                      class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_time" class="block text-sm font-semibold">Starttijd:</label>
                <input type="datetime-local" name="start_time" id="start_time"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label for="end_time" class="block text-sm font-semibold">Eindtijd:</label>
                <input type="datetime-local" name="end_time" id="end_time"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <div>
            <label for="location" class="block text-sm font-semibold">Locatie:</label>
            <input type="text" name="location" id="location" placeholder="Locatie van het evenement"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>

     <div class="bg-gray-200 p-4 rounded-lg border border-gray-300 mt-4">
        <p class="text-sm font-bold text-gray-800 mb-2">Optioneel:</p>
        <div>
            <label for="link" class="block text-sm font-semibold">Event Link:</label>
            <input type="url" name="link" id="link" placeholder="Link naar het evenement"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>

        <div>
            <label for="capacity" class="block text-sm font-semibold">Capaciteit:</label>
            <input type="number" name="capacity" id="capacity" placeholder="0" min="0"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>
      </div>


        <input type="submit" value="Toevoegen" class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer mt-4">
    </form>
    </div>
</x-layout>

