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
<div class="overlay"></div>

<button id="nav-button" class="hamburger"></button>

<!-- Desktop Navigation -->
<nav id="main-nav" class="sticky">
    <div class="flex horizontal spaced centered">
        <div class="flex space-x-8" id="menu-links">
            <x-nav-link href="/example">Example</x-nav-link>
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
        <x-nav-link href="/example">Example</x-nav-link>
        <x-nav-link href="/over-ons">Over ons</x-nav-link>
        <x-nav-link href="/contact">Contact</x-nav-link>
        <x-nav-link href="/login">Login</x-nav-link>
        <x-nav-link href="/register">Registreren</x-nav-link>
    </div>
</div>

<div id="content">
    {{$slot}}
</div>

<script>
    // Updated JavaScript
    function toggleMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.querySelector('.overlay');
        mobileMenu.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.classList.toggle('menu-active');
    }

    document.getElementById('nav-button').addEventListener('click', toggleMenu);
    document.querySelector('.close-btn').addEventListener('click', toggleMenu);
    document.querySelector('.overlay').addEventListener('click', toggleMenu);

    // Close menu when clicking outside on mobile
    document.addEventListener('click', (event) => {
        const mobileMenu = document.getElementById('mobile-menu');
        const isClickInside = mobileMenu.contains(event.target);
        const isMenuButton = event.target.closest('#nav-button');

        if (!isClickInside && !isMenuButton && mobileMenu.classList.contains('active')) {
            toggleMenu();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.remove('active');
            document.querySelector('.overlay').classList.remove('active');
            document.body.classList.remove('menu-active');
        }
    });
</script>
</body>
</html>
