@extends('layouts.app')

@section('title', 'Inicio - Emanuel Films')

@section('styles')
    <style>
        .hero {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 60px;
            max-width: 1300px;
            margin: 0 auto;
            gap: 80px;
            position: relative;
        }

        .hero-content {
            flex: 1;
            max-width: 500px;
            animation: fadeUp .9s ease forwards;
        }

        .accent-line {
            width: 60px;
            height: 3px;
            background: var(--accent);
            margin-bottom: 24px;
            border-radius: 2px;
        }

        .hero-content .hero-logo {
            max-width: 320px;
            width: 100%;
            height: auto;
            margin-bottom: 6px;
        }

        .hero-content .location {
            font-size: 0.75rem;
            color: var(--accent);
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.05rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 8px;
        }

        .hero-content .tag {
            font-size: 0.85rem;
            color: #aaa;
            margin-bottom: 32px;
            letter-spacing: 0.04em;
        }

        .hero-content .cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 40px;
            background: #111;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 4px;
            transition: all .3s ease;
            letter-spacing: 0.04em;
        }

        .hero-content .cta:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }

        .hero-visual {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1.2s ease forwards;
            position: relative;
        }

        .hero-visual::before {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(255,76,76,0.06) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .hero-visual img {
            max-width: 100%;
            height: auto;
            border-radius: 2px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.06);
            transition: transform .5s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                        box-shadow .5s ease;
            cursor: pointer;
        }

        .hero-visual img:hover {
            transform: scale(1.02);
            box-shadow: 0 40px 100px rgba(0,0,0,0.1);
        }

        .bracket {
            position: absolute;
            width: 40px;
            height: 40px;
            border-color: var(--accent);
            border-style: solid;
            border-width: 0;
            opacity: .35;
        }
        .bracket-tl { top: -8px; left: -8px; border-top-width: 2px; border-left-width: 2px; }
        .bracket-br { bottom: -8px; right: -8px; border-bottom-width: 2px; border-right-width: 2px; }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            animation: fadeIn 2s ease forwards;
            opacity: 0;
        }

        .scroll-indicator span {
            font-size: 0.6rem;
            color: #ccc;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .scroll-indicator .mouse {
            width: 18px;
            height: 28px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            position: relative;
        }

        .scroll-indicator .mouse::after {
            content: '';
            position: absolute;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 7px;
            background: var(--accent);
            border-radius: 2px;
            animation: scrollWheel 1.8s infinite;
        }

        @keyframes scrollWheel {
            0% { opacity: 1; transform: translateX(-50%) translateY(0); }
            100% { opacity: 0; transform: translateX(-50%) translateY(8px); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media(max-width: 968px) {
            .hero {
                flex-direction: column-reverse;
                padding: 60px 24px;
                gap: 40px;
                text-align: center;
                min-height: auto;
            }

            .hero-content {
                max-width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .hero-content .hero-logo {
                max-width: 220px;
            }

            .accent-line {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-visual img {
                max-width: 75%;
            }

            .hero-visual::before {
                width: 300px;
                height: 300px;
            }

            .scroll-indicator {
                display: none;
            }
        }

        @media(max-width: 480px) {
            .hero-content .hero-logo {
                max-width: 180px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="hero">
        <div class="hero-content">
            <div class="accent-line"></div>
            <img src="{{ asset('img/logo/logoema2.png') }}" alt="Emanuel Films" class="hero-logo">
            <div class="location">Juticalpa, Olancho</div>
            <p>Producciones audiovisuales con sede en Juticalpa, Olancho. Capturamos la esencia de tu historia con una mirada cinematográfica y artesanal.</p>
            <div class="tag">Fotografía · Video · Edición</div>
            <a href="{{ url('/servicios') }}" class="cta">Ver Portafolio →</a>
        </div>
        <div class="hero-visual">
            <div class="bracket bracket-tl"></div>
            <div class="bracket bracket-br"></div>
            <img src="{{ asset('img/logo/mockup-8.jpg') }}" alt="Emanuel Films">
        </div>

        <div class="scroll-indicator">
            <div class="mouse"></div>
            <span>Scroll</span>
        </div>
    </section>
@endsection
