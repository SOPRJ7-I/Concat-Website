<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
            Evenementen
        </h1>

        <div class="flex flex-col flex-wrap my-4">
            <div class="grid sm:grid-cols-2 gap-8 lg:gap-6 mx-auto">
                @foreach($evenementen as $evenement)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <a href="{{ route('evenementen.show', $evenement->id) }}">
                            @if(isset($evenement->image))
                                <img src="{{ $evenement->image }}" alt="{{ $evenement->titel }}" class="h-44 w-full object-cover">
                            @else
                                <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                                    <h1 class="text-white text-3xl font-bold">{{ $evenement->titel }}</h1>
                                </div>
                            @endif
                        </a>

                        <div class="p-5">
                            @if(isset($evenement->datum) && isset($evenement->einddatum))
                                <div class="flex items-center text-gray-500 mb-4">
                                    <i class="flex flex-shrink-0 fa-solid fa-calendar fa-fw text-3xl"></i>
                                    <span class="text-lg font-bold">
                                        {{ \Carbon\Carbon::parse($evenement->datum)->format('d-m-Y') }} - 
                                        {{ \Carbon\Carbon::parse($evenement->start_datum)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($evenement->einddatum)->format('d-m-Y') }},
                                        {{ \Carbon\Carbon::parse($evenement->einddatum)->format('H:i') }}
                                    </span>
                                </div>
                            @endif

                            @if(isset($evenement->locatie))
                                <div class="flex items-center text-gray-500 mb-4">
                                    <i class="flex flex-shrink-0 fa-solid fa-location-dot fa-fw text-3xl"></i>
                                    <span class="text-md font-bold">{{ $evenement->locatie }}</span>
                                </div>
                            @endif

                            <div class="mb-4 grow text-gray-700 relative overflow-hidden max-h-32">
                                <p class="mb-3 font-normal text-gray-700 ">{{ \Illuminate\Support\Str::limit(strip_tags($evenement->beschrijving), 150, '...') }}</p>
                                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent to-white"></div>
                            </div>

                            <a href="{{ route('evenementen.show', $evenement->id) }}" class="inline-flex items-center text-sm text-center bg-[#3129FF] text-white py-2 px-4 rounded-lg hover:bg-[#E39FF6] transition font-semibold">
                                Lees meer...
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="pagination-container" class="mt-6 text-center">
                {{ $evenementen->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</x-layout>
