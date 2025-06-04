<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 aria-label="Bewerk vorige bestuurders" class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Vorige Bestuurders Bewerken
        </h1>

        @if(session('success'))
            <div aria-label="Succesmelding" aria-live="polite" class="w-full flex justify-center">
                <div class="max-w-md p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('previous-boards.update', $previousBoard->id) }}" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            {{-- From Year --}}
            <div>
                <x-form-label for="FromYear">Van Jaar*:</x-form-label>
                <x-form-input
                    type="date"
                    name="FromYear"
                    id="FromYear"
                    value="{{ old('FromYear', \Carbon\Carbon::parse($previousBoard->FromYear)->format('Y-m-d')) }}"
                    required
                    aria-required="true"
                    aria-label="Selecteer het beginjaar van deze bestuursperiode"
                />
                <x-form-error name="FromYear"/>
            </div>

            {{-- To Year --}}
            <div>
                <x-form-label for="ToYear">Tot Jaar*:</x-form-label>
                <x-form-input
                    type="date"
                    name="ToYear"
                    id="ToYear"
                    value="{{ old('ToYear', \Carbon\Carbon::parse($previousBoard->ToYear)->format('Y-m-d')) }}"
                    required
                    aria-required="true"
                    aria-label="Selecteer het eindjaar van deze bestuursperiode"
                />
                <x-form-error name="ToYear"/>
            </div>

            {{-- Members --}}
            <div>
                <x-form-label for="members">Bestuurders*:</x-form-label>
                <x-form-textarea
                    name="members"
                    id="members"
                    rows="5"
                    required
                    aria-required="true"
                    placeholder="Voer de namen in van alle bestuurders, gescheiden door komma's"
                >{{ old('members', $previousBoard->members) }}</x-form-textarea>
                <x-form-error name="members"/>
            </div>

            {{-- Photo --}}
            <div>
                <x-form-label for="photo">Foto:</x-form-label>
                @if ($previousBoard->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $previousBoard->photo) }}" alt="Groepsfoto van de bestuurders uit periode {{ \Carbon\Carbon::parse($previousBoard->FromYear)->format('Y') }} - {{ \Carbon\Carbon::parse($previousBoard->ToYear)->format('Y') }}" class="mt-2 w-32 h-32 object-cover rounded">
                        <p class="text-sm text-gray-500">Huidige groepsfoto</p>
                    </div>
                @endif
                <x-form-input
                    type="file"
                    name="photo"
                    id="photo"
                    accept="image/*"
                    aria-label="Upload een groepsfoto van deze bestuurders"
                />
                <x-form-error name="photo"/>
            </div>

            {{-- Submit button --}}
            <x-form-button type="submit" class="w-full">Opslaan</x-form-button>
        </form>
    </div>
</x-layout>
