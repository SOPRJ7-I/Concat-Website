<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  
</head>
<body style="background-color:rgb(236 235 255)">

<nav>
  <a href="/CreateCommunityNight">Create</a>
  <a href="/ReadCommunityNight">Reade</a>
</nav>


<form class="max-w-lg mx-auto bg-purple-100 p-6 rounded-lg shadow-md space-y-4" method="POST" action="/ReadCommunityNight" enctype="multipart/form-data">
  
  @csrf

    <h2 class="text-center text-xl font-bold mb-4 text-purple-700">Community avond toevoegen</h2>
    
    <div>
        <label for="title" class="block text-sm font-semibold">Titel:</label>
        <input type="text" name="title" id="title" placeholder="Titel van het evenement"
            class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
            
            @error('title')
              <div class="text-red-500 text-sm mt-1 font-bold">{{$message}}</div>
            @enderror
    </div>
    
    <div>
        <label for="image" class="block text-sm font-semibold">Afbeelding (optioneel):</label>
        <input type="file" name="image" id="image"
            class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
    </div>
    
    <div>
        <label for="description" class="block text-sm font-semibold">Beschrijving:</label>
        <textarea name="description" id="description" placeholder="Beschrijving van het evenement"
            class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500"></textarea>
    </div>
    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="start_time" class="block text-sm font-semibold">Starttijd:</label>
            <input type="datetime-local" name="start_time" id="start_time"
                class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500" >
        </div>
        <div>
            <label for="end_time" class="block text-sm font-semibold">Eindtijd:</label>
            <input type="datetime-local" name="end_time" id="end_time"
                class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
        </div>
    </div>
    
    <div>
        <label for="location" class="block text-sm font-semibold">Locatie:</label>
        <input type="text" name="location" id="location" placeholder="Locatie van het evenement"
            class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
    </div>
    
    <div>
        <label for="link" class="block text-sm font-semibold">Event Link:</label>
        <input type="url" name="link" id="link" placeholder="Link naar het evenement"
            class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
    </div>
    
    <div>
        <label for="capacity" class="block text-sm font-semibold">Capaciteit:</label>
        <input type="number" name="capacity" id="capacity" placeholder="0" min="0"
            class="w-full p-2 bg-purple-100 text-purple-700 rounded-lg outline-none border border-purple-300 focus:ring-2 focus:ring-purple-500">
    </div>
    
    
    <input type="submit" value="Toevoegen" 
        class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer mt-4">
</form>
</html>

