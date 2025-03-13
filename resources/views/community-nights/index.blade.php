<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <title>Community Nights</title>
</head>
<div class="mx-auto">
    <div class="flex flex-wrap">
        <div class="lg:my-12 p-6 grid sm:grid-cols-2 gap-8 mx-auto">
            @foreach($communityNights as $communityNight)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <a href="{{ route('community-nights.show', $communityNight) }}">
                        <div class="p-6 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                            <h1 class="text-white text-3xl font-bold">{{ $communityNight->title ?? 'Community Night' }}</h1>
                        </div>
                    </a>
                    <div class="p-5">
                        @if(isset($communityNight->cover_image))
                            <a href="{{ route('community-nights.show', $communityNight) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ $communityNight->title }}</h5>
                            </a>
                        @endif
                        <p class="mb-3 font-normal text-gray-700 ">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        <a href="{{ route('community-nights.show', $communityNight) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Read more
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
