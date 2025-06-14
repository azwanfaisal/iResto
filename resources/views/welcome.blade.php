<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Karyawan | Modern Employee Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3a0ca3;
            --secondary: #7209b7;
            --accent: #f72585;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --success: #4cc9f0;
            --border-radius: 12px;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .dark body {
            background-color: var(--dark);
            color: var(--light);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* Header */
        header {
            padding: 1.5rem 0;
            position: relative;
            z-index: 50;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo span {
            background: white;
            color: var(--primary);
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
            border: none;
            cursor: pointer;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .btn-outline {
            border: 2px solid white;
            color: white;
            background: transparent;
        }
        
        .btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Hero Section - Posisi gambar di sebelah kanan */
        .hero {
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            min-height: 80vh;
        }
        
        .hero-container {
            display: flex;
            align-items: center;
            gap: 4rem;
        }
        
        .hero-content {
            flex: 1;
            position: relative;
            z-index: 10;
        }
        
        .hero-image-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .hero-image {
            width: 100%;
            max-width: 500px;
            border-radius: 20px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.15);
            animation: floating 3s ease-in-out infinite;
            position: relative;
            z-index: 5;
            transform: translateY(0);
        }
        
        .hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .hero-title span {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 500px;
        }
        
        .dark .hero-subtitle {
            color: #a8a8a8;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        /* Features */
        .features {
            padding: 5rem 0;
            background-color: #f8fbff;
        }
        
        .dark .features {
            background-color: #0f172a;
        }
        
        .section-title {
            text-align: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 3rem;
            color: var(--dark);
        }
        
        .dark .section-title {
            color: var(--light);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--light-gray);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .dark .feature-card {
            background: #16213e;
            border-color: #1f2a4a;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .dark .feature-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .feature-icon svg {
            width: 24px;
            height: 24px;
        }
        
        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .dark .feature-title {
            color: var(--light);
        }
        
        .feature-desc {
            color: var(--gray);
            font-size: 0.95rem;
        }
        
        .dark .feature-desc {
            color: #b8b8b8;
        }
        
        /* Stats */
        .stats {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 4rem 0;
            border-radius: var(--border-radius);
            margin: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .stats-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 2rem;
            position: relative;
            z-index: 2;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 3rem 0 1.5rem;
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .footer-logo span {
            background: white;
            color: var(--primary);
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
        }
        
        .footer-about {
            max-width: 300px;
        }
        
        .footer-links h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-light);
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.5rem;
        }
        
        .footer-links a {
            color: #b8b8b8;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #b8b8b8;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }
            
            .hero-content {
                max-width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .hero-title {
                font-size: 2.8rem;
            }
            
            .hero-subtitle {
                max-width: 100%;
            }
            
            .hero-buttons {
                justify-content: center;
            }
        }
        
        @media (max-width: 768px) {
            .hero {
                padding: 3rem 0;
                min-height: auto;
            }
            
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-image {
                max-width: 90%;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
        
        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .delay-1 {
            animation-delay: 0.2s;
        }
        
        .delay-2 {
            animation-delay: 0.4s;
        }
        
        .delay-3 {
            animation-delay: 0.6s;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        /* Dekorasi */
        .circle-decor {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }
        
        .circle-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, var(--primary-light), var(--accent));
            opacity: 0.1;
            top: -100px;
            right: -100px;
        }
        
        .circle-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            opacity: 0.1;
            bottom: -50px;
            left: -50px;
        }
        
        .circle-3 {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, var(--primary), var(--success));
            opacity: 0.1;
            bottom: 100px;
            right: 200px;
        }
        
        /* Mode toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .dark-mode-toggle:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="animate__animated animate__fadeIn">
        <div class="container">
             <nav>
                <a href="#" class="logo">
                    <span>SMK</span> Manajemen
                </a>
                <div class="nav-links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">
                                <i class="fas fa-sign-in-alt"></i> Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section dengan posisi gambar di kanan -->
    <section class="hero">
        <div class="circle-decor circle-1"></div>
        <div class="circle-decor circle-2"></div>
        <div class="circle-decor circle-3"></div>
        
        <div class="container hero-container">
            <div class="hero-content animate__animated animate__fadeIn">
                <h1 class="hero-title">Selamat Datang di <span>Sistem Manajemen Karyawan</span></h1>
                <p class="hero-subtitle">
                    Kelola data karyawan, penggajian, dan absensi dengan mudah dan efisien. 
                    Solusi terpadu untuk manajemen sumber daya manusia yang lebih baik.
                </p>
               <div class="hero-buttons">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-rocket"></i> Mulai Sekarang
                    </a>
                    <a href="#features" class="btn btn-outline">
                        <i class="fas fa-book"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="hero-image-container">
                <img src="{{ asset('storage/karyawan/welcome.png') }}" alt="Sistem Manajemen Karyawan" class="hero-image">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title fade-in">Fitur Unggulan</h2>
            <div class="features-grid">
                <div class="feature-card fade-in delay-1">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Data Karyawan</h3>
                    <p class="feature-desc">
                        Kelola data karyawan dengan mudah dan terpusat dalam satu sistem.
                    </p>
                </div>
                
                <div class="feature-card fade-in delay-2">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="feature-title">Penggajian</h3>
                    <p class="feature-desc">
                        Sistem penggajian otomatis yang akurat dan mudah digunakan.
                    </p>
                </div>
                
                <div class="feature-card fade-in delay-3">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Absensi</h3>
                    <p class="feature-desc">
                        Pantau kehadiran karyawan secara real-time dengan sistem yang handal.
                    </p>
                </div>

                <div class="feature-card fade-in delay-3">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Laporan</h3>
                    <p class="feature-desc">
                        Hasilkan laporan lengkap untuk analisis dan pengambilan keputusan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item fade-in">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Perusahaan Menggunakan</div>
                </div>
                <div class="stat-item fade-in delay-1">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Dukungan Teknis</div>
                </div>
                <div class="stat-item fade-in delay-2">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Kepuasan Pengguna</div>
                </div>
                <div class="stat-item fade-in delay-3">
                    <div class="stat-number">5x</div>
                    <div class="stat-label">Lebih Efisien</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <a href="#" class="footer-logo"><span>SMK</span> Manajemen</a>
                    <p>Sistem modern untuk manajemen karyawan yang membantu bisnis mengelola SDM dengan lebih efisien.</p>
                    <div class="social-links" style="margin-top: 1rem; display: flex; gap: 1rem;">
                        <a href="#" style="color: #b8b8b8; font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                        <a href="#" style="color: #b8b8b8; font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color: #b8b8b8; font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: #b8b8b8; font-size: 1.2rem;"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Produk</h3>
                    <ul>
                        <li><a href="#">Fitur</a></li>
                        <li><a href="#">Harga</a></li>
                        <li><a href="#">Integrasi</a></li>
                        <li><a href="#">Pembaruan</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Perusahaan</h3>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Bantuan</h3>
                    <ul>
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">Panduan</a></li>
                        <li><a href="#">Webinar</a></li>
                        <li><a href="#">Komunitas</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2023 Sistem Manajemen Karyawan. All rights reserved.
            </div>
        </div>
    </footer>

    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fas fa-moon"></i>
    </button>

    <script>
        // Simple animation trigger on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const fadeInOnScroll = function() {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementTop < windowHeight - 100) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };
            
            // Set initial state
            fadeElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            });
            
            // Check on load
            fadeInOnScroll();
            
            // Check on scroll
            window.addEventListener('scroll', fadeInOnScroll);
            
            // Dark mode toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const icon = darkModeToggle.querySelector('i');
            
            darkModeToggle.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                
                // Update icon
                if (isDark) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            });
            
            // Set initial theme and icon
            if (localStorage.getItem('theme') === 'dark' || 
                (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });
    </script>
</body>
</html>