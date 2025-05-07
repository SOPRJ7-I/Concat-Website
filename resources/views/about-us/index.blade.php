<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5 mx-auto">
        {{-- Over Concat sectie --}}
        <section class="mb-12">
            <h1 class="text-3xl font-bold text-center text-purple-700 mb-4">Over Concat</h1>
            <p class="italic text-gray-800 text-center max-w-3xl mx-auto mb-6">
                concat [kon-ket] (verb) <br>
                “Concatenatie is een standaardoperatie in programmeertalen om twee objecten aan elkaar te verbinden.”
                Wanneer gebruikt na het woord <strong>studievereniging</strong> {Studievereniging Concat} worden studenten met elkaar, bedrijven en docenten verbonden.
            </p>

            <div class="text-gray-700 space-y-4 max-w-3xl mx-auto">
                <p><strong>Voorbeeldzinnen:</strong></p>
                <ol class="list-decimal list-inside space-y-2">
                    <li>“Ik ben een informaticastudent, zit op school en ben op zoek naar gezelligheid, dus dan ga ik naar studievereniging Concat.”</li>
                    <li>Een bedrijf heeft een tekort aan informaticastudenten, als oplossing benaderen ze studievereniging Concat.</li>
                    <li><code class="bg-gray-100 px-2 py-1 rounded text-sm font-mono">SELECT CONCAT(SO, BIM) AS Gezelligheid FROM Avans;</code></li>
                </ol>

                <p>
                    Studievereniging Concat heeft twee hoofddoelen: studenten verbinden en een extensie zijn van de opleiding.
                    Studenten verbinden met elkaar, docenten en het bedrijfsleven. Op deze manier willen wij studenten helpen om een gezellige studietijd te hebben
                    en na de studietijd helemaal voorbereid te zijn voor het bedrijfsleven.
                </p>
            </div>
        </section>

        {{-- Titel Huidig Bestuur --}}
        <h2 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full mb-8">
            Huidig Bestuur
        </h2>

        {{-- Bestuursleden cards --}}
        <div class="grid sm:grid-cols-2 gap-8">
            @foreach ($currentBoard as $member)
                <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden flex flex-col">
                    <img src="{{ $member['photo'] }}" alt="Foto van {{ $member['name'] }}" class="h-48 object-cover w-full">
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800">{{ $member['name'] }}</h3>
                        <p class="text-purple-700 font-semibold mb-3">{{ $member['role'] }}</p>
                        <div class="text-gray-700 grow bio-container" id="bio-{{ $loop->index }}">
                            <p class="bio-short">{{ Str::limit($member['bio'], 100) }}</p>
                            <p class="bio-full hidden">{{ $member['bio'] }}</p>
                            <button class="text-purple-500 mt-2" onclick="toggleBio('{{ $loop->index }}', this)">Lees meer</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Titel Vorige Besturen --}}
        <h2 class="text-xl font-bold border-b-4 border-purple-500 inline-block mt-10 pb-1 text-center w-full mb-8">
            Vorige Besturen
        </h2>

        {{-- Horizontale tijdlijn --}}
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <button onclick="scrollTimeline(-300)" class="px-3 py-1 bg-purple-500 text-white rounded hover:bg-purple-600">&larr;</button>
                <button onclick="scrollTimeline(300)" class="px-3 py-1 bg-purple-500 text-white rounded hover:bg-purple-600">&rarr;</button>
            </div>

            <div id="timeline" class="flex space-x-6 overflow-x-auto pb-4 scroll-smooth">
                @foreach ($previousBoards as $board)
                    <div class="min-w-[200px] bg-white border border-purple-200 p-4 rounded-lg shadow-sm">
                        <h4 class="text-lg font-bold text-purple-700">{{ $board['year'] }}</h4>
                        <p class="text-gray-700 mt-2">Bestuursleden:<br>{{ $board['members'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Bestuurslid worden --}}
        <div class="mt-10 bg-purple-50 p-6 rounded-lg shadow-inner">
            <h3 class="text-xl font-bold text-purple-700 mb-2">Bestuurslid worden?</h3>
            <p class="text-gray-700 mb-4">
                Lijkt het jou leuk om deel uit te maken van het bestuur van SV Concat? Stuur ons een berichtje of spreek iemand van het bestuur aan. Nieuwe ideeën en energie zijn altijd welkom!
            </p>
            <a href="mailto:bestuur@svconcat.nl" class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Neem contact op
            </a>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        function toggleBio(index, button) {
            const bioShort = document.querySelector(`#bio-${index} .bio-short`);
            const bioFull = document.querySelector(`#bio-${index} .bio-full`);

            if (bioFull.classList.contains('hidden')) {
                bioFull.classList.remove('hidden');
                bioShort.classList.add('hidden');
                button.textContent = 'Lees minder';
            } else {
                bioFull.classList.add('hidden');
                bioShort.classList.remove('hidden');
                button.textContent = 'Lees meer';
            }
        }

        function scrollTimeline(offset) {
            const timeline = document.getElementById('timeline');
            timeline.scrollBy({ left: offset, behavior: 'smooth' });
        }
    </script>
</x-layout>
