<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example Page</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
<div class="overlay"></div>

<button id="nav-button" class="hamburger"></button>

<!-- Desktop Navigation -->
<nav id="main-nav" class="sticky">
    <div class="flex horizontal spaced centered">
        <div class="flex space-x-8" id="menu-links">
            <x-nav-link href="/create_evenement">Evenementen</x-nav-link>
            <x-nav-link href="/over-ons">Over ons</x-nav-link>
            <x-nav-link href="/contact">Contact</x-nav-link>
            <x-nav-link href="/login">Login</x-nav-link>
            <x-nav-link href="/register">Registreren</x-nav-link>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu">
    <div id="menu-links-mobile">
        <button class="close-btn">✕</button>
        <x-nav-link href="/create_evenement">Evenementen</x-nav-link>
        <x-nav-link href="/over-ons">Over ons</x-nav-link>
        <x-nav-link href="/contact">Contact</x-nav-link>
        <x-nav-link href="/login">Login</x-nav-link>
        <x-nav-link href="/register">Registreren</x-nav-link>
    </div>
</div>

<div class="bg-gradient-to-r min-h-screen flex justify-center items-center p-6">
    {{$slot}}
</div>
</body>
</html>
