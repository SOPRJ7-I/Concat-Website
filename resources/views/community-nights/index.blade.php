<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <title>Community Nights</title>
</head>
<div class="mx-auto">
    <div class="flex flex-wrap">
        <div class="lg:my-12 p-6 grid sm:grid-cols-2 gap-8 lg:gap-20 mx-auto">
            @foreach($communityNights as $communityNight)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden transform transition-transform hover:-translate-y-4">


                    <a href="{{ route('community-nights.show', $communityNight) }}">
                        <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                            <h1 class="text-white text-3xl font-bold">{{ $communityNight->title ?? 'Community Night' }}</h1>
                        </div>
                    </a>

                    <div class="p-5">
                        @if("1")
                            <a href="{{ route('community-nights.show', $communityNight) }}">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">{{ $communityNight->title }}</h5>
                            </a>
                            <!--- <hr class="mb-4 border-2 border-gray-400 rounded"> -->
                        @endif
                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-solid fa-calendar fa-fw text-3xl"></i>
                            <span class="text-lg font-bold">{{ $communityNight->date }}, {{ $communityNight->start_time }} - {{ $communityNight->end_time }}</span>
                        </div>

                        <div class="flex items-center text-gray-500 mb-4">
                            <i class="flex flex-shrink-0 fa-solid fa-location-dot fa-fw text-3xl"></i>
                            <span class="text-md font-bold">{{ $communityNight->location ?? 'Locatie TBD' }}</span>
                        </div>

                        <div class="mb-4 grow text-gray-700 relative overflow-hidden max-h-32">
                            <p class="mb-3 font-normal text-gray-700 ">{{ $communityNight->description }}</p>
                            <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent to-white"></div>
                        </div>

                        <a href="{{ route('community-nights.show', $communityNight) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Meer lezen
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
