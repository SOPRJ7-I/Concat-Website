@Vite('resources/css/app.css')
<x-layout>
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-6 bg-gray-50 p-6 rounded-xl shadow-lg w-full my-5">
            <!-- Gecentreerde titel -->
            <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full mb-5">
                Galerij
            </h1>

            @auth
            @if(auth()->user()->isAdmin())
            <div class="flex justify-end mb-4">
                <a href="{{ route('gallery.create') }}"
                class="inline-flex items-center bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-green-600 transition"
                aria-label="Nieuwe foto toevoegen">
                <i class="fa-solid fa-plus mr-2" aria-hidden="true"></i>Foto toevoegen
                </a>
            </div>
            @endif
            @endauth

            <!-- Sorteerknop links / Filter -->
            <form method="GET" id="filterForm" class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Filter op:</label>
                <select id="type" name="type"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                    aria-labelledby="galery-title" onchange="document.getElementById('filterForm').submit()">
                    <option value="" {{ request('type') == '' ? 'selected' : '' }}>Alle</option>
                    <option value="blokborrel" {{ request('type') == 'blokborrel' ? 'selected' : '' }}>Blokborrel</option>
                    <option value="education" {{ request('type') == 'education' ? 'selected' : '' }}>Education</option>
                </select>
            </form>

            <!-- De foto-grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" role="list">
                @foreach($photos as $photo)
                    <div role="listitem" class="bg-white rounded-xl shadow-md p-4 cursor-pointer" tabindex="0" role="button"
                        aria-label="Bekijk foto {{ $photo['title'] }} van {{ $photo['date'] }}"
                        onclick="openModal('{{ e($photo['title']) }}', '{{ e($photo['date']) }}', '{{ e($photo['src']) }}')"
                        onkeypress="if(event.key === 'Enter' || event.key === ' ') openModal('{{ e($photo['title']) }}', '{{ e($photo['date']) }}', '{{ e($photo['src']) }}')">
                        <img src="{{ $photo['src'] }}" alt="Foto" class="h-40 w-full object-contain bg-gray-100 rounded-lg mb-2" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="photoModal" role="dialog" aria-modal="true" aria-labelledby="eventName" aria-describedby="eventDate"
    onclick="handleBackdropClick(event)"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80"
    aria-hidden="true">
    
    <div class="relative max-w-full max-h-full overflow-hidden">
        <button class="absolute top-4 right-4 text-white text-3xl font-bold z-10" onclick="closeModal()" aria-label="Sluit modal">×</button>
        <img src="" id="modalPhoto" alt="" class="max-h-[80vh] max-w-[90vw] object-contain block m-auto rounded-lg shadow-lg" />
        <div class="flex justify-between mt-4 text-sm text-white px-4">
            <span id="eventName">Evenement naam</span>
            <span id="eventDate">Datum</span>
        </div>
    </div>
</div>

    <script>
        const modal = document.getElementById('photoModal');
        const focusableSelectors = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        let lastFocusedElement = null;

        function openModal(name, date, src) {
            lastFocusedElement = document.activeElement;

            document.getElementById('eventName').innerText = name;
            document.getElementById('eventDate').innerText = date;
            const modalImg = document.getElementById('modalPhoto');
            modalImg.src = src;
            modalImg.alt = `Foto van ${name} op ${date}`;

            modal.setAttribute('aria-hidden', 'false');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Disable menubar
            document.getElementById('main-nav').classList.add('nav-disabled');

            // Focus op de sluitknop
            modal.querySelector('button').focus();
        }

        function closeModal() {
            modal.setAttribute('aria-hidden', 'true');
            modal.classList.remove('flex');
            modal.classList.add('hidden');

            // Herstel menubar
            document.getElementById('main-nav').classList.remove('nav-disabled');

            // Focus terug naar waar we waren
            if (lastFocusedElement) {
                lastFocusedElement.focus();
            }
        }

        function handleBackdropClick(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }

        // Escape key sluit modal
        window.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        document.querySelectorAll('#filterForm select').forEach(select => {
            select.addEventListener('change', () => {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
</x-layout>
