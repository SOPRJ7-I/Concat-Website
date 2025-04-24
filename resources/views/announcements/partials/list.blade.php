@foreach($groupedAnnouncements as $group => $announcements)
    <div class="mb-8 ">
        <h2 class="text-xl font-bold text-purple-600 mb-4">{{ $group }}</h2>

        <div class="space-y-6">
            @foreach($announcements as $announcement)
                <div class="bg-gray-100 p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                    <h3 class="text-4xl font-bold text-gray-800">{{ $announcement->titel }}</h3>
                    <div class="text-sm text-gray-500 space-y-1 mb-4 mt-1">
                        {{ $announcement->published_at->translatedFormat('d F Y H:i') }}
                        @if($announcement->updated_at->gt($announcement->created_at))
                            · Geüpdate op: {{ $announcement->updated_at->translatedFormat('d F Y H:i') }}
                        @endif
                    </div>

                    <p class="text-gray-600 mb-4 whitespace-pre-line">{{ $announcement->inhoud }}</p>

                    @auth
                        <div class="text-right">
                            <a href="{{ route('announcements.edit', $announcement) }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                Bewerken
                            </a>
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
@endforeach
