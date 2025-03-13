<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav id="main-nav" class="sticky">
        <div class="flex horizontal spaced centered">
            <div class="flex space-x-8">
                <x-nav-link href="/blog">Blog</x-nav-link>
                <x-nav-link href="/sponsors">Sponsoren</x-nav-link>
                <x-nav-link href="/over-ons">Over ons</x-nav-link>
                <x-nav-link href="/contact">Contact</x-nav-link>
            </div>
        </div>
    </nav>

    {{$slot}}
</body>
</html>
