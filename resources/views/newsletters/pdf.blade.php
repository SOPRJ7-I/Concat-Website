<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    @Vite('resources/css/app.css')
</head>

<body>
    <h1>{{ $title }}</h1>

    <div class="content">{!! $content !!}</div>

    {{-- Afbeeldingen tonen --}}
    @if(!empty($images))
        @foreach ($images as $image)
            <div class="image-container">
                <img src="{{ $image }}" alt="Afbeelding nieuwsbrief">
            </div>
        @endforeach
    @endif
</body>

</html>