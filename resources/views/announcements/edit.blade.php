<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mb-5">
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
                       class="w-full p-2 bg-yellow-50 text-yellow-700 rounded-lg border border-yellow-200 focus:ring-2 focus:ring-yellow-500">
            </div>

            <div>
                <label for="inhoud" class="block text-sm font-semibold">*Inhoud:</label>
                <textarea name="inhoud" id="inhoud" rows="5" required
                          class="w-full p-2 bg-yellow-50 text-yellow-700 rounded-lg border border-yellow-200 focus:ring-2 focus:ring-yellow-500">{{ old('inhoud', $announcement->inhoud) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="hidden" name="isVisible" value="0">
                    <input type="checkbox" name="isVisible" value="1"
                           {{ old('isVisible', $announcement->isVisible) ? 'checked' : '' }}
                           class="form-checkbox h-5 w-5 text-yellow-600">
                    <span class="ml-2 text-gray-700">Zichtbaar maken</span>
                </label>
            </div>

            <div class="flex justify-between">
                <div>
                    <a href="#"
                       class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
                        Annuleren
                    </a>
                </div>
                <div>
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
                            Verwijderen
                        </button>
                    </form>
                </div>
                <div>
                    <input type="submit" value="Opslaan"
                           class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition font-semibold cursor-pointer">
                </div>
            </div>
        </form>
    </div>
</x-layout>
