<x-layout>
    <div class="container max-w-4xl mx-auto px-4 py-8 bg-white rounded-lg shadow-xl mt-5">
        <div class="flex flex-col items-center mb-8">
            <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full">
                Announcements
            </h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('announcements.create') }}" class="inline-flex items-center bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-green-600 transition mt-4">
                        Nieuwe aankondiging maken
                    </a>
                @endif
            @endauth
        </div>

        <div id="announcements-container">
            @if(count($groupedAnnouncements) > 0)
                @include('announcements.partials.list', ['groupedAnnouncements' => $groupedAnnouncements])
            @else
                <div class="text-center p-8 bg-gray-50 rounded-lg">
                    <p class="text-gray-500 italic">Er zijn momenteel geen aankondigingen</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
