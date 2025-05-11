<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <title>{{ $event->titel }}</title>
</head>

<x-layout>
    <div class="lg:my-12 max-w-4xl border-2 mx-auto shadow-xl rounded-lg overflow-hidden bg-white">
        
        <!-- Header met afbeelding of titel -->
        <div class="relative bg-gray-200 overflow-hidden">
            @if(isset($event->afbeelding) && $event->afbeelding && Storage::exists($event->afbeelding))
                <div class="lg:h-64">
                    <img src="{{ Storage::url($event->afbeelding) }}" alt="Evenement afbeelding: {{ $event->titel }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="p-6 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                    <h1 class="text-white text-3xl font-bold" alt="Titel van evenement: {{ $event->titel ?? 'Community Night' }}">{{ $event->titel ?? 'Community Night' }}</h1>
                </div>
            @endif
        </div>

        <!-- Hoofdinhoud van het evenement -->
        <div class="p-6 md:p-14 mr-11">
            <div class="flex flex-col lg:flex-row gap-8 mr-11">
                
                <div class="flex-1">
                    @if(session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-md mb-4" alt="Succesmelding inschrijven">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded-md mb-4" alt="Foutmelding inschrijven">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                @if($error == 'The email has already been taken.')
                                    Het e-mailadres is al geregistreerd.
                                @else
                                    {{ $error }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
                    <div class="mb-8">
                        @if(isset($event->titel))
                            <h1 class="text-2xl font-bold text-gray-800 mb-5" alt="Evenement titel">{{ $event->titel }}</h1>
                        @endif

                        <!-- Categorie -->
                        @if(isset($event->categorie))
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="flex-shrink-0 fa-solid fa-tag text-3xl" alt="Evenement categorie" aria-hidden="true"></i>
                                <span class="text-lg font-bold ml-2">{{ $event->categorie }}</span>
                            </div>
                        @endif

                        <!-- Datum & Tijd -->
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex-shrink-0 fa-solid fa-calendar text-3xl" alt="Datum en tijd evenement" aria-hidden="true"></i>
                            <span class="text-lg font-bold ml-2">
                                {{ $event->datum ?? 'Datum onbekend' }}, 
                                {{ $event->starttijd ?? 'Tijd onbekend' }} <br> 
                                {{ $event->einddatum ?? 'Einddatum onbekend' }},
                                {{ $event->eindtijd ?? 'Eindtijd onbekend' }}
                            </span>
                        </div>

                        <!-- Locatie -->
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex-shrink-0 fa-solid fa-location-dot text-3xl" alt="Locatie evenement" aria-hidden="true"></i>
                            <span class="text-lg font-bold ml-2">{{ $event->locatie ?? 'Locatie onbekend' }}</span>
                        </div>

                        <hr class="my-1 border-2 border-gray-400 rounded">

                        <!-- Beschrijving -->
                        <div>
                            <p alt="Evenement beschrijving">{!! $event->beschrijving ?? 'Geen beschrijving beschikbaar.' !!}</p>
                        </div>
                    </div>

                    <!-- Laatst Bijgewerkt Informatie -->
                    @if($event->updated_at != $event->created_at)
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

                    <!-- Button om formulier te openen -->
                    <button id="openFormButton" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full mb-6" alt="Inschrijven voor evenement">
                        Inschrijven
                    </button>
                                    <!-- Foutmelding of Succesbericht -->

                </div>



            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="popupModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <button id="closePopup" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" alt="Sluiten inschrijf popup">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="text-xl font-bold mb-6 text-gray-800" alt="Titel formulier inschrijven">Inschrijven</h3>
            <form action="{{ route('registration') }}" method="POST">
                @csrf
                <input type="hidden" name="evenement_id" value="{{ $event->id }}">

                @auth
                <input type="hidden" name="naam" value="{{ auth()->user()->name }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <p class="text-gray-700 mb-4">
                    Je bent ingelogd als <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})
                </p>
                    @else
                        <div class="mb-6">
                            <label for="naam" class="block text-gray-700" alt="Naam invoerveld">Naam:</label>
                            <input type="text" id="naam" name="naam" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-gray-700" alt="E-mail invoerveld">E-mail:</label>
                            <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    @endauth


                
                <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" alt="Inschrijf knop">
                    Inschrijven
                </button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to toggle the popup visibility
        document.getElementById('openFormButton').addEventListener('click', function() {
            document.getElementById('popupModal').classList.remove('hidden');
        });

        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popupModal').classList.add('hidden');
        });

        // Close modal if user clicks outside the modal
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('popupModal')) {
                document.getElementById('popupModal').classList.add('hidden');
            }
        });
    </script>
</x-layout>
