<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1" alt="Formulier voor het toevoegen van een evenement">
            Evenement toevoegen
        </h1>

        <form method="POST" action="{{ url('/events/create') }}" enctype="multipart/form-data" class="mt-4 space-y-4" onsubmit="return validateForm()">
            @csrf

            <div>
                <label for="categorie" class="block text-sm font-semibold">Categorie:*</label>
                <select name="categorie" id="categorie"
                        class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Selecteer een categorie --</option>
                    <option value="blokborrel">Blokborrel</option>
                    <option value="education">Education</option>
                </select>
                @error('categorie')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="afbeelding" class="block text-sm font-semibold">Afbeelding uploaden:</label>
                <input type="file" name="afbeelding" id="afbeelding" accept="image/*"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('afbeelding')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="titel" class="block text-sm font-semibold">Titel:*</label>
                <input type="text" name="titel" id="titel" placeholder="Titel van het evenement"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('titel')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="datum" class="block text-sm font-semibold">Datum:*</label>
                    <input type="date" name="datum" id="datum"
                           class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    @error('datum')
                    <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="einddatum" class="block text-sm font-semibold">Einddatum:*</label>
                    <input type="date" name="einddatum" id="einddatum"
                           class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    @error('einddatum')
                    <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="starttijd" class="block text-sm font-semibold">Starttijd:*</label>
                    <input type="time" name="starttijd" id="starttijd"
                           class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    @error('starttijd')
                    <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="eindtijd" class="block text-sm font-semibold">Eindtijd:*</label>
                    <input type="time" name="eindtijd" id="eindtijd"
                           class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    @error('eindtijd')
                    <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="beschrijving" class="block text-sm font-semibold">Beschrijving:*</label>
                <textarea name="beschrijving" id="beschrijving" placeholder="Beschrijving van het evenement"
                          class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"></textarea>
                @error('beschrijving')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="locatie" class="block text-sm font-semibold">Locatie:*</label>
                <input type="text" name="locatie" id="locatie" placeholder="Locatie van het evenement"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('locatie')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="aantal_beschikbare_plekken" class="block text-sm font-semibold">Aantal plekken:</label>
                <input type="number" name="aantal_beschikbare_plekken" id="aantal_beschikbare_plekken" placeholder="0" min="0"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('aantal_beschikbare_plekken')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="betaal_link" class="block text-sm font-semibold">Betaal link:</label>
                <input type="text" name="betaal_link" id="betaal_link" placeholder="Betaal link van het evenement"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                @error('betaal_link')
                <div class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <input type="submit" value="Toevoegen"
                   class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer" alt="Klik om het evenement toe te voegen">
        </form>
    </div>

    <script>
        function validateForm() {
            const startDate = document.getElementById('datum').value;
            const endDate = document.getElementById('einddatum').value;
            const startTime = document.getElementById('starttijd').value;
            const endTime = document.getElementById('eindtijd').value;

            if (new Date(startDate) > new Date(endDate)) {
                alert('De einddatum moet gelijk of later zijn dan de begindatum.');
                return false;
            }

            if (startDate === endDate && startTime >= endTime) {
                alert('De eindtijd moet later zijn dan de begintijd.');
                return false;
            }

            return true;
        }
    </script>
</x-layout>
