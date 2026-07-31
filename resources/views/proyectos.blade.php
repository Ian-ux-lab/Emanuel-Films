@extends('layouts.app')

@section('title', 'Proyectos - Emanuel Films')

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

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 40px;
        }

        .project-card {
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s;
            display: flex;
            flex-direction: column;
            min-height: 420px;
        }

        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        .project-thumb {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .project-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .project-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .project-excerpt {
            color: #666;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .project-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge {
            padding: 6px 15px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.8rem;
            color: #fff;
            text-transform: uppercase;
        }

        .badge.actual { background: var(--accent); }
        .badge.futuro { background: #333; }

        /* Project Modal */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
            backdrop-filter: blur(5px);
        }

        .modal-backdrop.active { display: flex; }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 900px;
            border-radius: 25px;
            overflow: hidden;
            position: relative;
            display: flex;
            max-height: 90vh;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0,0,0,0.5);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            z-index: 10;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .modal-close:hover { background: rgba(0,0,0,0.7); }

        .modal-left { width: 50%; }
        .modal-left img { width: 100%; height: 100%; object-fit: cover; }

        .modal-right {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow-y: auto;
        }

        .modal-title { font-size: 2rem; font-weight: 700; }
        .modal-desc { color: #444; font-size: 1.1rem; line-height: 1.6; }

        .social-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: auto;
        }

        .social-link-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
        }

        .social-btn-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .social-btn-circle img { width: 22px; }
        .social-link-wrapper:hover .social-btn-circle { transform: scale(1.1); }

        @media(max-width: 850px) {
            .modal-content { flex-direction: column; }
            .modal-left, .modal-right { width: 100%; }
            .modal-left { height: 250px; }
            .modal-right { padding: 30px; }
        }

        @media(max-width: 480px) {
            .projects-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    <div class="section-title">
        <h1>Proyectos</h1>
        <p>Proyectos actuales y futuros</p>
    </div>

   <div class="projects-grid">
       <!-- <article class="project-card" 
            data-title="Emanuel cafe"
            data-desc="Cortometraje documental en producción con estética cinematográfica enfocado en la cultura del café."
            data-image="{{ asset('img/logo/cafe.jpg') }}" 
            data-status="Futuro" 
            data-fb="https://www.facebook.com/"
            data-ig="https://www.instagram.com/" 
            data-wa="https://wa.me/1234567890">
            <img class="project-thumb" src="{{ asset('img/logo/cafe.jpg') }}">
            <div class="project-body">
                <div>
                    <div class="project-title">Emanuel cafe</div>
                    <div class="project-excerpt">Proyecto cafeteria</div>
                </div>
                <div class="project-meta">
                    <div class="badge futuro">Futuro</div>
                    <div style="font-size:.9rem;color:#666">Rodaje 2026</div>
                </div>
            </div>
        </article>  -->

        <article class="project-card" 
            data-title="Exploshow"
            data-desc="🎤💃🕺📸 EXPLOSHOW es una empresa líder dedicada a la animación y el entretenimiento de alto nivel. Especializados en transformar eventos sociales, educativos, culturales y corporativos en experiencias memorables llenas de energía y profesionalismo." 
            data-image="{{ asset('img/logo/ex.jpg') }}"
            data-status="Actual" 
            data-fb="https://www.facebook.com/profile.php?id=61585698702809" 
            data-ig="https://www.instagram.com/exploshowhn?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" 
            data-wa="https://wa.me/50496719995">
            <img class="project-thumb" src="{{ asset('img/logo/ex.jpg') }}">
            <div class="project-body">
                <div>
                    <div class="project-title">Exploshow</div>
                    <div class="project-excerpt">Animación y Entretenimiento Profesional</div>
                </div>
                <div class="project-meta">
                    <div class="badge actual">Actual</div>
                </div>
            </div>
        </article>
    </div>

    <div id="projectModal" class="modal-backdrop">
        <div class="modal-content">
            <button id="modalClose" class="modal-close">Cerrar</button>
            <div class="modal-left">
                <img id="modalImage" src="" alt="">
            </div>
            <div class="modal-right">
                <div class="modal-title" id="modalTitle"></div>
                <div id="modalBadge" class="badge"></div>
                <div class="modal-desc" id="modalDesc"></div>
                <div class="social-links">
                    <a id="modalFb" class="social-link-wrapper" target="_blank">
                        <div class="social-btn-circle"><img src="{{ asset('img/logo/fa.webp') }}"></div>
                        <span>Facebook</span>
                    </a>
                    <a id="modalIg" class="social-link-wrapper" target="_blank">
                        <div class="social-btn-circle" style="background:#E4405F;"><img src="{{ asset('img/logo/ig.webp') }}"></div>
                        <span>Instagram</span>
                    </a>
                    <a id="modalWa" class="social-link-wrapper" target="_blank">
                        <div class="social-btn-circle" style="background:#25D366;"><img src="{{ asset('img/logo/w.webp') }}"></div>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const cards = document.querySelectorAll('.project-card');
        const modal = document.getElementById('projectModal');
        const modalClose = document.getElementById('modalClose');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                document.getElementById('modalTitle').textContent = card.dataset.title;
                document.getElementById('modalDesc').textContent = card.dataset.desc;
                document.getElementById('modalImage').src = card.dataset.image;
                
                const badge = document.getElementById('modalBadge');
                badge.textContent = card.dataset.status;
                badge.className = 'badge ' + card.dataset.status.toLowerCase();

                document.getElementById('modalFb').href = card.dataset.fb;
                document.getElementById('modalIg').href = card.dataset.ig;
                document.getElementById('modalWa').href = card.dataset.wa;

                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        const closeModal = () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        };

        modalClose.onclick = closeModal;
        modal.onclick = (e) => { if (e.target === modal) closeModal(); };
    </script>
@endsection
