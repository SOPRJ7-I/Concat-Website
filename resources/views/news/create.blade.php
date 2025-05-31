<x-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Nieuwe Nieuwsbrief</h1>

        <form method="POST" action="{{ route('newsletters.store') }}">
            @csrf

            <div class="mb-4">
                <label for="titel" class="block font-semibold mb-1">Titel</label>
                <input type="text" name="titel" id="titel"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       value="{{ old('titel') }}">
                @error('titel')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="publicatiedatum" class="block font-semibold mb-1">Publicatiedatum</label>
                <input type="date" name="publicatiedatum" id="publicatiedatum"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       value="{{ old('publicatiedatum') }}">
                @error('publicatiedatum')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="inhoud" class="block font-semibold mb-1">Inhoud</label>
                <textarea name="inhoud" id="inhoud" rows="8"
                          class="w-full border border-gray-300 rounded px-3 py-2"
                          >{{ old('inhoud') }}</textarea>
                @error('inhoud')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Maak nieuwsbrief aan
            </button>
        </form>
    </div>
</x-layout>
