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
            @if(isset($event->afbeelding) && $event->afbeelding && Storage::exists($event->afbeelding))
                <div class="lg:h-64">
                    <img src="{{ Storage::url($event->afbeelding) }}" alt="{{ $event->titel }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="p-6 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                    <h1 class="text-white text-3xl font-bold">{{ $event->titel ?? 'Community Night' }}</h1>
                </div>
            @endif
        </div>
    
        <!-- Content -->
        <div class="p-6 md:p-14 mr-11">
            <div class="flex flex-col lg:flex-row gap-8 mr-11">
                <!-- Event Info -->
                <div class="flex-1">
                    <div class="mb-8">
                        @if(isset($event->titel))
                            <h1 class="text-2xl font-bold text-gray-800 mb-5">{{ $event->titel ?? 'TITEL' }}</h1>
                        @endif

                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-fw fa-solid fa-calendar text-3xl"></i>
                            <span class="text-lg font-bold">{{ $event->datum }}, {{ $event->starttijd }} <br> {{ $event->einddatum }}, {{ $event->eindtijd }}</span>
                        </div>

                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-fw fa-solid fa-location-dot text-3xl"></i>
                            <span class="text-lg font-bold">{{ $event->locatie ?? 'Locatie TBD' }}</span>
                        </div>

                        <hr class="my-1 border-2 border-gray-400 rounded">

                        <div class="sm:text-right sm:text-lg text-md text-gray-500">
                            Laatst bijgewerkt op: 
                            {{ $event->updated_at != $event->created_at 
                                ? \Carbon\Carbon::parse($event->updated_at)->format('d-m-Y H:i') 
                                : \Carbon\Carbon::parse($event->created_at)->format('d-m-Y H:i') }}
                        </div>
                    </div>

                        <p>{!! $event->beschrijving ?? 'No description available.' !!}</p>
                    </div>
                </div>

                    <!-- Button to trigger popup form -->
                    <button id="openFormButton" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full mb-6">
                        Inschrijven
                    </button>
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="popupModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <button id="closePopup" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="text-xl font-bold mb-6 text-gray-800">Inschrijven</h3>
            <form action="{{ route('registration') }}" method="POST">
                @csrf
                <input type="hidden" name="evenement_id" value="{{ $event->id }}">

                <div class="mb-6">
                    <label for="naam" class="block text-gray-700">Naam:</label>
                    <input type="text" id="naam" name="naam" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-gray-700">E-mail:</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
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
