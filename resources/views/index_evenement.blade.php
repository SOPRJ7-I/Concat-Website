<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
            Evenementen
        </h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="flex justify-end my-4" >
                    <a href="{{ url('/create_evenement') }}"
                    class="inline-flex items-center bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-green-600 transition"
                    aria-label="Nieuw evenement toevoegen">
                        <i class="fa-solid fa-plus mr-2" aria-hidden="true"></i> Evenement toevoegen
                    </a>
                </div>
            @endif
        @endauth
        {{-- Filter op categorie --}}
        <form method="GET" action="{{ url('/index_evenement') }}" class="mb-6 flex flex-col sm:flex-row items-center gap-4 justify-center">
            <div>
                <label for="categorie" class="text-sm font-semibold text-gray-700">Filter op categorie:</label>
                <select name="categorie" id="categorie"
                        onchange="this.form.submit()"
                        class="p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"
                        aria-label="Filter evenementen op categorie">
                    <option value="all" {{ $categorieFilter === 'all' ? 'selected' : '' }}>Alle categorieën</option>
                    <option value="blokborrel" {{ $categorieFilter === 'blokborrel' ? 'selected' : '' }}>Blokborrel</option>
                    <option value="education" {{ $categorieFilter === 'education' ? 'selected' : '' }}>Education</option>
                </select>
            </div>
        </form>

        {{-- Evenementenlijst --}}
        <div class="flex flex-col flex-wrap my-4">
            <div class="grid sm:grid-cols-2 gap-8 lg:gap-6 mx-auto">
                @foreach($evenementen as $evenement)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <a href="{{ route('evenementen.show', $evenement->id) }}"
                           aria-label="Details bekijken van {{ $evenement->titel }}">
                            @if(isset($evenement->afbeelding) && isset($evenement->start_datum) && isset($evenement->einddatum) && isset($evenement->locatie))
                                <img src="{{ $evenement->afbeelding }}"
                                     alt="Afbeelding van {{ $evenement->titel }}. Datum: {{ \Carbon\Carbon::parse($evenement->start_datum)->format('d-m-Y') }} tot {{ \Carbon\Carbon::parse($evenement->einddatum)->format('d-m-Y') }} in {{ $evenement->locatie }}"
                                     class="h-44 w-full object-cover">
                            @else
                                <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500" aria-hidden="true">
                                    <h1 class="text-white text-3xl font-bold">{{ $evenement->titel }}</h1>
                                </div>
                            @endif
                        </a>

                        <div class="p-5">
                            {{-- Categorie --}}
                            @if(isset($evenement->categorie))
                                <span class="inline-block mb-2 bg-purple-100 text-purple-700 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst($evenement->categorie) }}
                                </span>
                            @endif

                            {{-- Datum & tijd --}}
                            @if(isset($evenement->start_datum) && isset($evenement->einddatum))
                                <div class="flex items-center text-gray-500 mb-4">
                                    <i class="flex flex-shrink-0 fa-solid fa-calendar fa-fw text-3xl" aria-hidden="true"></i>
                                    <span class="text-lg font-bold ml-2">
                                        {{ \Carbon\Carbon::parse($evenement->start_datum)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($evenement->starttijd)->format('H:i') }},
                                        {{ \Carbon\Carbon::parse($evenement->einddatum)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($evenement->eindtijd)->format('H:i') }}
                                    </span>
                                </div>
                            @endif

                            {{-- Locatie --}}
                            @if(isset($evenement->locatie))
                                <div class="flex items-center text-gray-500 mb-4">
                                    <i class="flex flex-shrink-0 fa-solid fa-location-dot fa-fw text-3xl" aria-hidden="true"></i>
                                    <span class="text-md font-bold ml-2">{{ $evenement->locatie }}</span>
                                </div>
                            @endif

                            {{-- Beschrijving --}}
                            <div class="mb-4 grow text-gray-700 relative overflow-hidden max-h-32">
                                <p class="mb-3 font-normal text-gray-700">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($evenement->beschrijving), 150, '...') }}
                                </p>
                                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent to-white" aria-hidden="true"></div>
                            </div>

                            {{-- Lees meer knop --}}
                            <a href="{{ route('evenementen.show', $evenement->id) }}"
                               class="inline-flex items-center text-sm text-center bg-[#3129FF] text-white py-2 px-4 rounded-lg hover:bg-[#E39FF6] transition font-semibold"
                               aria-label="Lees meer over {{ $evenement->titel }}. Datum van {{ \Carbon\Carbon::parse($evenement->start_datum)->format('d-m-Y') }} tot {{ \Carbon\Carbon::parse($evenement->einddatum)->format('d-m-Y') }} in {{ $evenement->locatie }}">
                                Lees meer over {{ $evenement->titel }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginatie --}}
            <div id="pagination-container" class="mt-6 text-center" role="navigation" aria-label="Paginanavigatie">
                {{ $evenementen->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</x-layout>
