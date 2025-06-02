<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5 mx-auto">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1" alt="Formulier voor het bewerken van een nieuwsbrief">
            Nieuwsbrief bewerken
        </h1>

        <form method="POST"
              action="{{ route('newsletters.update', $newsletter) }}"
              enctype="multipart/form-data"
              class="mt-4 space-y-6" onsubmit="return validateForm()">
            @csrf
            @method('PUT')

            <div>
                <label for="titel" class="block text-l font-bold">Titel*</label>
                <input type="text" name="titel" id="titel"
                       value="{{ old('titel', $newsletter->titel) }}"
                       class="w-full p-2 {{ $errors->has('titel') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                @error('titel')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="publicatiedatum" class="block text-l font-bold">Publicatiedatum*</label>
                <input type="date" name="publicatiedatum" id="publicatiedatum"
                       value="{{ old('publicatiedatum', \Carbon\Carbon::parse($newsletter->publicatiedatum)->format('Y-m-d')) }}"
                       class="w-full p-2 {{ $errors->has('publicatiedatum') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                @error('publicatiedatum')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="inhoud" class="block text-l font-bold">Inhoud*</label>
                <textarea name="inhoud" id="inhoud" rows="8"
                          class="w-full p-2 {{ $errors->has('inhoud') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">{{ old('inhoud', $newsletter->inhoud) }}</textarea>
                @error('inhoud')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="images" class="block text-l font-bold">Afbeeldingen</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('images.*')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror

                @if ($newsletter->images)
                    <div class="mt-4 grid grid-cols-3 gap-4">
                        @foreach (json_decode($newsletter->images) as $image)
                            @if ($image)
                                <img src="{{ str_contains($image, 'storage') ? asset(str_replace(public_path(), '', $image)) : asset('storage/' . $image) }}" 
                                     alt="Afbeelding nieuwsbrief"
                                     class="w-full h-auto rounded shadow border">
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <input type="submit" value="Wijzigingen opslaan"
                   class="w-full bg-orange-500 text-white p-3 rounded-lg hover:bg-orange-600 transition font-semibold cursor-pointer" alt="Klik om de nieuwsbrief op te slaan">

        </form>
    </div>
</x-layout>
