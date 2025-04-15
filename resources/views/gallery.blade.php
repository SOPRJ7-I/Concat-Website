<x-layout>
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Gecentreerde titel -->
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold" id="gallery-title">Gallerij</h1>
            </div>

            <!-- Sorteerknop links -->
            <div class="mb-6">
                <label for="sorteren" class="block text-sm font-medium text-gray-700 mb-1">Sorteer op:</label>
                <select id="sorteren" name="sorteren"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                    aria-labelledby="gallery-title">
                    <option value="datum">Datum</option>
                    <option value="naam">Evenement</option>
                </select>
            </div>

            <!-- De foto-grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" role="list">
                @foreach($photos as $photo)
                    <div role="listitem" class="bg-white rounded-xl shadow-md p-4 cursor-pointer"
                        tabindex="0"
                        role="button"
                        aria-label="Bekijk foto {{ $photo['title'] }} van {{ $photo['date'] }}"
                        onclick="openModal('{{ e($photo['title']) }}', '{{ e($photo['date']) }}', '{{ e($photo['src']) }}')"
                        onkeypress="if(event.key === 'Enter' || event.key === ' ') openModal('{{ e($photo['title']) }}', '{{ e($photo['date']) }}', '{{ e($photo['src']) }}')">
                        <img src="{{ $photo['src'] }}" alt="{{ $photo['title'] }}"
                            class="h-40 w-full object-contain bg-gray-100 rounded mb-2" />
                        <div class="text-sm text-gray-700 font-medium">{{ $photo['title'] }}</div>
                        <div class="text-xs text-gray-500">{{ $photo['date'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="photoModal" role="dialog" aria-modal="true" aria-labelledby="eventName" aria-describedby="eventDate"
         onclick="handleBackdropClick(event)"
         class="fixed inset-0 z-50 hidden items-center justify-center modal-bg p-4"
         aria-hidden="true">
        <div class="bg-white rounded-lg shadow-lg max-w-6xl w-full relative p-4">
            <button class="absolute top-2 right-4 text-xl font-bold"
                    onclick="closeModal()" aria-label="Sluit modal">×</button>
            <img src="" id="modalPhoto" alt=""
                 class="max-h-[80vh] max-w-full w-auto object-contain mx-auto rounded" />
            <div class="flex justify-between mt-4 text-sm text-gray-700">
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

            // Focus op de sluitknop
            modal.querySelector('button').focus();
        }

        function closeModal() {
            modal.setAttribute('aria-hidden', 'true');
            modal.classList.remove('flex');
            modal.classList.add('hidden');

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
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
</x-layout>
