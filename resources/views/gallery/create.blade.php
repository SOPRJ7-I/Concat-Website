<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1" alt="Formulier voor het toevoegen van een foto">
            Foto toevoegen
        </h1>

        <form method="POST" action="{{ isset($photo) ? route('gallery.update', $photo) : route('gallery.store') }}"
              enctype="multipart/form-data"
              class="mt-4 space-y-4" onsubmit="return validateGalleryForm()">
            @csrf
            @if(isset($photo))
                @method('PUT')
            @endif

            <div>
                <label for="title" class="block text-l font-bold">Titel*</label>
                <input type="text" name="title" id="title" placeholder="Titel van de foto"
                       value="{{ old('title', $photo->title ?? '') }}"
                       class="w-full p-2 {{ $errors->has('title') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                @error('title')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-l font-bold">Categorie*</label>
                <select name="type" id="type"
                        class="w-full p-2 {{ $errors->has('type') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Selecteer een categorie --</option>
                    <option value="blokborrel" {{ old('type', $photo->type ?? '') == 'blokborrel' ? 'selected' : '' }}>Blokborrel</option>
                    <option value="education" {{ old('type', $photo->type ?? '') == 'education' ? 'selected' : '' }}>Education</option>
                </select>
                @error('type')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="date" class="block text-l font-bold">Datum*</label>
                <input type="date" name="date" id="date"
                       value="{{ old('date', isset($photo) ? $photo->date->format('Y-m-d') : '') }}"
                       class="w-full p-2 {{ $errors->has('date') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                @error('date')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-l font-bold">Afbeelding{{ isset($photo) ? '' : '*' }}</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('image')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            @if(isset($photo) && $photo->src)
                <div>
                    <p class="text-sm text-gray-600 mb-1">Huidige afbeelding:</p>
                    <img src="{{ asset($photo->src) }}" class="max-h-40 rounded-lg shadow" alt="Afbeelding">
                </div>
            @endif

            <input type="submit" value="{{ isset($photo) ? 'Wijzigen' : 'Toevoegen' }}"
                   class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
        </form>
    </div>
</x-layout>
