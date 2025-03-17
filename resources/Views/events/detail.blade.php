<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <title>{{ $event->titel }}</title>
</head>
<x-layout>
    <div class="lg:my-12 max-w-4xl border-2 mx-auto shadow-xl rounded-lg overflow-hidden bg-white">
        <!-- Header with cover image (if available) -->
        <div class="relative bg-gray-200 overflow-hidden">
            @if(isset($event->afbeelding))
                <div class="lg:h-64">
                    <img src="{{ $event->afbeelding }}" alt="{{ $event->titel }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="p-6 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                    <h1 class="text-white text-3xl font-bold">{{ $event->titel ?? 'Community Night' }}</h1>
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="p-6 md:p-14">
            <div class="mb-8">
                @if(isset($event->afbeelding))
                    <h1 class="text-2xl font-bold text-gray-800 mb-5">{{ $event->titel ?? 'TITEL' }}</h1>
                @endif

                <div class="flex items-center text-gray-500 mb-4">
                    <i class="flex flex-shrink-0 fa-fw fa-solid fa-calendar text-3xl"></i>
                    <span class="text-lg font-bold">{{ $event->datum }}, {{ $event->starttijd }} - {{ $event->eindtijd }}</span>
                </div>

                <div class="flex items-center text-gray-500 mb-4">
                    <i class="flex flex-shrink-0 fa-fw fa-solid fa-location-dot text-3xl"></i>
                    <span class="text-lg font-bold">{{ $event->locatie ?? 'Locatie TBD' }}</span>
                </div>

                <hr class="my-1 border-2 border-gray-400 rounded">

                <div class="sm:text-right sm:text-lg text-md text-gray-500">
                    Laatst bijgewerkt op: {{ $event->updatedAt }}
                </div>
            </div>
            <div class="text-lg sm:text-xl leading-relaxed max-w-prose">
                <p>{!! $event->beschrijving ?? 'No description available.' !!}</p>
            </div>
        </div>
    </div>
</x-layout>
