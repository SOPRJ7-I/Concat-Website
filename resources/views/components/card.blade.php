<div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
    <a>
        <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
            <h1 class="text-white text-3xl font-bold">{{ $communityNight->title ?? 'Community Night' }}</h1>
        </div>
    </a>

    <div class="p-5">
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
