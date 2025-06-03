<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Announcement aanmaken
        </h1>

        <form method="POST" action="{{ route('announcements.store') }}" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="titel" class="block text-l font-bold">Titel*</label>
                <input type="text" name="titel" id="titel" value="{{ old('titel') }}"
                       placeholder="Titel van het event"
                       class="w-full p-2 {{ $errors->has('titel') ? 'bg-red-100 border-red-500' : 'bg-purple-100 border-purple-300' }} text-purple-700 rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                @error('titel')
                <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="inhoud" class="block text-l font-bold">Inhoud*</label>
                <textarea name="inhoud" id="inhoud" rows="5"
                          placeholder="Beschrijving van de announcement"
                          class="w-full p-2 {{ $errors->has('inhoud') ? 'bg-red-100 border-red-500' : 'bg-purple-100 border-purple-300' }} text-purple-700 rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">{{ old('inhoud') }}</textarea>
                @error('inhoud')
                <p class="text-red-600 text-sm mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="hidden" name="isVisible" value="0">
                    <input type="checkbox" name="isVisible" value="1"
                           class="form-checkbox h-5 w-5 text-purple-600" {{ old('isVisible', false) ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700">Maak direct zichtbaar</span>
                </label>
            </div>


            <div>
                <input type="submit" value="Toevoegen"
                       class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
            </div>
        </form>
    </div>
</x-layout>
