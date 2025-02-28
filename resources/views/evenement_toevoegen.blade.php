<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement toevoegen</title>
</head>
<body>
    <h1>Evenement toevoegen</h1>
    <form action="/evenement_toevoegen" method="post">
        @csrf
        <label for="naam">Titel:</label>
        <input type="text" name="naam" id="naam" placeholder="Titel van het evenement">
        <label for="datum">Datum:</label>
        <input type="date" name="datum" id="datum">
        <label for="tijd">Tijd:</label>
        <input type="time" name="tijd" id="tijd">
        <label for="beschrijving">Beschrijving:</label>
        <textarea name="beschrijving" id="beschrijving" placeholder="Beschrijving van het evenement"></textarea>
        <label for="locatie">Locatie:</label>
        <input type="text" name="locatie" id="locatie" placeholder="Locatie van het evenement">
        <label for="plekken">Aantal plekken:</label>
        <input type="number" name="plekken" id="plekken" placeholder="0" min=0>
        <label for="betaal_link">Betaal link:</label>
        <input type="text" name="betaal_link" id="betaal_link" placeholder="Betaal link van het evenement">
        <label for="categorie">Categorie:</label>
        <select name="categorie" id="categorie">
            <option value="1">Evenement</option>
            <option value="2">Community avond</option>
        </select>
        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>