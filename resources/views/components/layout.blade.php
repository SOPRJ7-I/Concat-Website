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
<body class="flex flex-col min-h-screen">
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

<div id="content" class="flex-1">
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

<footer class="bg-gray-900 text-white pt-4 pb-3 text-center mt-auto">
    <div class="container mx-auto px-4">
        <!-- Flex container for responsiveness -->
        <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
            <!-- Social Media Links -->
            <div class="flex space-x-6">
                <a href="https://www.instagram.com/svconcat" target="_blank" aria-label="Instagram" class="hover:text-gray-400">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM12 5.5a6.5 6.5 0 110 13 6.5 6.5 0 010-13zm0 10.5a4 4 0 100-8 4 4 0 000 8zm5-10.2a1.2 1.2 0 112.4 0 1.2 1.2 0 01-2.4 0z"/>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/company/sv-concat" target="_blank" aria-label="LinkedIn" class="hover:text-gray-400">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20.5 3h-17A1.5 1.5 0 002 4.5v15A1.5 1.5 0 003.5 21h17a1.5 1.5 0 001.5-1.5v-15A1.5 1.5 0 0020.5 3zM8 18H5V9h3v9zM6.5 7.5A1.5 1.5 0 116.5 4a1.5 1.5 0 010 3.5zM19 18h-3v-4.5c0-1.1 0-2.5-1.5-2.5S13 12.4 13 13.5V18h-3V9h3v1.2c.5-.8 1.4-1.2 2.5-1.2 2.5 0 3.5 1.6 3.5 4V18z"/>
                    </svg>
                </a>
                <a href="https://discord.gg/AMYt823VPJ" target="_blank" aria-label="Discord" class="hover:text-gray-400">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20.317 4.369a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.078.037c-.212.375-.455.864-.623 1.25a18.858 18.858 0 00-5.654 0c-.17-.396-.417-.875-.63-1.25a.077.077 0 00-.078-.037 19.736 19.736 0 00-4.885 1.515.07.07 0 00-.032.027C1.07 9.042-.3 13.561.022 18.032a.08.08 0 00.031.056 19.856 19.856 0 005.993 3.036.077.077 0 00.084-.028c.462-.631.873-1.295 1.226-1.98a.076.076 0 00-.041-.104 13.277 13.277 0 01-1.885-.902.077.077 0 01-.008-.127c.126-.094.251-.193.371-.296a.074.074 0 01.077-.01c3.967 1.813 8.27 1.813 12.206 0a.075.075 0 01.078.009c.12.103.245.202.372.297a.077.077 0 01-.007.126 13.207 13.207 0 01-1.886.902.076.076 0 00-.04.105c.354.685.765 1.35 1.226 1.98a.077.077 0 00.084.028 19.841 19.841 0 005.994-3.036.077.077 0 00.031-.056c.423-6.002-1.047-10.52-4.69-13.636a.062.062 0 00-.031-.027zM8.02 15.674c-1.182 0-2.157-1.086-2.157-2.418 0-1.331.946-2.418 2.157-2.418 1.224 0 2.158 1.099 2.157 2.418 0 1.332-.946 2.418-2.157 2.418zm7.962 0c-1.182 0-2.157-1.086-2.157-2.418 0-1.331.946-2.418 2.157-2.418 1.224 0 2.158 1.099 2.157 2.418 0 1.332-.946 2.418-2.157 2.418z"/>
                    </svg>
                </a>
            </div>

            <!-- Privacy & Contact Links -->
            <div class="text-sm flex flex-col md:flex-row md:space-x-6">
                <a href="/privacyverklaring" class="hover:text-gray-400">Privacyverklaring</a>
                <span class="hidden md:inline">|</span>
                <a href="mailto:info@svconcat.nl" class="hover:text-gray-400">info@svconcat.nl</a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>
