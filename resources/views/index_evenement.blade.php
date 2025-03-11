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
        
        @if(session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @endif

        @foreach ($evenementen as $evenement)
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-semibold">{{ $evenement->naam }}</h2>
                <p><strong>Datum:</strong> {{ $evenement->datum }}</p>
                <p><strong>Locatie:</strong> {{ $evenement->locatie }}</p>
                
                @if ($evenement->foto)
                    <img src="{{ asset('storage/' . $evenement->foto) }}" alt="Evenement Foto" class="w-32 h-32 object-cover mt-2 rounded-lg">
                @endif
            </div>
        @endforeach

        <a href="/create_evenement" class="text-blue-500 hover:underline">Evenement toevoegen</a>
    </div>
</body>
</html>