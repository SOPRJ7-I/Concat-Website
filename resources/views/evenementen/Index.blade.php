<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenementen</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Evenementen</h1>
        
        <div class="mb-4 text-center">
            <label for="sort" class="mr-2">Sorteer op:</label>
            <select id="sort" class="p-2 border rounded" onchange="sortEvents()">
                <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>Oplopend (Startdatum)</option>
                <option value="desc" {{ request('sort', 'asc') == 'desc' ? 'selected' : '' }}>Aflopend (Startdatum)</option>
            </select>
        </div>

        <div id="events-container" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ($evenementen as $evenement)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-2">{{ $evenement->naam }}</h2>
                <p class="text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($evenement->beschrijving), 150, '...') }}</p>
                <p class="text-sm text-gray-600"><strong>Locatie:</strong> {{ $evenement->locatie }}</p>
                <p class="text-sm text-gray-600"><strong>Startdatum:</strong> {{ \Carbon\Carbon::parse($evenement->start_datum)->format('d-m-Y') }}</p>
                <p class="text-sm text-gray-600"><strong>Starttijd:</strong> {{ \Carbon\Carbon::parse   ($evenement->start_datum)->format('H:i') }}</p>
                <p class="text-sm text-gray-600"><strong>Einddatum:</strong> {{ \Carbon\Carbon::parse($evenement->eind_date)->format('d-m-Y') }}</p>
                <p class="text-sm text-gray-600"><strong>Eindtijd:</strong> {{ \Carbon\Carbon::parse($evenement->eind_date)->format('H:i') }}</p>
                <a href="{{ $evenement->ticket_link }}" target="_blank" class="mt-3 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Lees meer...</a>
            </div>
        @endforeach
        
        </div>

        <!-- Pagination Links -->
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
