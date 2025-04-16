<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-yellow-500 inline-block pb-1">
            Announcement bewerken
        </h1>

        <!-- Foutmeldingen -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('announcements.update', $announcement->id) }}" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="titel" class="block text-sm font-semibold">*Titel:</label>
                <input type="text" name="titel" id="titel" value="{{ old('titel', $announcement->titel) }}" required
                    class="w-full p-2 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300 focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label for="inhoud" class="block text-sm font-semibold">*Inhoud:</label>
                <textarea name="inhoud" id="inhoud" rows="5" required
                    class="w-full p-2 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300 focus:ring-2 focus:ring-yellow-500">{{ old('inhoud', $announcement->inhoud) }}</textarea>
            </div>

            <div>
                <label for="publicatiedatum" class="block text-sm font-semibold">*Publicatiedatum en Tijd:</label>
                <input type="datetime-local" name="publicatiedatum" id="publicatiedatum"
                    value="{{ old('publicatiedatum', \Carbon\Carbon::parse($announcement->publicatiedatum)->format('Y-m-d\TH:i')) }}"
                    required
                    class="w-full p-2 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300 focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label for="vervaldatum" class="block text-sm font-semibold">Vervaldatum (optioneel):</label>
                <input type="datetime-local" name="vervaldatum" id="vervaldatum"
                    value="{{ old('vervaldatum', $announcement->vervaldatum ? \Carbon\Carbon::parse($announcement->vervaldatum)->format('Y-m-d\TH:i') : '') }}"
                    class="w-full p-2 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300 focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <input type="submit" value="Opslaan"
                    class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition font-semibold cursor-pointer">
            </div>
        </form>
    </div>
</x-layout>