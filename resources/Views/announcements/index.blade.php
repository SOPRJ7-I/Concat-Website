<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-green-500 inline-block pb-1 mb-4">
            Overzicht van announcements
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($announcements->isEmpty())
            <p class="text-gray-600">Er zijn nog geen announcements beschikbaar.</p>
        @else
            <ul class="space-y-4">
                @foreach($announcements as $announcement)
                    <li class="border border-gray-300 p-4 rounded-xl shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-lg font-bold text-purple-700">{{ $announcement->titel }}</h2>
                                <p class="text-sm text-gray-500 mb-2">
                                    Gepubliceerd op:
                                    {{ \Carbon\Carbon::parse($announcement->publicatiedatum)->format('d-m-Y H:i') }}
                                </p>
                                <p class="text-gray-700">{{ $announcement->inhoud }}</p>

                                @if($announcement->vervaldatum)
                                    <p class="text-xs text-gray-400 mt-2">Verdwijnt op:
                                        {{ \Carbon\Carbon::parse($announcement->vervaldatum)->format('d-m-Y H:i') }}</p>
                                @endif
                            </div>

                            <div class="flex flex-col space-y-2 items-end">
                                <a href="{{ route('announcements.edit', $announcement->id) }}"
                                    class="text-blue-500 hover:underline">Bewerken</a>

                                <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST"
                                    onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>