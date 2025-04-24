<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1" alt="Formulier voor het toevoegen van een evenement">
            Evenement toevoegen
        </h1>
        <form method="POST" action="{{ url('/create_evenement') }}" enctype="multipart/form-data" class="mt-4 space-y-4" onsubmit="return validateForm()">
            @csrf
            <div>
                <label for="categorie" class="block text-sm font-semibold" alt="Selecteer de categorie van het evenement">*Categorie:</label>
                <select name="categorie" id="categorie" required
                        class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Selecteer een categorie --</option>
                    <option value="blokborrel">Blokborrel</option>
                    <option value="education">Education</option>
                </select>
            </div>

            <div>
                <label for="afbeelding" class="block text-sm font-semibold" alt="Upload een afbeelding voor het evenement">Afbeelding uploaden:</label>
                <input type="file" name="afbeelding" id="afbeelding" accept="image/*"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="titel" class="block text-sm font-semibold" alt="Vul de titel van het evenement in">*Titel:</label>
                <input type="text" name="titel" id="titel" placeholder="Titel van het evenement" required
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="datum" class="block text-sm font-semibold" alt="Kies de datum van het evenement">*Datum:</label>
                <input type="date" name="datum" id="datum" required
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label for="einddatum" class="block text-sm font-semibold" alt="Kies de einddatum van het evenement">*Einddatum:</label>
                <input type="date" name="einddatum" id="einddatum" required
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="starttijd" class="block text-sm font-semibold" alt="Kies de starttijd van het evenement">*Starttijd:</label>
                    <input type="time" name="starttijd" id="starttijd" required
                           class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label for="eindtijd" class="block text-sm font-semibold" alt="Kies de eindtijd van het evenement">*Eindtijd:</label>
                    <input type="time" name="eindtijd" id="eindtijd" required
                           class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label for="beschrijving" class="block text-sm font-semibold" alt="Beschrijf het evenement">*Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" placeholder="Beschrijving van het evenement" required
                          class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label for="locatie" class="block text-sm font-semibold" alt="Vul de locatie van het evenement in">*Locatie:</label>
                <input type="text" name="locatie" id="locatie" placeholder="Locatie van het evenement" required
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="aantal_beschikbare_plekken" class="block text-sm font-semibold" alt="Vul het aantal beschikbare plekken in">Aantal plekken:</label>
                <input type="number" name="aantal_beschikbare_plekken" id="aantal_beschikbare_plekken" placeholder="0"
                       min="0"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="betaal_link" class="block text-sm font-semibold" alt="Vul de betaal link van het evenement in">Betaal link:</label>
                <input type="text" name="betaal_link" id="betaal_link" placeholder="Betaal link van het evenement"
                       class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
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

            // Check if start date is before or the same as end date
            if (new Date(startDate) > new Date(endDate)) {
                alert('De einddatum moet gelijk of later zijn dan de begindatum.');
                return false;
            }

            // Check if start time is before end time
            if (startDate === endDate && startTime >= endTime) {
                alert('De eindtijd moet later zijn dan de begintijd.');
                return false;
            }

            return true;
        }
    </script>
</x-layout>
