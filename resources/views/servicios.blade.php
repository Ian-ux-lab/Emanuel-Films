@extends('layouts.app')

@section('title', 'Servicios - Emanuel Films')

@section('styles')
    <style>
        main {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 1.2rem;
            color: #666;
        }

        .service {
            margin-bottom: 60px;
        }

        /* Grid de Servicios */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 80px;
        }

        .service-card {
            position: relative;
            height: 400px;
            border-radius: 25px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }

        .service-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s, opacity 0.5s ease;
            opacity: 0;
        }

        .service-card img.loaded {
            opacity: 1;
        }

        .service-card:hover img {
            transform: scale(1.1);
        }

        .service-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 30px;
            color: #fff;
        }

        .service-card h2 {
            font-size: 2rem;
            margin-bottom: 5px;
            border-left: 4px solid var(--accent);
            padding-left: 15px;
            color: #fff;
            cursor: pointer;
            transition: none;
            display: block;
        }

        .service-card p {
            font-size: 1rem;
            opacity: 0.9;
            color: #eee;
        }

        .service-card .btn-view {
            margin-top: 15px;
            align-self: flex-start;
            padding: 8px 20px;
            background: var(--accent);
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Contenedor del Modal de Referencias */
        .refs-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 1500;
            display: none;
            flex-direction: column;
            align-items: center;
            padding: 60px 20px;
            overflow-y: auto;
        }

        .refs-modal.active {
            display: flex;
        }

        .refs-header {
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            color: #fff;
        }

        .refs-title {
            font-size: 2.5rem;
            font-weight: 700;
            border-left: 6px solid var(--accent);
            padding-left: 20px;
        }

        .refs-close {
            background: none;
            border: none;
            color: #fff;
            font-size: 3rem;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .refs-close:hover { transform: scale(1.1); }

        .refs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            width: 100%;
            max-width: 1000px;
        }

        .refs-grid img {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 15px;
            cursor: pointer;
            transition: transform 0.3s ease, opacity 0.4s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            opacity: 0;
        }

        .refs-grid img.loaded {
            opacity: 1;
        }

        .refs-grid img:hover {
            transform: scale(1.03);
        }

        .carousel-container {
            overflow: hidden;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            gap: 20px;
            will-change: transform;
        }

        .carousel-track img {
            width: calc(33.333% - 14px);
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 20px;
            flex-shrink: 0;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .carousel-track img:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: var(--text-dark);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-btn:hover {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 8px 20px rgba(255, 76, 76, 0.3);
        }

        .prev { left: -25px; }
        .next { right: -25px; }

        /* Video Grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        @media(max-width: 992px) {
            .carousel-track img {
                width: calc(50% - 10px);
            }
            .prev { left: 5px; }
            .next { right: 5px; }
        }

        @media(max-width: 600px) {
            .carousel-track img {
                width: calc(100% - 10px);
            }
            .service h2 {
                font-size: 1.8rem;
            }
            .video-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="section-title">
        <h1>Servicios</h1>
        <p>Explora nuestro trabajo en diferentes áreas audiovisuales</p>
    </div>

    @php
        $services = [
            'bodas' => [
                'title' => 'Bodas',
                'desc' => 'Capturando momentos inolvidables de tu gran día.',
                'cover' => 'img/bodas/DSC02479.webp'
            ],
            'sesiones' => [
                'title' => 'Sesiones',
                'desc' => 'Fotografía profesional en estudio o exteriores.',
                'cover' => 'img/sesiones/DSC01202.webp'
            ],
            'eventos' => [
                'title' => 'Eventos',
                'desc' => 'Cobertura completa de eventos sociales y corporativos.',
                'cover' => 'img/eventos/DSC01963.webp'
            ],
            'marketing' => [
                'title' => 'Marketing',
                'desc' => 'Contenido visual estratégico para tu marca o negocio.',
                'cover' => 'img/MARKETING/31.webp'
            ],
            'quince' => [
                'title' => '15 Años',
                'desc' => 'Celebra tu momento más especial con estilo.',
                'cover' => 'img/15s/DSC01514.webp'
            ],
            'videos' => [
                'title' => 'Videos',
                'desc' => 'Producciones audiovisuales de alta calidad.',
                'cover' => 'img/logo/cam.jpg'
            ]
        ];
    @endphp

    <div class="services-grid">
        @foreach($services as $id => $data)
            <article class="service-card" onclick="openRefsModal('{{ $id }}', '{{ $data['title'] }}')">
                <img src="{{ asset($data['cover']) }}" alt="{{ $data['title'] }}" loading="lazy" decoding="async">
                <div class="service-overlay">
                    <h2>{{ $data['title'] }}</h2>
                    <p>{{ $data['desc'] }}</p>
                    <div class="btn-view">Ver Galería</div>
                </div>

                {{-- 
                    DOCUMENTACIÓN - CARRUSEL:
                    Este bloque contenía el carrusel de imágenes para {{ $data['title'] }}.
                    Se mantiene aquí comentado por requisitos técnicos.
                    <div class="carousel-wrapper">
                        <button class="carousel-btn prev" onclick="moveCarousel('{{ $id }}', -1)">&#10094;</button>
                        <div class="carousel-container">
                            <div class="carousel-track" id="{{ $id }}">
                                <img src="{{ asset('img/0.jpg') }}" class="expandable">
                                <img src="{{ asset('img/1.jpg') }}" class="expandable">
                                <img src="{{ asset('img/2.jpg') }}" class="expandable">
                                <img src="{{ asset('img/3.jpg') }}" class="expandable">
                                <img src="{{ asset('img/4.JPG') }}" class="expandable">
                                <img src="{{ asset('img/5.jpg') }}" class="expandable">
                            </div>
                        </div>
                        <button class="carousel-btn next" onclick="moveCarousel('{{ $id }}', 1)">&#10095;</button>
                    </div>
                --}}
            </article>
        @endforeach
    </div>

    <!-- Modal de Referencias -->
    <div id="refsModal" class="refs-modal">
        <div class="refs-header">
            <div class="refs-title" id="refsModalTitle">Título</div>
            <button class="refs-close" onclick="closeRefsModal()">&times;</button>
        </div>
        <div class="refs-grid" id="refsModalGrid">
            <!-- Las imágenes o videos se cargarán dinámicamente aquí -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        /**
         * DOCUMENTACIÓN - CARRUSEL:
         * positions: Objeto que rastrea el índice actual de desplazamiento para cada categoría.
         */
        const positions = {
            bodas: 0,
            sesiones: 0,
            eventos: 0,
            marketing: 0,
            quince: 0
        };

        /**
         * DOCUMENTACIÓN - CARRUSEL:
         * moveCarousel: Calcula el desplazamiento (translateX) basado en el ancho de las imágenes y el gap.
         * @param {string} id - ID del track del carrusel.
         * @param {number} direction - 1 para avanzar, -1 para retroceder.
         */
        function moveCarousel(id, direction) {
            const track = document.getElementById(id);
            if (!track) return; // Por si el carrusel está comentado
            
            const container = track.parentElement;
            const img = track.children[0];
            const gap = 20;
            const imgWidth = img.offsetWidth + gap;
            
            const visibleWidth = container.offsetWidth;
            const totalWidth = track.scrollWidth;
            const maxScroll = totalWidth - visibleWidth;
            const itemsVisible = Math.round(visibleWidth / imgWidth);
            
            positions[id] += direction;
            
            const maxPosition = track.children.length - itemsVisible;
            
            if (positions[id] < 0) positions[id] = 0;
            if (positions[id] > maxPosition) positions[id] = maxPosition;
            
            const offset = positions[id] * imgWidth;
            track.style.transform = `translateX(${-offset}px)`;
        }

        // LÓGICA DEL NUEVO MODAL DE REFERENCIAS
        const refsModal = document.getElementById('refsModal');
        const refsTitle = document.getElementById('refsModalTitle');
        const refsGrid = document.getElementById('refsModalGrid');

        // Mapeo de contenido por servicio
        const serviceMedia = {
            bodas: [
                'bodas/DSC02479.webp', 'bodas/DSC02502.webp', 'bodas/DSC02599.webp',
                'bodas/DSC02668.webp', 'bodas/DSC02764.webp', 'bodas/DSC08481.webp',
                'bodas/DSC08850.webp', 'bodas/DSC08895.webp', 'bodas/DSC09484.webp',
                'bodas/DSC09489.webp'
            ],
            sesiones: [
                'sesiones/DSC01202.webp', 'sesiones/DSC01306.webp', 'sesiones/DSC09613.webp',
                'sesiones/DSC09630.webp', 'sesiones/DSC09720-Mejorado-NR.webp', 'sesiones/DSC09721.webp',
                'sesiones/DSC09749.webp', 'sesiones/DSC09771.webp'
            ],
            eventos: [
                'eventos/DSC01963.webp', 'eventos/DSC02151.webp', 'eventos/DSC02152.webp',
                'eventos/DSC03574.webp', 'eventos/DSC03691.webp', 'eventos/DSC08694.webp',
                'eventos/DSC08698.webp', 'eventos/DSC09371.webp', 'eventos/DSC09475.webp'
            ],
            marketing: [
                'marketing/31.webp', 'marketing/33.webp', 'marketing/DSC02126.webp',
                'marketing/DSC02134.webp', 'marketing/DSC06156.webp', 'marketing/DSC06163.webp',
                'marketing/DSC06166.webp', 'marketing/DSC09473.webp', 'marketing/DSC09498.webp'
            ],
            quince: [
                '15s/DSC01514.webp', '15s/DSC01567.webp', '15s/DSC03099.webp',
                '15s/DSC03128.webp', '15s/DSC09505.webp', '15s/DSC09512.webp',
                '15s/DSC09763.webp'
            ],
            videos: [
                'https://www.youtube.com/embed/sCZR7gaWikE',
                'https://www.youtube.com/embed/sU1wHQS5wKY',
                'https://www.youtube.com/embed/mfvqeq04vvY'
            ]
        };

        function openRefsModal(id, title) {
            refsTitle.textContent = title;
            refsGrid.innerHTML = ''; // Limpiar grid

            const media = serviceMedia[id] || [];
            
            if (id === 'videos') {
                // Lógica para embeber videos
                media.forEach(videoUrl => {
                    const videoContainer = document.createElement('div');
                    videoContainer.className = 'video-container';
                    videoContainer.style.paddingBottom = '56.25%';
                    videoContainer.style.position = 'relative';
                    videoContainer.style.height = '0';
                    videoContainer.style.borderRadius = '15px';
                    videoContainer.style.overflow = 'hidden';
                    videoContainer.style.backgroundColor = '#000'; // Black background for contain mode

                    const iframe = document.createElement('iframe');
                    iframe.src = videoUrl;
                    iframe.style.position = 'absolute';
                    iframe.style.top = '0';
                    iframe.style.left = '0';
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                    iframe.style.border = '0';
                    iframe.style.objectFit = 'contain'; // Prevent distortion
                    iframe.allowFullscreen = true;

                    videoContainer.appendChild(iframe);
                    refsGrid.appendChild(videoContainer);
                });
                // Ajustar grid para videos (más anchos)
                refsGrid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(320px, 1fr))';
            } else {
                // Lógica para imágenes
                media.forEach(imgName => {
                    const img = document.createElement('img');
                    img.src = `{{ asset('img/') }}/${imgName}`;
                    img.loading = 'lazy';
                    img.decoding = 'async';
                    img.classList.add('expandable');
                    img.onload = () => img.classList.add('loaded');
                    refsGrid.appendChild(img);
                });
                // Restaurar grid original para imágenes
                refsGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
            }

            refsModal.classList.add('active');
            document.body.style.overflow = 'hidden'; 
        }

        function closeRefsModal() {
            refsModal.classList.remove('active');
            refsGrid.innerHTML = ''; // Limpiar para detener videos en reproducción
            document.body.style.overflow = ''; 
        }

        // Cerrar modal al hacer clic fuera del contenido
        refsModal.addEventListener('click', (e) => {
            if (e.target === refsModal) closeRefsModal();
        });

        // Lazy fade-in para imágenes de las tarjetas
        document.querySelectorAll('.service-card img').forEach(img => {
            if (img.complete) {
                img.classList.add('loaded');
            } else {
                img.addEventListener('load', () => img.classList.add('loaded'));
            }
        });

        // Adjust carousel on resize
        window.addEventListener('resize', () => {
            Object.keys(positions).forEach(id => {
                positions[id] = 0;
                const track = document.getElementById(id);
                if (track) track.style.transform = `translateX(0px)`;
            });
        });
    </script>
@endsection
