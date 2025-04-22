<x-layout>
    <div class="lg:my-12 w-full max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="border-2 shadow-xl rounded-lg overflow-hidden bg-white">
            <!-- Header with cover image (if available) -->
            <div class="relative bg-gray-200 overflow-hidden">
                @if(isset($communityNight->image))
                    <div class="lg:h-64">
                        <img src="{{ $communityNight->image }}" alt="{{ $communityNight->title }}" class="w-full h-full object-none">
                    </div>
                @else
                    <div class="p-6 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                        <h1 class="text-white text-3xl font-bold">{{ $communityNight->title}}</h1>
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div class="p-6 md:p-14">
                <div class="mb-8">
                    @if(isset($communityNight->image))
                        <h1 class="text-3xl font-bold mb-5">{{ $communityNight->title}}</h1>
                    @endif

                    @if(isset($communityNight->date)) @endif
                    <div class="flex items-center text-gray-500 mb-4">
                        <i class="flex flex-shrink-0 fa-fw fa-solid fa-calendar text-3xl"></i>
                        <span class="text-lg font-bold">{{ $communityNight->date }}, {{ $communityNight->start_time }} - {{ $communityNight->end_time }}</span>
                    </div>

                    @if(isset($communityNight->location))
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-fw fa-solid fa-location-dot text-3xl"></i>
                            <span class="text-lg font-bold">{{ $communityNight->location }}</span>
                        </div>
                    @endif

                    <hr class="my-1 border-2 border-gray-400 rounded">

                    <div class="sm:text-right sm:text-lg text-md text-gray-500">
                        Laatst bijgewerkt op: {{ $communityNight->updatedAt }}
                    </div>
                </div>
                <div class="text-lg sm:text-xl leading-relaxed max-w-prose">
                    <p>{!! $communityNight->formattedDescription ?? 'No description available.' !!}</p>
                </div>
            </div>
        </div>
        <div class="border-2 shadow-xl rounded-lg overflow-hidden bg-white">
            <!-- Header met afbeelding of titel -->
            <div class="relative bg-gray-200 overflow-hidden">
                @if (isset($event->afbeelding) && $event->afbeelding && Storage::exists($event->afbeelding))
                    <div class="lg:h-64">
                        <img src="{{ Storage::url($event->afbeelding) }}" alt="Evenement afbeelding: {{ $event->titel }}"
                            class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="p-6 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                        <h1 class="text-white text-3xl font-bold"
                            alt="Titel van evenement: {{ $event->titel ?? 'Community Night' }}">
                            {{ $event->titel ?? 'Community Night' }}</h1>
                    </div>
                @endif
            </div>

            <!-- Hoofdinhoud van het evenement -->
            <div class="p-6 md:p-14">
                <div class="flex flex-col lg:flex-row gap-8">

                    <div class="flex-1">
                        <div class="mb-8">
                            @if (isset($event->titel))
                                <h1 class="text-2xl font-bold text-gray-800 mb-5" alt="Evenement titel">{{ $event->titel }}
                                </h1>
                            @endif

                            <!-- Categorie -->
                            @if (isset($event->categorie))
                                <div class="flex items-center text-gray-500 mb-4">
                                    <i class="flex-shrink-0 fa-solid fa-tag text-3xl" alt="Evenement categorie"
                                        aria-hidden="true"></i>
                                    <span class="text-lg font-bold ml-2">{{ $event->categorie }}</span>
                                </div>
                            @endif

                            <!-- Datum & Tijd -->
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="flex-shrink-0 fa-solid fa-calendar text-3xl" alt="Datum en tijd evenement"
                                    aria-hidden="true"></i>
                                <span class="text-lg font-bold ml-2">
                                    {{ $event->datum ?? 'Datum onbekend' }},
                                    {{ $event->starttijd ?? 'Tijd onbekend' }} <br>
                                    {{ $event->einddatum ?? 'Einddatum onbekend' }},
                                    {{ $event->eindtijd ?? 'Eindtijd onbekend' }}
                                </span>
                            </div>

                            <!-- Locatie -->
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="flex-shrink-0 fa-solid fa-location-dot text-3xl" alt="Locatie evenement"
                                    aria-hidden="true"></i>
                                <span class="text-lg font-bold ml-2">{{ $event->locatie ?? 'Locatie onbekend' }}</span>
                            </div>

                            <hr class="my-1 border-2 border-gray-400 rounded">

                            <!-- Beschrijving -->
                            <div>
                                <p alt="Evenement beschrijving">{!! $event->beschrijving ?? 'Geen beschrijving beschikbaar.' !!}</p>
                            </div>
                        </div>

                        <!-- Laatst Bijgewerkt Informatie -->
                        @if ($event->updated_at != $event->created_at)
                            <div class="sm:text-right sm:text-lg text-md text-gray-500">
                                <span>Laatst bijgewerkt op: </span>
                                <span>{{ \Carbon\Carbon::parse($event->updated_at)->format('d-m-Y H:i') }}</span>
                            </div>
                        @else
                            <div class="sm:text-right sm:text-lg text-md text-gray-500">
                                <span>Gemaakt op: </span>
                                <span>{{ \Carbon\Carbon::parse($event->updated_at)->format('d-m-Y H:i') }}</span>
                            </div>
                        @endif
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex-shrink-0 fa-solid fa-users text-3xl" alt="Aantal inschrijvingen evenement"
                                aria-hidden="true"></i>
                            <div class="ml-2">
                                <!-- Totaal aantal plekken -->
                                <div class="text-lg font-bold">
                                    Totaal aantal plekken:
                                    @if ($availableSpots > 0)
                                        {{ $availableSpots }} plekken
                                    @else
                                        Geen plaatsen beschikbaar
                                    @endif
                                </div>

                                <!-- Aantal ingeschreven -->
                                @if (auth()->user() && auth()->user()->is_admin)
                                    <!-- Check if the user is admin -->
                                    <div class="text-lg font-bold">
                                        Aantal ingeschreven: {{ $registeredCount }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
