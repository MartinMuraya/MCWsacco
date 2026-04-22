<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Murang\'a County Women\'s Sacco - Empowering Women' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Vanilla CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @livewireStyles
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-content">
            <a href="/" class="logo">
                <span class="logo-icon"><i class="ph-fill ph-leaf"></i></span>
                <span class="logo-text">Murang'a County Women's Sacco</span>
            </a>

            <div class="nav-links" style="margin-left: 3.5rem; gap: 1.75rem;">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="/loans/apply" class="{{ request()->is('loans*') ? 'active' : '' }}">Loans</a>
                <a href="/hostels/book" class="{{ request()->is('hostels*') ? 'active' : '' }}">Hostels</a>
                <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            </div>

            <div class="nav-actions" style="margin-left: auto; gap: 1rem;">
                <button id="theme-toggle" class="theme-toggle" title="Toggle Theme">
                    <i class="ph ph-moon"></i>
                </button>
                @auth
                    @if(auth()->user()->hasRole('admin') || auth()->user()->email === 'admin@mwsacco.co.ke')
                        <a href="/admin" class="btn btn-outline btn-sm" style="border-color: var(--accent); color: var(--accent);">
                            <i class="ph ph-shield-check"></i> Admin
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                        <i class="ph ph-squares-four"></i> Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Join SACCO</a>
                @endauth
            </div>

            <button class="mobile-toggle"><i class="ph ph-list"></i></button>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="main-wrapper">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-brand" style="flex: 2;">
                <div class="logo" style="margin-bottom: 1.5rem;">
                    <span class="logo-icon" style="background: white; color: var(--primary);"><i class="ph-fill ph-leaf"></i></span>
                    <span class="logo-text" style="color: white; font-size: 1.5rem;">Murang'a County Women's Sacco</span>
                </div>
                <p style="color: rgba(255,255,255,0.7); max-width: 350px; margin-bottom: 2rem; line-height: 1.8;">Empowering women in Murang'a County through sustainable financial solutions, professional mentorship, and a community-driven approach to growth since 2012.</p>
                <div class="social-links" style="display: flex; gap: 1rem;">
                    <a href="#" class="social-icon facebook" title="Facebook"><i class="ph-fill ph-facebook-logo"></i></a>
                    <a href="#" class="social-icon twitter" title="X (Twitter)"><i class="ph-fill ph-twitter-logo"></i></a>
                    <a href="#" class="social-icon instagram" title="Instagram"><i class="ph-fill ph-instagram-logo"></i></a>
                    <a href="#" class="social-icon linkedin" title="LinkedIn"><i class="ph-fill ph-linkedin-logo"></i></a>
                </div>

                <style>
                    .social-icon {
                        width: 42px;
                        height: 42px;
                        background: rgba(255,255,255,0.08);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: rgba(255,255,255,0.8);
                        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                        text-decoration: none;
                        font-size: 1.2rem;
                    }
                    .social-icon:hover {
                        transform: translateY(-5px) scale(1.1);
                        color: white;
                        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
                    }
                    .social-icon.facebook:hover { background: #1877F2; }
                    .social-icon.twitter:hover { background: #000000; }
                    .social-icon.instagram:hover { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
                    .social-icon.linkedin:hover { background: #0077b5; }
                </style>
            </div>

            <div class="footer-links">
                <h4 style="color: white; margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 600;">Quick Navigation</h4>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <a href="/" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Home</a>
                    <a href="/about" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">About Our Journey</a>
                    <a href="/loans/apply" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Loan Products</a>
                    <a href="/hostels/book" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Student Hostels</a>
                    <a href="/contact" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Get in Touch</a>
                </div>
            </div>

            <div class="footer-links">
                <h4 style="color: white; margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 600;">Legal & Security</h4>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <a href="#" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Privacy Policy</a>
                    <a href="#" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Terms of Service</a>
                    <a href="#" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Security Standards</a>
                    <a href="#" style="color: rgba(255,255,255,0.6); text-decoration: none; transition: var(--transition);">Sacco Bylaws</a>
                </div>
            </div>

            <div class="footer-contact">
                <h4 style="color: white; margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 600;">Office Location</h4>
                <div style="display: flex; flex-direction: column; gap: 1rem; color: rgba(255,255,255,0.6);">
                    <p style="display: flex; align-items: flex-start; gap: 0.75rem;"><i class="ph ph-map-pin" style="color: var(--secondary); margin-top: 3px;"></i> 123 SACCO Plaza, 4th Floor<br>Murang'a Town, Kenya</p>
                    <p style="display: flex; align-items: center; gap: 0.75rem;"><i class="ph ph-phone" style="color: var(--secondary);"></i> +254 712 345 678</p>
                    <p style="display: flex; align-items: center; gap: 0.75rem;"><i class="ph ph-envelope" style="color: var(--secondary);"></i> info@mwsacco.co.ke</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom" style="margin-top: 4rem; padding: 2rem 0; border-top: 1px solid rgba(255,255,255,0.05);">
            <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <p style="color: rgba(255,255,255,0.4); font-size: 0.85rem;">
                    &copy; {{ date('Y') }} Murang'a County Women's Sacco. All rights reserved. 
                    | <a href="/admin" style="color: rgba(255,255,255,0.4); text-decoration: none; margin-left: 5px;">Staff Portal</a>
                </p>
                <div style="display: flex; gap: 1.5rem;">
                    <img src="https://img.icons8.com/color/48/000000/visa.png" style="height: 24px; filter: grayscale(1) opacity(0.5);" alt="Visa">
                    <img src="https://img.icons8.com/color/48/000000/mastercard.png" style="height: 24px; filter: grayscale(1) opacity(0.5);" alt="Mastercard">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/15/M-PESA_LOGO-01.svg" style="height: 20px; filter: grayscale(1) opacity(0.5);" alt="M-Pesa">
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts

    <script>
        // Theme Switching Logic
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = themeToggle.querySelector('i');
        const body = document.body;

        // Check for saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'ph ph-sun';
            } else {
                themeIcon.className = 'ph ph-moon';
            }
        }

        // Mobile Toggle Logic
        const mobileToggle = document.querySelector('.mobile-toggle');
        const navLinks = document.querySelector('.nav-links');
        const navActions = document.querySelector('.nav-actions');

        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                navActions.classList.toggle('active');
                
                const icon = mobileToggle.querySelector('i');
                if (navLinks.classList.contains('active')) {
                    icon.className = 'ph ph-x';
                } else {
                    icon.className = 'ph ph-list';
                }
            });
        }
    </script>
</body>
</html>
