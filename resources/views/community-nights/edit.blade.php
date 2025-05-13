<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">

    @if(session('success'))
    <div class="w-full flex justify-center">
        <div class="max-w-md p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('community-nights.update', $communityNight->id) }}"  enctype="multipart/form-data" class="mt-4 space-y-4">

        @csrf
        @method('PUT')
        <h2 class="text-center text-xl font-bold mb-4 text-purple-700">Community avond bewerken</h2>

        <div>
            <label for="title" class="block text-sm font-semibold">Titel<span class="text-xl font-bold text-red-500 ml-1">*</span></label>
            <input type="text" name="title" id="title" placeholder="Titel van het evenement"   aria-label="Communityavond title bewerken"
            value="{{ old('title', $communityNight->title) }}"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">

            @error('title')
            <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-semibold">Afbeelding</label>
            <input type="file" name="image" id="image"
            value="{{ old('image', $communityNight->image) }}"
            aria-label="Communityavond afbeelding bewerken"

                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold">Beschrijving<span class="text-xl font-bold text-red-500 ml-1">*</span></label>
            <textarea name="description" id="description" placeholder="Beschrijving van het evenement"
            aria-label="Communityavond beschrijving bewerken"

                      class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">{{ old('description', $communityNight->description) }}</textarea>
                      @error('description')
                        <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
                        @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_time" class="block text-sm font-semibold">Starttijd<span class="text-xl font-bold text-red-500 ml-1">*</span></label>
                <input type="datetime-local" name="start_time" id="start_time"
                value="{{ old('start_time', \Carbon\Carbon::parse($communityNight->start_time)->format('Y-m-d\TH:i')) }}"
                aria-label="Communityavond starttijd bewerken"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                       
                       @error('start_time')
                        <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
                        @enderror
            </div>
            <div>
                <label for="end_time" class="block text-sm font-semibold">Eindtijd<span class="text-xl font-bold text-red-500 ml-1">*</span></label>
                <input type="datetime-local" name="end_time" id="end_time"
                value="{{ old('end_time', \Carbon\Carbon::parse($communityNight->end_time)->format('Y-m-d\TH:i')) }}"
                aria-label="Communityavond eindtijd bewerken"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                       @error('end_time')
                        <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
                        @enderror
            </div>
        </div>

        <div>
            <label for="location" class="block text-sm font-semibold">Locatie<span class="text-xl font-bold text-red-500 ml-1">*</span></label>
            <input type="text" name="location" id="location" placeholder="Locatie van het evenement"
            value="{{ old('location', $communityNight->location) }}"
            aria-label="Communityavond locatie bewerken"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                   @error('location')
                    <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
                    @enderror
        </div>

        <div>
            <label for="link" class="block text-sm font-semibold">Event Link:</label>
            <input type="url" name="link" id="link" placeholder="Link naar het evenement"
            value="{{ old('link', $communityNight->link) }}"
            aria-label="Communityavond link bewerken"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>

        <div>
            <label for="capacity" class="block text-sm font-semibold">Capaciteit:</label>
            <input type="number" name="capacity" id="capacity" placeholder="0" min="0"
            value="{{ old('capacity', $communityNight->capacity) }}"
            aria-label="Communityavond capaciteit bewerken"
                   class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>


        <input type="submit" value="Opslaan" class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer mt-4">
    </form>
    </div>
</x-layout>

