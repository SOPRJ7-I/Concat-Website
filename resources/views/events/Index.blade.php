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
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>
                    <p class="text-gray-700 mb-3">{{ $event->description }}</p>
                    <p class="text-sm text-gray-600"><strong>Locatie:</strong> {{ $event->location }}</p>
                    <p class="text-sm text-gray-600"><strong>Start:</strong> {{ $event->start_date }}</p>
                    <p class="text-sm text-gray-600"><strong>Einde:</strong> {{ $event->end_date }}</p>
                    <a href="{{ $event->ticket_link }}" target="_blank" class="mt-3 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tickets</a>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
