<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Emanuel Films')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        :root {
            --accent: #FF4C4C;
            --bg-light: #fafafa;
            --text-dark: #111;
            --header-bg: rgba(255, 255, 255, .98);
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--text-dark);
            background: var(--bg-light);
            position: relative;
        }

        /* Responsive Header */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 8px 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--header-bg);
            border-bottom: 1px solid rgba(0, 0, 0, .05);
            height: 80px;
        }

        .logo-container {
            height: 100%;
            display: flex;
            align-items: center;
            overflow: visible;
        }

        header .logo {
            height: 70px;
            transform: scale(2.8);
            transform-origin: left center;
            transition: transform 0.3s ease;
        }

        nav {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        nav a {
            color: var(--text-dark);
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }

        nav a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0;
            height: 3px;
            background: var(--accent);
            transition: .25s;
        }

        nav a:hover::after, nav a.active::after {
            width: 100%;
        }

        /* Mobile Menu Button */
        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            z-index: 110;
        }

        .menu-toggle span {
            width: 30px;
            height: 3px;
            background: var(--text-dark);
            border-radius: 3px;
            transition: 0.3s;
        }

        /* Main Content */
        main {
            flex: 1;
        }

        /* Footer */
        footer {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 40px 20px;
            background: #fff;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            font-size: 1rem;
            color: var(--text-dark);
        }

        /* Lightbox Styles */
        #lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            cursor: pointer;
        }

        #lightbox img {
            max-width: 90%;
            max-height: 90%;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            user-select: none;
            -webkit-user-drag: none;
        }

        #lightbox.active {
            display: flex;
        }

        .close-lightbox {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .close-lightbox:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Mobile Adjustments */
        @media(max-width: 992px) {
            header .logo {
                transform: scale(1.6);
            }
        }

        @media(max-width: 768px) {
            header {
                padding: 8px 20px;
            }

            header .logo {
                transform: scale(1.4);
            }

            .menu-toggle {
                display: flex;
            }

            nav {
                position: fixed;
                top: 0;
                right: -100%;
                width: 70%;
                height: 100vh;
                background: #fff;
                flex-direction: column;
                justify-content: center;
                gap: 40px;
                transition: 0.4s ease-in-out;
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
            }

            nav.active {
                right: 0;
            }

            nav a {
                font-size: 1.5rem;
            }

            .menu-toggle.active span:nth-child(1) {
                transform: rotate(45deg) translate(6px, 6px);
            }

            .menu-toggle.active span:nth-child(2) {
                opacity: 0;
            }

            .menu-toggle.active span:nth-child(3) {
                transform: rotate(-45deg) translate(7px, -7px);
            }
        }

        @media(max-width: 480px) {
             header .logo {
                transform: scale(1.1);
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <header>
        <div class="logo-container">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo/logoema.webp') }}" alt="Emanuel Films Logo" class="logo">
            </a>
        </div>
        
        <div class="menu-toggle" id="mobile-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav id="nav-menu">
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Inicio</a>
            <a href="{{ url('/servicios') }}" class="{{ Request::is('servicios') ? 'active' : '' }}">Servicios</a>
            <a href="{{ url('/proyectos') }}" class="{{ Request::is('proyectos') ? 'active' : '' }}">Proyectos</a>
            <a href="{{ url('/contacto') }}" class="{{ Request::is('contacto') ? 'active' : '' }}">Contacto</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Emanuel Films. Todos los derechos reservados.
    </footer>

    <!-- Lightbox Modal -->
    <div id="lightbox">
        <span class="close-lightbox">Cerrar</span>
        <img src="" alt="Expanded Image">
    </div>

    <script>
        // Mobile Menu Logic
        const menuToggle = document.getElementById('mobile-menu');
        const navMenu = document.getElementById('nav-menu');

        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking a link
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Lightbox Logic
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = lightbox.querySelector('img');
        const closeLightbox = document.querySelector('.close-lightbox');

        function openLightbox(src) {
            lightboxImg.src = src;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; 
        }

        function closeLightboxModal() {
            lightbox.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        }

        closeLightbox.addEventListener('click', closeLightboxModal);

        lightbox.addEventListener('click', (e) => {
            if (e.target !== lightboxImg) {
                closeLightboxModal();
            }
        });

        // Add event listeners to all expandable images
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('expandable')) {
                openLightbox(e.target.src);
            }
        });
    </script>
    @yield('scripts')
</body>

</html>
