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

@foreach($communityNights as $community)
    <div class="bg-purple-600 p-4 rounded-lg shadow-md mb-4 text-white">

        <p class="text-xl font-bold mb-2">{{ $community->title }}</p>


        @if($community->image)
            <img src="{{ asset('storage/' . $community->image) }}" alt="Event afbeelding" class="w-full max-w-xs rounded-lg mb-2">
        @endif

        @if($community->description)
            <p class="text-sm mb-2">{{ $community->description }}</p>
        @endif

        @if($community->start_time && $community->end_time)
            <p class="text-sm">
                <span class="font-semibold">Tijd:</span>
                {{ \Carbon\Carbon::parse($community->start_time)->format('d M Y H:i') }} - 
                {{ \Carbon\Carbon::parse($community->end_time)->format('H:i') }}
            </p>
        @endif

        @if($community->location)
            <p class="text-sm">
                <span class="font-semibold">Locatie:</span> {{ $community->location }}
            </p>
        @endif

        @if($community->link)
            <a href="{{ $community->link }}" target="_blank" class="text-sm text-blue-300 hover:text-blue-100">
                Bezoek de eventpagina
            </a>
        @endif
    </div>
@endforeach

</body>
</html>

