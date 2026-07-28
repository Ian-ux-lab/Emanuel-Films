@extends('layouts.app')

@section('title', 'Contacto - Emanuel Films')

@section('styles')
    <style>
        main {
            padding: 80px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 160px);
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

        .contact-card {
            display: flex;
            align-items: stretch;
            background: #fff;
            padding: 50px;
            border-radius: 40px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .08);
            max-width: 1000px;
            width: 100%;
            gap: 60px;
        }

        .owner-avatar {
            width: 350px;
            height: 450px;
            border-radius: 30px;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .1);
        }

        .owner-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .owner-avatar:hover img {
            transform: scale(1.05);
        }

        .owner-info {
            display: flex;
            flex-direction: column;
            gap: 25px;
            flex: 1;
            padding-top: 20px;
        }

        .owner-header { margin-bottom: 10px; }

        .owner-name {
            font-weight: 700;
            font-size: 3rem;
            color: var(--text-dark);
            line-height: 1.1;
        }

        .owner-role {
            font-size: 1.5rem;
            color: var(--accent);
            font-weight: 600;
            margin-top: 5px;
        }

        .owner-company {
            font-size: 1.1rem;
            color: #888;
        }

        .social-links {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }

        .social-link-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
            text-decoration: none;
            color: var(--text-dark);
            transition: transform 0.2s;
        }

        .social-btn-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(255, 76, 76, 0.2);
            transition: all 0.3s ease;
        }

        .social-btn-circle img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .social-name {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .social-link-wrapper:hover { transform: translateX(10px); }
        .social-link-wrapper:hover .social-btn-circle {
            background: #e63e3e;
            box-shadow: 0 15px 30px rgba(255, 76, 76, 0.4);
        }

        @media(max-width: 950px) {
            .contact-card {
                flex-direction: column;
                padding: 40px;
                gap: 40px;
                align-items: center;
                text-align: center;
            }

            .owner-avatar {
                width: 100%;
                max-width: 400px;
                height: 400px;
            }

            .owner-info { padding-top: 0; width: 100%; }
            .social-links { align-items: center; }
            .social-link-wrapper:hover { transform: scale(1.05); }
        }

        @media(max-width: 480px) {
            .owner-name { font-size: 2.2rem; }
            .owner-avatar { height: 300px; }
            .contact-card { padding: 30px 20px; }
            .social-name { font-size: 1.1rem; }
            .social-btn-circle { width: 50px; height: 50px; }
            .social-btn-circle img { width: 26px; height: 26px; }
        }
    </style>
@endsection

@section('content')
    <div class="section-title">
        <h1>Contacto</h1>
        <p>Hablemos de tu próximo proyecto</p>
    </div>

    <div class="contact-card">
        <div class="owner-avatar">
            <img src="{{ asset('img/logo/emanuel.jpg') }}" alt="Fotógrafo - Emanuel Films">
        </div>

        <div class="owner-info">
            <div class="owner-header">
                <div class="owner-name">Emanuel</div>
                <div class="owner-role">Fotógrafo / Videógrafo</div>
                <div class="owner-company">Emanuel Films</div>
            </div>

            <div class="social-links">
                <a class="social-link-wrapper" href="https://www.facebook.com/profile.php?id=100048409281026" target="_blank">
                    <div class="social-btn-circle">
                        <img src="{{ asset('img/logo/fa.webp') }}" alt="Facebook">
                    </div>
                    <span class="social-name">Facebook</span>
                </a>

                <a class="social-link-wrapper" href="https://www.instagram.com/emanuelfilms.hn?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                    <div class="social-btn-circle" style="background:#E4405F;">
                        <img src="{{ asset('img/logo/ig.webp') }}" alt="Instagram">
                    </div>
                    <span class="social-name">Instagram</span>
                </a>

                <a class="social-link-wrapper" href="https://wa.me/50489579756" target="_blank">
                    <div class="social-btn-circle" style="background:#25D366;">
                        <img src="{{ asset('img/logo/w.webp') }}" alt="WhatsApp">
                    </div>
                    <span class="social-name">WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
@endsection
