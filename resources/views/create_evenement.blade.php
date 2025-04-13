<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Evenement toevoegen
        </h1>
        <form method="POST" action="{{ url('/create_evenement') }}" enctype="multipart/form-data"
            class="mt-4 space-y-4">
            @csrf
            <div>
                <label for="afbeelding" class="block text-sm font-semibold">Afbeelding uploaden:</label>
                <input type="file" name="afbeelding" id="afbeelding" accept="image/*"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="titel" class="block text-sm font-semibold">*Titel:</label>
                <input type="text" name="titel" id="titel" placeholder="Titel van het evenement" required
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="datum" class="block text-sm font-semibold">*Datum:</label>
                <input type="date" name="datum" id="datum" required
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="starttijd" class="block text-sm font-semibold">*Starttijd:</label>
                    <input type="time" name="starttijd" id="starttijd" required
                        class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label for="eindtijd" class="block text-sm font-semibold">*Eindtijd:</label>
                    <input type="time" name="eindtijd" id="eindtijd" required
                        class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label for="beschrijving" class="block text-sm font-semibold">*Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" placeholder="Beschrijving van het evenement" required
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label for="locatie" class="block text-sm font-semibold">*Locatie:</label>
                <input type="text" name="locatie" id="locatie" placeholder="Locatie van het evenement" required
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="aantal_beschikbare_plekken" class="block text-sm font-semibold">Aantal plekken:</label>
                <input type="number" name="aantal_beschikbare_plekken" id="aantal_beschikbare_plekken" placeholder="0"
                    min="0"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="betaal_link" class="block text-sm font-semibold">Betaal link:</label>
                <input type="text" name="betaal_link" id="betaal_link" placeholder="Betaal link van het evenement"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <input type="submit" value="Toevoegen"
                class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
        </form>
    </div>
</x-layout>