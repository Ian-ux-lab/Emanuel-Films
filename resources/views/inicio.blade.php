@extends('layouts.app')

@section('title', 'Inicio - Emanuel Films')

@section('styles')
    <style>
        /* Fondo + overlay unique to Inicio */
        body {
            background: url("{{ asset('img/cam.jpg') }}") center/cover no-repeat fixed;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, .72);
            z-index: 0;
        }

        /* Sección principal */
        .hero {
            position: relative;
            z-index: 1;
            min-height: calc(100vh - 160px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }

        /* Logo grande */
        .hero-logo {
            width: 100%;
            max-width: 600px;
            height: auto;
            margin-bottom: 16px;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));
        }

        /* Texto */
        .hero p {
            font-size: clamp(1rem, 4vw, 1.8rem);
            color: #333;
            max-width: 900px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        /* Botón rojo */
        .hero .cta {
            padding: 18px 45px;
            background: var(--accent);
            color: #fff;
            font-size: 1.4rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 10px 25px rgba(255, 76, 76, 0.3);
        }

        .hero .cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 76, 76, 0.4);
        }

        @media(max-width: 768px) {
            .hero {
                min-height: calc(100vh - 120px);
                padding: 60px 20px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="hero">
        <img src="{{ asset('img/logoema2.png') }}" alt="Emanuel Films" class="hero-logo">
        <p>Capturamos historias con pasión y creatividad. Producciones audiovisuales profesionales que trascienden.</p>
        <a href="{{ url('/servicios') }}" class="cta">Ver Portafolio</a>
    </section>
@endsection
