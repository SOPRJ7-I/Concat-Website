@foreach($groupedAnnouncements as $group => $announcements)
    <div class="mb-8">
        <h2 class="text-xl font-bold text-purple-600 mb-4">{{ $group }}</h2>

        <div class="space-y-6">
            @foreach($announcements as $announcement)
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $announcement->titel }}</h3>
                        @auth
                            <div class="flex space-x-2">
                                <a href="{{ route('announcements.edit', $announcement) }}" class="text-purple-600 hover:text-purple-800">✏️</a>
                                <form action="{{ route('announcements.destroy', $announcement) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                                </form>
                            </div>
                        @endauth
                    </div>

                    <p class="text-gray-600 mb-4 whitespace-pre-line">{{ $announcement->inhoud }}</p>

                    <div class="text-sm text-gray-500 space-y-1">
                        <div>
                            📅 Publicatiedatum:
                            {{ $announcement->published_at->translatedFormat('d F Y H:i') }}
                        </div>

                        @if($announcement->updated_at->gt($announcement->created_at))
                            <div>
                                ✏️ Laatst bijgewerkt:
                                {{ $announcement->updated_at->translatedFormat('d F Y H:i') }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
