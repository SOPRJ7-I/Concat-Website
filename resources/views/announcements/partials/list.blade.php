@foreach($groupedAnnouncements as $group => $announcements)
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="mx-4 text-gray-500 font-medium">{{ $group }}</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>

        <div class="space-y-4">
            @foreach($announcements as $announcement)
                <div class="bg-gray-100 rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-start gap-4 mb-2">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $announcement->titel }}</h2>
                        <div class="text-sm text-gray-500">
                            @if($announcement->publicatiedatum->isToday())
                                Vandaag om {{ $announcement->publicatiedatum->format('H:i') }}
                            @elseif($announcement->publicatiedatum->isYesterday())
                                Gisteren om {{ $announcement->publicatiedatum->format('H:i') }}
                            @elseif($announcement->publicatiedatum->diffInDays(now()) <= 7)
                                {{ $announcement->publicatiedatum->translatedFormat('l') }} om {{ $announcement->publicatiedatum->format('H:i') }}
                            @else
                                {{ $announcement->publicatiedatum->format('d-m-Y') }}
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 whitespace-pre-wrap mt-2">{{ $announcement->inhoud }}</p>
                    @if($announcement->vervaldatum)
                        <p class="text-xs text-gray-400 mt-2">
                            Geldig t/m: {{ $announcement->vervaldatum->format('d-m-Y') }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endforeach
