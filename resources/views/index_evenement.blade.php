<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
            Evenementen
        </h1>

        <!-- Sorteeropties -->
        <div class="mt-4 mb-6 text-center">
            <label for="sort" class="text-sm font-semibold mr-2">Sorteer op:</label>
            <select id="sort" class="p-2 bg-purple-100 text-black rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500" onchange="sortEvents()">
                <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>Oplopend (Startdatum)</option>
                <option value="desc" {{ request('sort', 'asc') == 'desc' ? 'selected' : '' }}>Aflopend (Startdatum)</option>
            </select>
        </div>

        <!-- Evenementen Grid -->
        <div id="events-container" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ($evenementen as $evenement)
                <div class="bg-white p-6 rounded-xl shadow-lg border border-purple-300">
                    <h2 class="text-xl font-semibold text-black mb-2">{{ $evenement->titel }}</h2>
                    <p class="text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($evenement->beschrijving), 150, '...') }}</p>

                    <hr class="my-3">
                    <div class="flex flex-wrap justify-between mb-3">
                        <div class="w-1/2">
                            <p class="text-sm text-black"><strong>Locatie:</strong></p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-black">{{ $evenement->locatie }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between mb-3">
                        <div class="w-1/2">
                            <p class="text-sm text-black"><strong>Startdatum:</strong></p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-black">{{ \Carbon\Carbon::parse($evenement->datum)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between mb-3">
                        <div class="w-1/2">
                            <p class="text-sm text-black"><strong>Starttijd:</strong></p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-black">{{ \Carbon\Carbon::parse($evenement->start_datum)->format('H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between mb-3">
                        <div class="w-1/2">
                            <p class="text-sm text-black"><strong>Eindtijd:</strong></p>
                        </div>
                        <div class="w-1/2">
                            <p class="text-sm text-black">{{ \Carbon\Carbon::parse($evenement->eind_date)->format('H:i') }}</p>
                        </div>
                    </div>
                    <a href="{{ $evenement->ticket_link }}" target="_blank" class="mt-3 inline-block bg-[#3129FF] text-white py-2 px-4 rounded-lg hover:bg-[#E39FF6] transition font-semibold">
                        Lees meer...
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Paginering -->
        <div id="pagination-container" class="mt-6 text-center">
            {{ $evenementen->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        function sortEvents() {
            let sortValue = document.getElementById('sort').value;
            window.location.href = `?sort=${sortValue}`;
        }
    </script>
</x-layout>
