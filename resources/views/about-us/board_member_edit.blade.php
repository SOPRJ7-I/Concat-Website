<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 aria-label="Bewerk bestuurslid {{ $boardMember->name}}" class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Bestuurslid bewerken
        </h1>

        @if(session('success'))
            <div aria-label="Succesmelding" aria-live="polite" class="w-full flex justify-center">
                <div class="max-w-md p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('board-members.update', $boardMember->id) }}" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <x-form-label for="name">Naam*:</x-form-label>
                <x-form-input type="text" name="name" id="name" value="{{ old('name', $boardMember->name) }}" required aria-required="true" placeholder="Naam van het bestuurslid"/>
                <x-form-error name="name"/>
            </div>

            {{-- Role --}}
            <div>
                <x-form-label for="role">Rol*:</x-form-label>
                <x-form-input type="text" name="role" id="role" value="{{ old('role', $boardMember->role) }}" required aria-required="true" placeholder="Functie van het bestuurslid"/>
                <x-form-error name="role"/>
            </div>

            {{-- Photo --}}
            <div>
                <x-form-label for="photo">Foto:</x-form-label>
                @if ($boardMember->photo)
                    <div class="mb-2">
                        <img src="{{ asset($boardMember->photo) }}" alt="Huidige profielfoto van {{ $boardMember->name }}" class="w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-500">Huidige foto</p>
                    </div>
                @endif
                <x-form-input type="file" name="photo" id="photo" accept="image/*" aria-label="Upload een profielfoto voor dit bestuurslid"/>
                <x-form-error name="photo"/>
            </div>

            {{-- Bio --}}
            <div>
                <x-form-label for="bio">Bio*:</x-form-label>
                <x-form-textarea name="bio" id="bio" rows="6" required aria-required="true" placeholder="Biografie van het bestuurslid">{{ old('bio', $boardMember->bio) }}</x-form-textarea>
                <x-form-error name="bio"/>
            </div>

            {{-- Submit --}}
            <x-form-button type="submit" class="w-full">Opslaan</x-form-button>
        </form>
    </div>
</x-layout>
