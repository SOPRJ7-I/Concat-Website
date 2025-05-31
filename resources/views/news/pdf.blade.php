<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.5;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        .content {
            white-space: pre-line;
            margin-bottom: 40px;
        }

        .image-container {
            text-align: center;
            margin-bottom: 30px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
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