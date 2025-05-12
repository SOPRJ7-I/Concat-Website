<x-layout>
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h2 class="text-2xl font-bold mb-6">Nieuwsbrief Uploaden</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('newsletters.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="titel">Titel</label>
                <input type="text" id="titel" name="titel" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="publicatiedatum">Publicatiedatum</label>
                <input type="date" id="publicatiedatum" name="publicatiedatum" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="pdf">PDF-bestand</label>
                <input type="file" id="pdf" name="pdf" accept="application/pdf" class="w-full" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Uploaden</button>
        </form>
    </div>
</x-layout>
