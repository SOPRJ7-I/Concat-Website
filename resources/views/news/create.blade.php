<x-layout>
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10" role="form" aria-labelledby="formTitle">
        <h2 id="formTitle" class="text-2xl font-bold mb-6">Nieuwsbrief Uploaden</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4" role="alert" aria-live="assertive">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('newsletters.store') }}" enctype="multipart/form-data" aria-describedby="formDescription">
            @csrf

            <p id="formDescription" class="sr-only">
                Vul dit formulier in om een nieuwsbrief te uploaden. Alle velden zijn verplicht.
            </p>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="titel">Titel</label>
                <input type="text" id="titel" name="titel" class="w-full border border-gray-300 rounded p-2" required aria-required="true">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="publicatiedatum">Publicatiedatum</label>
                <input type="date" id="publicatiedatum" name="publicatiedatum" class="w-full border border-gray-300 rounded p-2" required aria-required="true">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1" for="pdf">PDF-bestand</label>
                <input type="file" id="pdf" name="pdf" accept="application/pdf" class="w-full" required aria-required="true">
            </div>

            <button type="submit" class=" bg-red-500 text-white p-2 rounded-lg hover:bg-red-600" aria-label="Upload nieuwsbrief">Uploaden</button>
        </form>
    </div>
</x-layout>
