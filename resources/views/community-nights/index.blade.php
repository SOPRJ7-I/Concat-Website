<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <title>Community Nights</title>
</head>
<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
            Community Avonden
        </h1>

        <div class="flex flex-col flex-wrap my-4">
            <div class="grid sm:grid-cols-2 gap-8 lg:gap-6 mx-auto">
                @foreach($communityNights->sortByDesc('created_at') as $communityNight)
                    <div class="max-w bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">


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
                @endforeach
            </div>

            <!-- Paginering -->
            <div id="pagination-container" class="mt-6 text-center">
                {{ $communityNights->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</x-layout>

