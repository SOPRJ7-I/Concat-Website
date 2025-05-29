<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Vorig Bestuur Bewerken
        </h1>

        @if(session('success'))
            <div class="w-full flex justify-center">
                <div class="max-w-md p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('previous-boards.update', $previousBoard->id) }}" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="FromYear" class="block text-l font-bold">Van Jaar*</label>
                <input type="date" name="FromYear" id="FromYear" value="{{ old('FromYear', \Carbon\Carbon::parse($previousBoard->FromYear)->format('Y-m-d')) }}"
                       class="w-full p-2 {{ $errors->has('FromYear') ? 'bg-red-100 text-red-700 border-red-300' : 'bg-purple-100 text-purple-700 border-purple-300' }} rounded-lg border outline-none focus:ring-2 focus:ring-purple-500">
                @error('FromYear')
                    <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="ToYear" class="block text-l font-bold">Tot Jaar*</label>
                <input type="date" name="ToYear" id="ToYear" value="{{ old('ToYear', \Carbon\Carbon::parse($previousBoard->ToYear)->format  ('Y-m-d')) }}"
                       class="w-full p-2 {{ $errors->has('ToYear') ? 'bg-red-100 text-red-700 border-red-300' : 'bg-purple-100 text-purple-700 border-purple-300' }} rounded-lg border outline-none focus:ring-2 focus:ring-purple-500">
                @error('ToYear')
                    <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="members" class="block text-l font-bold">Leden*</label>
                <textarea name="members" id="members" rows="5"
                          class="w-full p-2 {{ $errors->has('members') ? 'bg-red-100 text-red-700 border-red-300' : 'bg-purple-100 text-purple-700 border-purple-300' }} rounded-lg border outline-none focus:ring-2 focus:ring-purple-500">{{ old('members', $previousBoard->members) }}</textarea>
                @error('members')
                    <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="photo" class="block text-l font-bold">Foto</label>
                <input type="file" name="photo" id="photo"
                       class="w-full p-2 {{ $errors->has('photo') ? 'bg-red-100 text-red-700 border-red-300' : 'bg-purple-100 text-purple-700 border-purple-300' }} rounded-lg border outline-none focus:ring-2 focus:ring-purple-500">
                @if ($previousBoard->photo)
                    <img src="{{ asset('storage/' . $previousBoard->photo) }}" alt="Huidige foto van vorig bestuur" class="mt-2 w-32 h-32 object-cover rounded">
                @endif
                @error('photo')
                    <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" value="Opslaan"
                   class="w-full bg-purple-600 text-white p-2 rounded-lg hover:bg-purple-700 transition font-semibold cursor-pointer mt-4">
        </form>
    </div>
</x-layout>
