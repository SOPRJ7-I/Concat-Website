<x-layout>
    <div class="lg:my-12 w-full max-w-3xl lg:max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 justify-center">
        {{-- Events Section Wrapper --}}
        <div class="w-full lg:max-w-6/12 lg:pr-20">
            <h1 class="text-3xl font-bold mb-2 text-left">Evenementen</h1>
            <hr class="border-b-4 border-purple-500 mb-4">
            <div class="grid gap-8 lg:gap-6">
                <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('evenementen.show', $event->id) }}"
                    aria-label="Details bekijken van {{ $event->titel }}">
                        @if(isset($event->afbeelding) && isset($event->start_datum) && isset($event->einddatum) && isset($event->locatie))
                            <img src="{{ $event->afbeelding }}"
                                alt="Afbeelding van {{ $event->titel }}. Datum: {{ \Carbon\Carbon::parse($event->start_datum)->format('d-m-Y') }} tot {{ \Carbon\Carbon::parse($event->einddatum)->format('d-m-Y') }} in {{ $event->locatie }}"
                                class="h-44 w-full object-cover">
                        @else
                            <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500" aria-hidden="true">
                                <h1 class="text-white text-3xl font-bold">{{ $event->titel }}</h1>
                            </div>
                        @endif
                    </a>

                    <div class="p-7">
                        {{-- Categorie --}}
                        @if(isset($event->categorie))
                            <span class="inline-block mb-2 bg-purple-100 text-purple-700 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">
                                        {{ ucfirst($event->categorie) }}
                            </span>
                        @endif

                        {{-- Datum & tijd --}}
                        @if(isset($event->start_datum) && isset($event->einddatum))
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="flex flex-shrink-0 fa-solid fa-calendar fa-fw text-3xl" aria-hidden="true"></i>
                                <span class="text-lg font-bold ml-2">
                                            {{ \Carbon\Carbon::parse($event->start_datum)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($event->starttijd)->format('H:i') }},
                                            {{ \Carbon\Carbon::parse($event->einddatum)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($event->eindtijd)->format('H:i') }}
                                </span>
                            </div>
                        @endif

                        {{-- Locatie --}}
                        @if(isset($event->locatie))
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="flex flex-shrink-0 fa-solid fa-location-dot fa-fw text-3xl" aria-hidden="true"></i>
                                <span class="text-md font-bold ml-2">{{ $event->locatie }}</span>
                            </div>
                        @endif

                        {{-- Beschrijving --}}
                        <div class="mb-4 grow text-gray-700 relative overflow-hidden max-h-32">
                            <p class="mb-3 font-normal text-gray-700">
                                {{ \Illuminate\Support\Str::limit(strip_tags($event->beschrijving), 150, '...') }}
                            </p>
                            <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent to-white" aria-hidden="true"></div>
                        </div>

                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex-shrink-0 fa-solid fa-users text-3xl" alt="Aantal inschrijvingen evenement" aria-hidden="true"></i>
                            <div class="ml-2">
                                <!-- Totaal aantal plekken -->
                                <div class="text-lg font-bold">
                                    Totaal aantal plekken:
                                    @if($availableSpots > 0)
                                        {{ $availableSpots }} plekken
                                    @else
                                        Geen plaatsen beschikbaar
                                    @endif
                                </div>

                                <!-- Aantal ingeschreven -->
                                @if(auth()->user() && auth()->user()->is_admin) <!-- Check if the user is admin -->
                                <div class="text-lg font-bold">
                                    Aantal ingeschreven: {{ $registeredCount }}
                                </div>
                            @endif
                            </div>
                        </div>

                        {{-- Lees meer knop --}}
                        <a href="{{ route('evenementen.show', $event->id) }}"
                        class="inline-flex items-center text-sm text-center bg-[#3129FF] text-white py-2 px-4 rounded-lg hover:bg-[#E39FF6] transition font-semibold"
                        aria-label="Lees meer over {{ $event->titel }}. Datum van {{ \Carbon\Carbon::parse($event->start_datum)->format('d-m-Y') }} tot {{ \Carbon\Carbon::parse($event->einddatum)->format('d-m-Y') }} in {{ $event->locatie }}">
                            Lees meer over {{ $event->titel }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Community Night Section Wrapper --}}
        <div class="w-full lg:max-w-6/12">
            <h1 class="text-3xl font-bold mb-2 text-left">Community-avonden</h1>
            <hr class="border-b-4 border-purple-500 mb-4">
            <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <a href="{{ route('community-nights.show', $communityNight) }}">
                    {{-- Temporarily disabled, breaks at times for unknown reasons --}}
                    {{-- @if(isset($communityNight->image))
                        <img src="{{ $communityNight->image }}" alt="{{ $communityNight->title }}" class="h-44 w-full object-cover">
                     @else --}}
                    <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                        <h1 class="text-white text-3xl font-bold">{{ $communityNight->title ?? 'Community Night' }}</h1>
                    </div>
                    {{-- @endif --}}
                </a>

                <div class="p-5">
                    {{-- Temporarily disabled, breaks at times for unknown reasons --}}
                    {{-- @if(isset($communityNight->image))
                        <a href="{{ route('community-nights.show', $communityNight) }}">
                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">{{ $communityNight->title }}</h5>
                        </a>
                        <!--- <hr class="mb-4 border-2 border-gray-400 rounded"> -->
                    @endif --}}

                    @if(isset($communityNight->date))
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-solid fa-calendar fa-fw text-3xl"></i>
                            <span class="text-lg font-bold">{{ $communityNight->date }}, {{ $communityNight->start_time }} - {{ $communityNight->end_time }}</span>
                        </div>
                    @endif

                    @if(isset($communityNight->location))
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-solid fa-location-dot fa-fw text-3xl"></i>
                            <span class="text-md font-bold">{{ $communityNight->location ?? 'Locatie TBD' }}</span>
                        </div>
                    @endif


                    <div class="mb-4 grow text-gray-700 relative overflow-hidden max-h-32">
                        <p class="mb-3 font-normal text-gray-700 ">{{ $communityNight->description }}</p>
                        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent to-white"></div>
                    </div>

                    <a href="{{ route('community-nights.show', $communityNight) }}" class="inline-flex items-center text-sm text-center bg-[#3129FF] text-white py-2 px-4 rounded-lg hover:bg-[#E39FF6] transition font-semibold">
                        Lees meer...
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-layout>
