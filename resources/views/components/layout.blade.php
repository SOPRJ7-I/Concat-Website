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
        <nav id="main-nav" class="sticky">
            <button class="hamburger">☰</button>
            <div class="flex horizontal spaced centered">
                <div class="flex space-x-8" id="menu-links">
                    <button class="close-btn">✕</button>
                    <x-nav-link href="/sponsors">Sponsoren</x-nav-link>
                    <x-nav-link href="/over-ons">Over ons</x-nav-link>
                    <x-nav-link href="/contact">Contact</x-nav-link>
                    <x-nav-link href="/login">Login</x-nav-link>
                    <x-nav-link href="/register">Registreren</x-nav-link>
                </div>
            </div>
        </nav>
    <div id="content">
        {{$slot}}
    </div>
    <script>
        function toggleMenu() {
            const menuLinks = document.getElementById('menu-links');
            const overlay = document.querySelector('.overlay');
            menuLinks.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.classList.toggle('menu-active');
        }

        document.querySelector('.hamburger').addEventListener('click', toggleMenu);
        document.querySelector('.close-btn').addEventListener('click', toggleMenu);
        document.querySelector('.overlay').addEventListener('click', toggleMenu);

        // Close menu when clicking outside on desktop
        document.addEventListener('click', (event) => {
            const menuLinks = document.getElementById('menu-links');
            const isClickInside = menuLinks.contains(event.target);
            const isHamburger = event.target.closest('.hamburger');

            if (!isClickInside && !isHamburger && menuLinks.classList.contains('active')) {
                toggleMenu();
            }
        });

        // Optional: Close menu when resizing to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                const menuLinks = document.getElementById('menu-links');
                menuLinks.classList.remove('active');
                document.querySelector('.overlay').classList.remove('active');
                document.body.classList.remove('menu-active');
            }
        });    </script>
</body>
</html>
