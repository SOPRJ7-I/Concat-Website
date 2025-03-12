<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lijst van Evenementen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Lijst van Evenementen</h1>
        @foreach ($evenementen as $evenement)
        <div class="p-4 border rounded-lg shadow-md">
            <h2 class="text-xl font-bold">{{ $evenement->titel }}</h2>
            <p><strong>Datum:</strong> {{ $evenement->datum }}</p>
            <p><strong>Locatie:</strong> {{ $evenement->locatie }}</p>
            @if ($evenement->afbeelding)
                <img src="{{ asset('storage/' . $evenement->afbeelding) }}" alt="Afbeelding van {{ $evenement->titel }}" class="w-full h-auto mt-2 rounded-lg">
            @endif
        </div>
        @endforeach


        <a href="/create_evenement" class="text-blue-500 hover:underline">Evenement toevoegen</a>
    </div>
</body>
</html>