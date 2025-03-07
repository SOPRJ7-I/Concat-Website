<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement toevoegen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-200 to-blue-300 min-h-screen flex justify-center items-center p-6">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Evenement toevoegen
        </h1>
        <form action="//todo" method="post" class="mt-4 space-y-4">
            @csrf
            <div>
                <label for="naam" class="block text-sm font-semibold">Titel:</label>
                <input type="text" name="naam" id="naam" placeholder="Titel van het evenement"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="datum" class="block text-sm font-semibold">Datum:</label>
                    <input type="date" name="datum" id="datum"
                        class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label for="tijd" class="block text-sm font-semibold">Tijd:</label>
                    <input type="time" name="tijd" id="tijd"
                        class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label for="beschrijving" class="block text-sm font-semibold">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" placeholder="Beschrijving van het evenement"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label for="locatie" class="block text-sm font-semibold">Locatie:</label>
                <input type="text" name="locatie" id="locatie" placeholder="Locatie van het evenement"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="plekken" class="block text-sm font-semibold">Aantal plekken:</label>
                <input type="number" name="plekken" id="plekken" placeholder="0" min="0"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="betaal_link" class="block text-sm font-semibold">Betaal link:</label>
                <input type="text" name="betaal_link" id="betaal_link" placeholder="Betaal link van het evenement"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="categorie" class="block text-sm font-semibold">Categorie:</label>
                <select name="categorie" id="categorie"
                    class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    <option value="1">Evenement</option>
                    <option value="2">Community avond</option>
                </select>
            </div>

            <input type="submit" value="Toevoegen" 
                class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
        </form>

        <a href="{{ route('show_evenement') }}" class="block text-center mt-4 text-sm text-purple-700 hover:underline">
            Terug naar de lijst van evenementen
        </a>


    </div>
</body>
</html>
