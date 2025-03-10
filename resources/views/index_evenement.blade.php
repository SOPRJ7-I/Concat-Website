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

        @if ($evenementen->count())
            <ul class="space-y-4">
                @foreach ($evenementen as $evenement)
                    <li class="p-4 bg-purple-100 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold">{{ $evenement->titel }}</h2>
                        <p><strong>Datum:</strong> {{ $evenement->datum }}</p>
                        <p><strong>Locatie:</strong> {{ $evenement->locatie }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Geen evenementen gevonden.</p>
        @endif

        <a href="/" class="block text-center mt-4 text-sm text-purple-700 hover:underline">
            Terug naar het formulier
        </a>
    </div>
</body>
</html>