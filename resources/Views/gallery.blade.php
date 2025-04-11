<x-layout>
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Gecentreerde titel -->
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold">Gallerij</h1>
            </div>

            <!-- Sorteerknop links -->
            <div class="mb-6">
                <label for="sorteren" class="block text-sm font-medium text-gray-700 mb-1">Sorteer op:</label>
                <select id="sorteren" name="sorteren"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="datum">Datum</option>
                    <option value="naam">Evenement</option>
                </select>
            </div>

            <!-- De foto-grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($photos as $photo)
                    <div class="bg-white rounded-xl shadow-md p-4 cursor-pointer"
                        onclick="openModal('{{ $photo['title'] }}', '{{ $photo['date'] }}')">
                        <div
                            class="bg-gray-400 h-40 rounded mb-2 flex items-center justify-center text-white text-lg font-semibold">
                            Hier komt de foto
                        </div>
                        <div class="text-sm text-gray-700 font-medium">{{ $photo['title'] }}</div>
                        <div class="text-xs text-gray-500">{{ $photo['date'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="photoModal" onclick="handleBackdropClick(event)" class="fixed inset-0 z-50 hidden items-center justify-center modal-bg p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-7xl w-full relative p-4">
            <button class="absolute top-2 right-4 text-xl font-bold" onclick="closeModal()">x</button>
            <div class="bg-gray-600 h-[30rem] rounded flex items-center justify-center text-white text-2xl font-bold">Hier komt de foto
            </div>
            <div class="flex justify-between mt-4 text-sm text-gray-700">
                <span id="eventName">Evenement naam</span>
                <span id="eventDate">Datum</span>
            </div>
        </div>
    </div>

    <script>
        function openModal(name, date) {
            document.getElementById('eventName').innerText = name;
           document.getElementById('eventDate').innerText = date;
           document.getElementById('photoModal').classList.remove('hidden');
           document.getElementById('photoModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('photoModal').classList.remove('flex');
            document.getElementById('photoModal').classList.add('hidden');
        }

        function handleBackdropClick(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }
    </script>
</x-layout>