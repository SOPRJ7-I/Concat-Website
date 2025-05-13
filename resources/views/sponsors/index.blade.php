<head>
    <title>Sponsor overzicht</title>
</head>
<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
            Sponsoren
        </h1>

        <div class="flex flex-col flex-wrap my-4">
            <div class="grid sm:grid-cols-2 gap-8 lg:gap-6 mx-auto">
                @foreach($sponsors as $sponsor)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <a href="{{ $sponsor->url }}">
                            @if(isset($sponsor->image_path))
                                <img src="{{ asset('storage/' . $sponsor->image_path) }}" alt="{{ $sponsor->name }}" class="h-44 p-8 w-full object-contain">
                            @else
                            <div class="p-5 sm:h-44 flex items-center justify-center bg-gradient-to-r from-blue-400 to-purple-500">
                                <h1 class="text-white text-3xl font-bold">{{ $sponsor->name ?? 'Community Night' }}</h1>
                            </div>
                            @endif
                        </a>

                        <div class="p-5">
                            @if(isset($sponsor->image_path))
                                <a href="{{ route('sponsors.show', $sponsor) }}">
                                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 mb-4">{{ $sponsor->name }}</h5>
                                </a>
                            @endif


                            <div class="mb-4 grow text-gray-700 relative overflow-hidden">
                                <p class="mb-3 font-normal text-gray-700 ">{!! $sponsor->formattedDescription !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
