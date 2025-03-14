<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenementen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-200 to-blue-300 min-h-screen flex justify-center items-center p-6">

    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
            Evenementen
        </h1>

        <!-- Sorteeropties -->
        <div class="mt-4 mb-6 text-center">
            <label for="sort" class="text-sm font-semibold mr-2">Sorteer op:</label>
            <select id="sort" class="p-2 bg-purple-100 text-purple-700 rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500" onchange="sortEvents()">
                <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>Oplopend (Startdatum)</option>
                <option value="desc" {{ request('sort', 'asc') == 'desc' ? 'selected' : '' }}>Aflopend (Startdatum)</option>
            </select>
        </div>

        <!-- Evenementen Grid -->
        <div id="events-container" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ($evenementen as $evenement)
            <div class="bg-white p-6 rounded-xl shadow-lg border border-purple-300">
                <h2 class="text-xl font-semibold text-purple-700 mb-2">{{ $evenement->naam }}</h2>
                <p class="text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($evenement->beschrijving), 150, '...') }}</p>
                <p class="text-sm text-purple-700"><strong>Locatie:</strong> {{ $evenement->locatie }}</p>
                <p class="text-sm text-purple-700"><strong>Beschrijving:</strong> {{ $evenement->beschrijving }}</p>
                <p class="text-sm text-purple-700"><strong>Startdatum:</strong> {{ \Carbon\Carbon::parse($evenement->datum)->format('d-m-Y') }}</p>
                <p class="text-sm text-purple-700"><strong>Starttijd:</strong> {{ \Carbon\Carbon::parse($evenement->start_datum)->format('H:i') }}</p>
                <p class="text-sm text-purple-700"><strong>Eindtijd:</strong> {{ \Carbon\Carbon::parse($evenement->eind_date)->format('H:i') }}</p>
                <a href="{{ $evenement->ticket_link }}" target="_blank" class="mt-3 inline-block bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition font-semibold">
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

</body>
</html>
