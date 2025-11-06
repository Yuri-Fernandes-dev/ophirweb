
<?php $BASE_URL = '.'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ophir Gestão - Sistema de Gestão Completo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset e configurações básicas */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
       
        :root {
            --primary: #0a55a4;
            --secondary: #f7953c;
            --green: #38a169;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --dark-text: #333333;
            --light-text: #666666;
            --gradient: linear-gradient(135deg, var(--primary) 0%, #1a6bc4 100%);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            color: var(--dark-text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 60px;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .logo span {
            color: var(--secondary);
            margin-left: 5px;
        }

        .logo i {
            margin-right: 10px;
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-text);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .nav-links a:hover:after {
            width: 100%;
        }

        .header-buttons {
            display: flex;
            gap: 15px;
        }
        #verde{
            color: green;
        }

        .btn {
            display: inline-block;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(10, 85, 164, 0.3);
        }

        .btn-primary {
            background: #2b6cb0;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1a4e8a;
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: var(--white);
            border: 2px solid var(--secondary);
        }

        .btn-secondary:hover {
            background-color: #e6862a;
            border-color: #e6862a;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(247, 149, 60, 0.3);
        }

        .btn-green {
            background-color: var(--green);
            color: var(--white);
            border: 2px solid var(--green);
        }

        .btn-green:hover {
            background-color: #2f855a;
            border-color: #2f855a;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(56, 161, 105, 0.3);
        }

        .btn-whatsapp {
            background-color: #25D366;
            color: var(--white);
            border: 2px solid #25D366;
            padding: 12px 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
        }

        .btn-whatsapp:hover {
            background-color: #128C7E;
            border-color: #128C7E;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
        }

        .mobile-menu {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        /* WhatsApp Flutuante */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 30px rgba(37, 211, 102, 0.6);
            color: #FFF;
        }

        .whatsapp-float i {
            font-size: 28px;
        }

        /* Price Badge */
        .price-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, var(--green) 0%, #2f855a 100%);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(56, 161, 105, 0.3);
            animation: pulse 2s infinite;
        }

        .price-badge i {
            margin-right: 8px;
            font-size: 1.3rem;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Hero Section */
        .hero {
            padding: 180px 0 100px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-content {
            flex: 1;
            animation: fadeInLeft 1s ease;
        }

        .hero-image {
            flex: 1;
            text-align: center;
            position: relative;
            animation: fadeInRight 1s ease;
        }

        .slider-container {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .slider {
            display: flex;
            width: 400%;
            height: 100%;
            transition: transform 0.8s ease;
        }

        .slide {
            width: 25%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .slider-controls {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: var(--transition);
        }

        .slider-dot.active {
            background-color: var(--white);
            transform: scale(1.2);
        }

        .hero h1 {
            font-size: 3.2rem;
            margin-bottom: 20px;
            color: var(--primary);
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            color: var(--light-text);
        }

        .highlight {
            color: var(--secondary);
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .highlight:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 8px;
            bottom: 5px;
            left: 0;
            background-color: rgba(247, 149, 60, 0.3);
            z-index: -1;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .demo-message {
            background-color: var(--green);
            color: var(--white);
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 20px;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(56, 161, 105, 0.3);
        }

        .demo-message a {
            color: var(--white);
            text-decoration: underline;
            transition: var(--transition);
        }

        .demo-message a:hover {
            color: #e0e0e0;
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background: var(--gradient);
            color: var(--white);
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
        }

        .stat-item {
            text-align: center;
            flex: 1;
            min-width: 200px;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            display: block;
        }

        .stat-text {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Video Section */
        .video-section {
            padding: 100px 0;
            background-color: var(--white);
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            font-size: 2rem;
            color: #222;
            margin-bottom: 10px;
        }

        .section-title h2:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background-color: var(--secondary);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .section-title p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 40px;
        }

        .video-container {
            max-width: 900px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 10;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            background: #000;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-fallback {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, #1a6bc4 100%);
            display: none;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .video-fallback.active {
            display: flex;
        }

        .fallback-content i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .fallback-content h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .fallback-content p {
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .video-buttons {
            text-align: center;
            margin-top: 30px;
        }

        /* About Section */
        .about-section {
            padding: 100px 0;
            background-color: var(--light-bg);
        }

        .about-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content .section-title h2 {
            font-size: 2.8rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .about-content .section-title p {
            font-size: 1.2rem;
            color: var(--light-text);
            max-width: 700px;
            margin: 0 auto 40px;
        }

        /* Persuasive Section */
        .persuasive-section {
            padding: 100px 0;
            background-color: var(--light-bg);
        }

        .persuasive-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .persuasive-content .section-title h2 {
            font-size: 2.8rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .persuasive-content .section-title p {
            font-size: 1.2rem;
            color: var(--light-text);
            max-width: 700px;
            margin: 0 auto 40px;
        }

        .benefits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .benefit {
            background: var(--white);
            border-radius: 16px;
            padding: 40px 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .benefit::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
            transition: var(--transition);
        }

        .benefit:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 25px;
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(10, 85, 164, 0.1), rgba(247, 149, 60, 0.1));
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .benefit h3 {
            font-size: 1.6rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .benefit p {
            font-size: 1rem;
            color: var(--light-text);
            line-height: 1.7;
        }

        /* Footer */
        footer {
            background: var(--gradient);
            color: var(--white);
            padding: 80px 0 30px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
        }

        .footer-column h3 {
            margin-bottom: 25px;
            font-size: 1.3rem;
            position: relative;
            display: inline-block;
        }

        .footer-column h3:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background-color: var(--secondary);
            bottom: -8px;
            left: 0;
            border-radius: 2px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .footer-column ul li a i {
            margin-right: 10px;
            font-size: 0.9rem;
        }

        .footer-column ul li a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--secondary);
            transform: translateY(-5px);
        }

        .footer-bottom {
            margin-top: 60px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* Animações */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes countUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .benefits {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .nav-links {
                display: none;
            }

            .mobile-menu {
                display: block;
            }

            .header-buttons {
                display: none;
            }

            .mobile-nav {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: var(--white);
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                display: flex;
                flex-direction: column;
                gap: 15px;
                transform: translateY(-100%);
                transition: var(--transition);
                z-index: 999;
            }

            .mobile-nav.active {
                transform: translateY(0);
            }

            .mobile-nav a {
                text-decoration: none;
                color: var(--dark-text);
                font-weight: 500;
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }

            .mobile-nav .header-buttons {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-top: 10px;
            }

            .slider-container {
                height: 350px;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2.8rem;
            }

            .slider-container {
                height: 300px;
            }
            
            .video-section {
                padding: 60px 0;
            }
            
            .video-container {
                margin: 0 10px;
            }

            .video-wrapper {
                min-height: 200px;
            }

            .persuasive-content .section-title h2 {
                font-size: 2.2rem;
            }

            .whatsapp-float {
                width: 55px;
                height: 55px;
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-float i {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 150px 0 80px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            .video-container {
                margin: 0 5px;
                border-radius: 10px;
            }

            .video-wrapper {
                min-height: 150px;
            }

            .slider-container {
                height: 250px;
            }

            .persuasive-content .section-title h2 {
                font-size: 1.8rem;
            }

            .benefit {
                padding: 30px 20px;
            }

            .benefit-icon {
                width: 60px;
                height: 60px;
                line-height: 60px;
                font-size: 2rem;
            }

            .demo-message {
                font-size: 1rem;
                padding: 12px 15px;
            }

        }

        .price-badge {
            font-size: 1rem;
            padding: 10px 20px;
        }
        /* Plans */
        .plans-section { background: var(--light-bg); padding: 80px 0; }
        .plans-section .container { max-width: 1800px; }
        .plans-grid { display:grid; grid-template-columns: repeat(4, 1fr); gap:28px; align-items: stretch; justify-items: stretch; }
        .plan-card { position:relative; background:#fff; border:2px solid #cbd5e1; border-radius:14px; box-shadow: 0 6px 18px rgba(0,0,0,0.06); padding:24px; display:flex; flex-direction:column; gap:12px; min-height: 420px; height:100%; }
        .plan-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.12); border-color:#d1d5db; }
        .plan-header { display:flex; align-items:center; gap:12px; padding:10px 14px; border-radius:10px; }
        .plan-header .icon { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; }
        .plan-card h3 { margin:0; color:#111827; font-weight:800; font-size:1.4rem; }
        .ribbon { position:absolute; top:14px; right:14px; background: var(--secondary); color:#fff; font-size:.75rem; padding:6px 10px; border-radius:999px; box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
        .plan-price { font-size: 1.4rem; color:#111827; display:flex; align-items:baseline; gap:8px; }
        .plan-price .amount { font-size:2rem; font-weight:800; }
        .plan-note { font-size:.85rem; color:#6b7280; }
        .plan-features { list-style:none; padding:0; margin:8px 0 0; display:flex; flex-direction:column; gap:8px; color:#374151; }
        .plan-features li { display:flex; align-items:flex-start; gap:10px; line-height:1.4; }
        .plan-features li i { color: #10b981; margin-top:2px; }
        .plan-cta { margin-top:auto; width:100%; text-align:center; }
        .plan-cta .btn { width:100%; padding:12px 16px; font-weight:700; border-radius:10px; }
        .plan-entrada { border-top:4px solid #3b82f6; }
        .plan-bronze { border-top:4px solid #cd7f32; }
        .plan-ouro { border-top:4px solid #f59e0b; }
        .plan-diamante { border-top:4px solid #06b6d4; }
        .plan-entrada .plan-header { background: rgba(59,130,246,0.10); }
        .plan-bronze .plan-header { background: rgba(205,127,50,0.12); }
        .plan-ouro .plan-header { background: rgba(245,158,11,0.12); }
        .plan-diamante .plan-header { background: rgba(6,182,212,0.12); }
        .plan-entrada .plan-header .icon { background: rgba(59,130,246,0.20); color:#1d4ed8; }
        .plan-bronze .plan-header .icon { background: rgba(205,127,50,0.20); color:#a05a1e; }
        .plan-ouro .plan-header .icon { background: rgba(245,158,11,0.20); color:#b45309; }
        .plan-diamante .plan-header .icon { background: rgba(6,182,212,0.20); color:#0e7490; }
        @media (max-width: 1300px) { .plans-grid { grid-template-columns: repeat(3, minmax(280px, 1fr)); } }
        @media (max-width: 960px) { .plans-grid { grid-template-columns: repeat(2, minmax(260px, 1fr)); } }
        @media (max-width: 600px) { .plans-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="<?php echo $BASE_URL; ?>/logo.png" alt="Ophir Gestão Logo" width="190px">
            </div>
            <nav class="nav-links">
                <a href="#features">Recursos</a>
                <a href="#plans">Planos</a>
                <a href="#about">Sobre</a>
                <a href="#contact">Contato</a>
            </nav>
            <div class="header-buttons">
                <a href="https://sistemaophir.shop/login" class="btn btn-outline">Entrar no Sistema</a>
                <a href="#video" class="btn btn-primary">Solicitar Demonstração</a>
            </div>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- MENU MOBILE -->
    <nav class="mobile-nav">
        <a href="#features">Recursos</a>
        <a href="https://sistemaophir.shop/planos">Planos</a>
        <a href="#about">Sobre</a>
        <a href="#contact">Contato</a>
        <div class="header-buttons">
           
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-container">
            <div class="hero-content">
                <!-- PRICE BADGE AQUI EM CIMA -->
                <div class="price-badge">
                    <i class="fas fa-tag"></i>
                    <strong>R$ 15 no primeiro mês</strong>
                </div>
                
                <h1>Gestão que gera resultado, começando por <span class="highlight">R$ 15 no primeiro mês</span></h1>
                <p> Gerencie estoque, vendas, financeiro, Mensagem em massa <strong id="verde">ZAP</strong> e atendimento — tudo pelo mesmo painel.
                    Menos bagunça, mais resultado.</p>
                
                <div class="hero-buttons">
                    <a href="#video" class="btn btn-outline">Ver Vídeo</a>
                    <!-- BOTÃO ADQUIRIR AGORA -->
                    <a href="https://wa.me/5521988037318?text=Olá!%20Quero%20ADQUIRIR%20o%20Ophir%20Gestão%20AGORA!%20Qual%20plano%20recomenda?" 
                       target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> FALAR COM SUPORTE
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <div class="slider-container">
                    <div class="slider">
            <div class="slide"><img src="<?php echo $BASE_URL; ?>/1.png" alt="Slide 1"></div>
            <div class="slide"><img src="<?php echo $BASE_URL; ?>/2.png" alt="Slide 2"></div>
            <div class="slide"><img src="<?php echo $BASE_URL; ?>/3.png" alt="Slide 3"></div>
            <div class="slide"><img src="<?php echo $BASE_URL; ?>/4.png" alt="Slide 4"></div>
                    </div>
                    <div class="slider-controls">
                        <div class="slider-dot active"></div>
                        <div class="slider-dot"></div>
                        <div class="slider-dot"></div>
                        <div class="slider-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item">
                    <span class="stat-number" data-count="2500">0</span>
                    <div class="stat-text">Clientes Satisfeitos</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-count="46">0</span>
                    <div class="stat-text">Aumento Médio nas Vendas</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-count="99">0</span>
                    <div class="stat-text">Disponibilidade do Sistema</div>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-count="24">0</span>
                    <div class="stat-text">Suporte Especializado</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section" id="video">
        <div class="container">
            <div class="section-title">
                <h2>Veja o Ophir Gestão em Ação</h2>
                <p>Assista ao nosso vídeo e descubra como nossa plataforma pode transformar a gestão da sua empresa.</p>
            </div>
            <div class="video-container">
                <div class="video-wrapper">
                    <iframe 
                        src="https://www.youtube.com/embed/THd7v6RBT64?start=13" 
                        title="SnapDev PDV - Demonstração" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                    <div class="video-fallback">
                        <div class="fallback-content">
                            <i class="fas fa-play-circle"></i>
                            <h3>Vídeo Indisponível</h3>
                            <p>Clique no botão abaixo para assistir no YouTube</p>
                            <a href="https://www.youtube.com/watch?v=s9Ns7t84LLc" target="_blank" class="btn btn-secondary">
                                Assistir no YouTube
                            </a>
                        </div>
                    </div>
                </div>
                <div class="video-buttons">
                    <!-- BOTÃO ADQUIRIR AGORA AQUI TAMBÉM -->
                    <a href="https://wa.me/5521988037318?text=Olá!%20Vi%20o%20vídeo%20e%20quero%20ADQUIRIR%20o%20Ophir%20Gestão%20AGORA!" 
                       target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> ADQUIRIR AGORA
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-content">
                <div class="section-title">
                    <h2>Sobre o Ophir Gestão</h2>
                    <p>Conheça nossa missão e como ajudamos empresas a crescer.</p>
                </div>
                <p>O Ophir Gestão é uma plataforma de gestão empresarial desenvolvida para simplificar processos e impulsionar resultados. Fundada com a missão de tornar a tecnologia acessível, nossa solução integra ferramentas poderosas para vendas, estoque, finanças e muito mais, tudo em uma interface intuitiva.</p>
                <p>Com mais de 2.500 clientes satisfeitos, nossa equipe está comprometida em oferecer suporte excepcional e atualizações contínuas para atender às necessidades do seu negócio.</p>
            </div>
        </div>
    </section>

    <!-- ERP Section -->
    <section class="persuasive-section" id="features">
        <div class="container">
            <div class="persuasive-content">
                <div class="section-title">
                    <h2>ERP completo para lojas</h2>
                    <p>Ophir Gestão foi desenvolvido para lojas de suplementos, moda, beleza e varejo. Centralize vendas, PDV, estoque, financeiro e atendimento em uma única plataforma.</p>
                </div>
                <div class="benefits">
                    <div class="benefit">
                        <div class="benefit-icon"><i class="fas fa-box-open"></i></div>
                        <h3>Estoque e Produtos</h3>
                        <p>Controle em tempo real, variações por tamanho/cor, códigos de barras, inventário e integração com fornecedores.</p>
                    </div>
                    <div class="benefit">
                        <div class="benefit-icon"><i class="fas fa-cash-register"></i></div>
                        <h3>PDV e Vendas Omnichannel</h3>
                        <p>PDV rápido e responsivo, vendas na loja física ou online, gestão de promoções, cupons e integração com gateways de pagamento.</p>
                    </div>
                    <div class="benefit">
                        <div class="benefit-icon"><i class="fas fa-money-bill-wave"></i></div>
                        <h3>Financeiro e Cobranças</h3>
                        <p>Contas a pagar e receber, conciliação financeira, cobranças recorrentes e emissão de notas e boletos para gestão completa do caixa.</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>



    <!-- Plans Section -->
    <section class="plans-section" id="plans">
        <div class="container">
            <div class="section-title">
                <h2>Planos</h2>
                <p>Escolha o plano ideal para o seu negócio. Comece hoje mesmo e fale conosco pelo WhatsApp.</p>
            </div>
            <div class="plans-grid">
                <!-- Plano Entrada -->
                <div class="plan-card plan-entrada">
                    <div class="plan-header">
                        <div class="icon"><i class="fas fa-seedling"></i></div>
                        <div>
                            <h3>Plano Entrada</h3>
                            <div class="plan-note">ATENÇÃO: válido por um mês. Posteriormente o plano muda para o Bronze.</div>
                        </div>
                    </div>
                    <div class="plan-price"> <span class="amount">R$ 14,79</span><span class="plan-note">/ mês</span></div>
                    <ul class="plan-features">
                        <li>Vendas, Estoque e Produtos</li>
                        <li>Abertura de Chamados</li>
                        <li>Contas à Pagar e Receber</li>
                        <li>Gestão de RH</li>
                        <li>API do WhatsApp</li>
                        <li>APIs de Pagamentos</li>
                        <li>Painel do Cliente</li>
                        <li>Assinatura Digital</li>
                        <li>Limite de 1 Usuário</li>
                        <li>1 Dispositivo WhatsApp</li>
                        <li>Site</li>
                    </ul>
                    <div class="plan-cta">
                        <a class="btn btn-whatsapp" target="_blank" href="https://wa.me/5521988037318?text=Ol%C3%A1!%20Quero%20assinar%20o%20Plano%20Entrada%20(R$%2014,79%2Fm%C3%AAs).%20Como%20proceder%3F">Assinar Agora</a>
                    </div>
                </div>

                <!-- Plano Bronze -->
                <div class="plan-card plan-bronze">
                    <div class="ribbon">Popular</div>
                    <div class="plan-header">
                        <div class="icon"><i class="fas fa-medal"></i></div>
                        <div>
                            <h3>Plano Bronze</h3>
                        </div>
                    </div>
                    <div class="plan-price"> <span class="amount">R$ 99,89</span><span class="plan-note">/ mês</span></div>
                    <ul class="plan-features">
                        <li>Vendas, Estoque e Produtos</li>
                        <li>Abertura de Chamados</li>
                        <li>Contas à Pagar e Receber</li>
                        <li>Gestão de RH</li>
                        <li>API do WhatsApp</li>
                        <li>API de Pagamentos</li>
                        <li>Painel do Cliente</li>
                        <li>Assinatura Digital</li>
                        <li>Cobranças Recorrentes</li>
                        <li>Limite de 3 Usuários</li>
                        <li>2 Dispositivos WhatsApp</li>
                    </ul>
                    <div class="plan-cta">
                        <a class="btn btn-whatsapp" target="_blank" href="https://wa.me/5521988037318?text=Ol%C3%A1!%20Quero%20assinar%20o%20Plano%20Bronze%20(R$%2099,89%2Fm%C3%AAs).%20Como%20proceder%3F">Assinar Agora</a>
                    </div>
                </div>

                <!-- Plano Ouro -->
                <div class="plan-card plan-ouro">
                    <div class="plan-header">
                        <div class="icon"><i class="fas fa-crown"></i></div>
                        <div>
                            <h3>Plano Ouro</h3>
                        </div>
                    </div>
                    <div class="plan-price"> <span class="amount">R$ 160,00</span><span class="plan-note">/ mês</span></div>
                    <ul class="plan-features">
                        <li>Vendas, Estoque e Produtos</li>
                        <li>Abertura de Chamados</li>
                        <li>Vídeo Tutoriais</li>
                        <li>Contas à Pagar e Receber</li>
                        <li>Gestão de RH</li>
                        <li>API do WhatsApp</li>
                        <li>API de Pagamentos</li>
                        <li>Painel do Cliente</li>
                        <li>Assinatura Digital</li>
                        <li>Cobranças Recorrentes</li>
                        <li>Gestão de Contratos</li>
                        <li>Orçamentos</li>
                        <li>Limite de 7 Usuários</li>
                        <li>5 Dispositivos WhatsApp</li>
                        <li>Site</li>
                        <li><strong id="verde">Marketing (Aumente as vendas em 63%)</strong></li>
                    </ul>
                    <div class="plan-cta">
                        <a class="btn btn-whatsapp" target="_blank" href="https://wa.me/5521988037318?text=Ol%C3%A1!%20Quero%20assinar%20o%20Plano%20Ouro%20(R$%20160,00%2Fm%C3%AAs).%20Como%20proceder%3F">Assinar Agora</a>
                    </div>
                </div>

                <!-- Plano Diamante -->
                <div class="plan-card plan-diamante">
                    <div class="plan-header">
                        <div class="icon"><i class="fas fa-gem"></i></div>
                        <div>
                            <h3>Plano Diamante</h3>
                        </div>
                    </div>
                    <div class="plan-price"> <span class="amount">R$ 220,00</span><span class="plan-note">/ mês</span></div>
                    <ul class="plan-features">
                        <li>Vendas, Estoque e Produtos</li>
                        <li>Abertura de Chamados</li>
                        <li>Contas à Pagar e Receber</li>
                        <li>Gestão de RH</li>
                        <li>API do WhatsApp</li>
                        <li>API de Pagamentos</li>
                        <li>Painel do Cliente</li>
                        <li>Assinatura Digital</li>
                        <li>Cobranças Recorrentes</li>
                        <li>Gestão de Contratos</li>
                        <li>Orçamentos</li>
                        <li>Ordem de Serviços</li>
                        <li>Clientes Ilimitados</li>
                        <li>Usuários Ilimitados</li>
                        <li>10 Dispositivos WhatsApp</li>
                        <li>Site</li>
                        <li><strong id="verde">Marketing (Aumente as vendas em 63%)</strong></li>
                    </ul>
                    <div class="plan-cta">
                        <a class="btn btn-whatsapp" target="_blank" href="https://wa.me/5521988037318?text=Ol%C3%A1!%20Quero%20assinar%20o%20Plano%20Diamante%20(R$%20220,00%2Fm%C3%AAs).%20Como%20proceder%3F">Assinar Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container footer-container">
            <div class="footer-column">
                <h3>Ophir Gestão</h3>
                <p>Sistema de gestão completo para empresas de todos os tamanhos. Transforme sua gestão e impulsione seus resultados.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Links Rápidos</h3>
                <ul>
                    <li><a href="#features"><i class="fas fa-chevron-right"></i> Recursos</a></li>
                    <li><a href="#plans"><i class="fas fa-chevron-right"></i> Planos</a></li>
                    <li><a href="#about"><i class="fas fa-chevron-right"></i> Sobre Nós</a></li>
                    <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contato</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Suporte</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Central de Ajuda</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Tutoriais</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Status do Sistema</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contato</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> contato@ophirgestao.com</li>
                    <li><i class="fab fa-whatsapp"></i> (21) 988037318</li>
                    <li><i class="fas fa-map-marker-alt"></i> Rio de Janeiro, Nova Iguaçu</li>
                </ul>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; 2025 Ophir Gestão. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- WHATSAPP FLUTUANTE -->
    <a href="https://wa.me/5521988037318?text=Olá!%20Tenho%20interesse%20no%20Ophir%20Gestão!" 
       class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        // Menu Mobile
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileNav = document.querySelector('.mobile-nav');

        mobileMenu.addEventListener('click', () => {
            mobileNav.classList.toggle('active');
            mobileMenu.innerHTML = mobileNav.classList.contains('active') 
                ? '<i class="fas fa-times"></i>' 
                : '<i class="fas fa-bars"></i>';
        });

        // Slider Automático
        const slider = document.querySelector('.slider');
        const dots = document.querySelectorAll('.slider-dot');
        let currentSlide = 0;

        function nextSlide() {
            currentSlide = (currentSlide + 1) % 4;
            updateSlider();
        }

        function updateSlider() {
            slider.style.transform = `translateX(-${currentSlide * 25}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                updateSlider();
            });
        });

        setInterval(nextSlide, 2700);

        // Contadores Animados
        const statNumbers = document.querySelectorAll('.stat-number');
        let counted = false;

        function animateCounters() {
            if (counted) return;
            
            statNumbers.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                const suffix = stat.textContent.includes('%') ? '%' : '';
                let count = 0;
                const duration = 2000;
                const increment = target / (duration / 16);
                
                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        stat.textContent = Math.floor(count) + suffix;
                        requestAnimationFrame(updateCount);
                    } else {
                        stat.textContent = target + suffix;
                        stat.style.animation = 'countUp 0.5s ease';
                    }
                };
                
                updateCount();
            });
            
            counted = true;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                }
            });
        }, { threshold: 0.5 });

        observer.observe(document.querySelector('.stats-section'));

        // Verificar se o vídeo carregou corretamente
        document.addEventListener('DOMContentLoaded', function() {
            const videoIframe = document.querySelector('.video-wrapper iframe');
            const videoFallback = document.querySelector('.video-fallback');
            
            if (videoIframe) {
                videoIframe.onload = function() {
                    setTimeout(function() {
                        try {
                            if (!videoIframe.contentWindow || videoIframe.offsetHeight === 0) {
                                videoFallback.classList.add('active');
                            }
                        } catch (e) {
                            videoFallback.classList.add('active');
                        }
                    }, 2000);
                };
                
                videoIframe.onerror = function() {
                    videoFallback.classList.add('active');
                };
            }
        });

        // Custom Smooth Scroll
        function smoothScroll(targetElement, duration) {
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - 80;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            let startTime = null;

            function animation(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const run = ease(timeElapsed, startPosition, distance, duration);
                window.scrollTo(0, run);
                if (timeElapsed < duration) requestAnimationFrame(animation);
            }

            function ease(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(animation);
        }

        // Smooth scroll para links internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    smoothScroll(targetElement, 1000);
                    
                    if (mobileNav && mobileNav.classList.contains('active')) {
                        mobileNav.classList.remove('active');
                        mobileMenu.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.style.padding = '5px 0';
                header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.padding = '15px 0';
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>

    <!-- Modal de Lead (aparece após 6 segundos) -->
    <style>
      .lead-modal-overlay { position: fixed; inset: 0; background: rgba(17,24,39,.5); display: none; align-items: center; justify-content: center; z-index: 2000; }
      .lead-modal-overlay.open { display: flex; }
      .lead-modal { background: #ffffff; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.15); width: 90%; max-width: 520px; padding: 20px; border: 1px solid #e5e7eb; }
      body.modal-open { overflow: hidden; }
      .lead-modal header { display:flex; justify-content:space-between; align-items:center; margin-bottom: 12px; }
      .lead-modal header h3 { margin:0; color: var(--primary); }
      .lead-modal .close { background:none; border:none; font-size:22px; cursor:pointer; color:#6b7280; }
      .lead-modal .row { display:flex; flex-direction:column; gap:6px; margin-bottom:10px; }
      .lead-modal label { font-size:14px; color:#6b7280; }
      .lead-modal input { width:100%; padding:12px; border:1px solid #e5e7eb; border-radius:8px; font-size:14px; }
      .lead-modal select { width:100%; padding:12px 36px 12px 12px; border:1px solid #e5e7eb; border-radius:8px; font-size:14px; background:#ffffff; appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 12px center; background-size:16px; }
      .lead-modal input:focus, .lead-modal select:focus { outline:none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(10,85,164,0.15); }
      .lead-modal select:hover { border-color:#d1d5db; }
      .lead-modal .actions { display:flex; gap:8px; margin-top:8px; }
      .lead-modal .actions .btn { padding:10px 14px; }
      @media (max-width: 480px) { .lead-modal { width:96%; padding:16px; } }
    </style>
    <div class="lead-modal-overlay" id="leadModal">
      <div class="lead-modal" role="dialog" aria-modal="true" aria-labelledby="leadModalTitle">
        <header>
          <h3 id="leadModalTitle">Fale com a Ophir Gestão</h3>
        </header>
        <form method="post" action="api/create_lead.php">
          <input type="hidden" name="public" value="1" />
          <input type="hidden" name="redirect" value="" id="leadRedirect" />
          <div class="row"><label>Nome</label><input type="text" name="name" required /></div>
          <div class="row"><label>Email</label><input type="email" name="email" required /></div>
          <div class="row"><label>Telefone</label><input type="text" name="phone" required inputmode="tel" /></div>
          <div class="row"><label>Empresa</label><input type="text" name="company" /></div>
          <div class="row"><label>Como nos conheceu?</label>
            <select name="source" required>
              <option value="" disabled selected>Selecione uma opção</option>
              <option value="Youtube">Youtube</option>
              <option value="Tiktok">Tiktok</option>
              <option value="Instagram">Instagram</option>
              <option value="Facebook">Facebook</option>
              <option value="Google">Google</option>
            </select>
          </div>
          <div class="actions">
            <button class="btn btn-primary" type="submit">Enviar</button>
          </div>
        </form>
      </div>
    </div>
    <script>
      (function(){
        const overlay = document.getElementById('leadModal');
        if (!overlay) return;
        const openModal = () => { overlay.classList.add('open'); document.body.classList.add('modal-open'); };
        const params = new URLSearchParams(window.location.search);
        const submitted = params.get('success') === '1';
        if (!submitted) {
          setTimeout(openModal, 8000);
        }
        // Define redirect dinâmico para a mesma página, qualquer que seja o caminho (ex.: /crm/index_site.php)
        const redirectInput = document.getElementById('leadRedirect');
        if (redirectInput) {
          const url = new URL(window.location.href);
          redirectInput.value = url.pathname + '?success=1';
        }
        // Modal obrigatório: remover fechamentos por clique fora e ESC
        overlay.addEventListener('click', (e)=>{
          // não fecha ao clicar fora; impede interação no fundo
          if (e.target === overlay) { e.stopPropagation(); }
        });
        document.addEventListener('keydown', (e)=>{ if (e.key === 'Escape') { e.preventDefault(); } });
      })();
    </script>
  </body>
</html>
