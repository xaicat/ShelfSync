<x-user-layout>
    <div class="container-fostrap mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="hero-wrapper" style="position: relative; padding: 0 40px;">
                        <div class="product-slider overflow-hidden" style="border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.5);">
                            
                            <div class="slider-item active" style="background: linear-gradient(135deg, rgba(30, 144, 255, 0.2), rgba(10, 26, 46, 0.9)); backdrop-filter: blur(15px); padding: 50px;">
                                <div class="row align-items-center">
                                    <div class="col-md-6 text-center">
                                        <img src="https://images.unsplash.com/photo-1519163219899-21d2bb723b3e?w=600" class="img-fluid rounded-lg shadow-lg floating-img" alt="Academic Books">
                                    </div>
                                    <div class="col-md-6 slider-details text-left">
                                        <h1 class="display-4 text-white font-weight-bold">Academics</h1>
                                        <p class="lead text-light">Premium resources for SWE & CSE students. Rent the latest editions today!</p>
                                        <div class="rating mb-3">
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                                            <span class="text-white ml-2">(Top Rated)</span>
                                        </div>
                                        <h3 class="text-info mb-4">{{ $bookCount }} Copies Currently in Stock</h3>
                                        <div class="mb-4">
                                            <span class="badge badge-primary px-3 py-2">Software Engineering</span>
                                            <span class="badge badge-info px-3 py-2">Computer Science</span>
                                        </div>
                                        <a href="{{ route('user.books') }}" class="btn btn-modern btn-lg">Explore Library</a>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item" style="background: linear-gradient(135deg, rgba(77, 168, 218, 0.2), rgba(10, 26, 46, 0.9)); backdrop-filter: blur(15px); padding: 50px;">
                                <div class="row align-items-center">
                                    <div class="col-md-6 text-center">
                                        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600" class="img-fluid rounded-lg shadow-lg floating-img" alt="Digital Library">
                                    </div>
                                    <div class="col-md-6 slider-details text-left">
                                        <h1 class="display-4 text-white font-weight-bold">Research Papers</h1>
                                        <p class="lead text-light">Access a wide range of IEEE journals and research publications locally.</p>
                                        <div class="rating mb-3">
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star-half text-warning"></i>
                                        </div>
                                        <h3 class="text-success mb-4">New Additions Weekly</h3>
                                        <a href="{{ route('user.books') }}" class="btn btn-modern btn-lg">View Collections</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
                        <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5 pt-4">
                <div class="col-lg-5 mb-4">
                    <div class="action-card h-100">
                        <div class="card-img-container">
                            <img src="https://images.unsplash.com/photo-1535905557558-afc4877a26fc?w=600" class="card-img-top" alt="Books List">
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-white">Books Inventory</h3>
                            <p class="text-muted">Browse through thousands of titles across all engineering departments.</p>
                            <a href="{{ route('user.books') }}" class="btn btn-outline-primary btn-rounded px-5">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-4">
                    <div class="action-card h-100">
                        <div class="card-img-container">
                            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=600" class="card-img-top" alt="Contact Librarian">
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-white">Direct Support</h3>
                            <p class="text-muted">Have a specific request? Contact our librarians for personalized assistance.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-info btn-rounded px-5">Get Help</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@400;500;600;700;800&display=swap');
        :root {
            --deep:          #04080f;
            --deep-alt:      #080e1a;
            --surface:       rgba(255,255,255,0.035);
            --surface-hover: rgba(255,255,255,0.07);
            --surface-active:rgba(255,255,255,0.1);
            --rim:           rgba(255,255,255,0.06);
            --rim-strong:    rgba(255,255,255,0.12);
            --azure:         #3b82f6;
            --azure-deep:    #1d4ed8;
            --azure-glow:    rgba(59,130,246,0.35);
            --electric:      #06d6a0;
            --electric-soft: rgba(6,214,160,0.12);
            --electric-glow: rgba(6,214,160,0.3);
            --violet:        #8b5cf6;
            --violet-glow:   rgba(139,92,246,0.25);
            --rose:          #f43f5e;
            --gold:          #fbbf24;
            --gold-glow:     rgba(251,191,36,0.4);
            --white-dim:     rgba(255,255,255,0.5);
            --white-soft:    rgba(255,255,255,0.7);
            --font-display:  'Syne', sans-serif;
            --font-body:     'Space Grotesk', sans-serif;
            --r-card:        24px;
            --r-slider:      24px;
            --glass-bg:      rgba(255,255,255,0.03);
            --glass-border:  rgba(255,255,255,0.08);
            --glass-blur:    blur(40px) saturate(1.8);
        }
        /* ══════════════════════════════════════════════════
           GLOBAL RESETS & DARK BODY
        ══════════════════════════════════════════════════ */
        body {
            background: var(--deep) !important;
            color: rgba(255,255,255,0.8) !important;
            overflow-x: hidden;
        }
        /* Noise texture overlay */
        .container-fostrap::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9000;
            opacity: 0.5;
        }
        /* Mesh gradient background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(59,130,246,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(139,92,246,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 50% 70% at 50% 90%, rgba(6,214,160,0.04) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }
        /* ══════════════════════════════════════════════════
           SCROLL PROGRESS BAR
        ══════════════════════════════════════════════════ */
        #nav-scroll-bar {
            position: fixed;
            top: 0; left: 0;
            height: 3px; width: 0%;
            background: linear-gradient(90deg, var(--azure), var(--electric), var(--violet));
            box-shadow: 0 0 20px rgba(6,214,160,0.6), 0 0 40px rgba(59,130,246,0.3);
            z-index: 99999;
            pointer-events: none;
            transition: width 0.08s linear;
            border-radius: 0 2px 2px 0;
        }
        /* ══════════════════════════════════════════════════
           NAVBAR — Full Glass Morphism Restyle
        ══════════════════════════════════════════════════ */
        .navbar {
            position: fixed !important;
            top: 0 !important; left: 0 !important; right: 0 !important;
            z-index: 9000 !important;
            padding: 14px 20px !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .navbar > .container,
        .navbar > .container-fluid {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            background: rgba(4, 8, 15, 0.6) !important;
            backdrop-filter: var(--glass-blur) !important;
            -webkit-backdrop-filter: var(--glass-blur) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 16px !important;
            padding: 6px 8px 6px 18px !important;
            box-shadow:
                0 0 0 1px rgba(59,130,246,0.04),
                0 8px 32px rgba(0,0,0,0.4),
                0 32px 64px rgba(0,0,0,0.2),
                inset 0 1px 0 rgba(255,255,255,0.04) !important;
            transition: all 0.5s cubic-bezier(0.16,1,0.3,1) !important;
            animation: navDrop 0.8s cubic-bezier(0.16,1,0.3,1) both !important;
        }
        .navbar > .container.scrolled,
        .navbar > .container-fluid.scrolled {
            background: rgba(4, 8, 15, 0.88) !important;
            border-color: rgba(59,130,246,0.12) !important;
            box-shadow:
                0 0 0 1px rgba(59,130,246,0.08),
                0 16px 48px rgba(0,0,0,0.5),
                inset 0 1px 0 rgba(255,255,255,0.03) !important;
        }
        @keyframes navDrop {
            from { opacity: 0; transform: translateY(-20px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        /* ── BRAND ─────────────────────────────────────── */
        .navbar-brand {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            padding: 0 !important;
            margin-right: 0 !important;
            text-decoration: none !important;
            flex-shrink: 0;
        }
        .navbar-brand::before {
            content: '\f518';
            font-family: 'Font Awesome 5 Free', 'Font Awesome 6 Free';
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px; height: 36px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--azure), var(--violet));
            color: #fff;
            font-size: 0.85rem;
            box-shadow: 0 4px 20px var(--azure-glow), inset 0 1px 0 rgba(255,255,255,0.2);
            flex-shrink: 0;
        }
        .navbar-brand,
        .navbar-brand * {
            font-family: var(--font-display) !important;
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.06em !important;
            background: linear-gradient(135deg, #fff 30%, var(--electric) 70%, var(--azure)) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            line-height: 1 !important;
        }
        /* ── NAV LINKS ─────────────────────────────────── */
        .navbar-nav {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 2px !important;
            list-style: none !important;
            margin: 0 !important; padding: 0 !important;
            position: absolute !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
        }
        .navbar-nav .nav-item { position: relative; }
        .navbar-nav .nav-link {
            font-family: var(--font-body) !important;
            font-size: 0.82rem !important;
            font-weight: 400 !important;
            letter-spacing: 0.03em !important;
            color: rgba(255,255,255,0.45) !important;
            padding: 8px 16px !important;
            border-radius: 10px !important;
            text-decoration: none !important;
            transition: all 0.25s cubic-bezier(0.16,1,0.3,1) !important;
            white-space: nowrap;
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
            position: relative;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
            color: #fff !important;
            background: var(--surface-hover) !important;
        }
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-item.active > .nav-link {
            color: #fff !important;
            background: rgba(59,130,246,0.1) !important;
            box-shadow: inset 0 0 0 1px rgba(59,130,246,0.15);
        }
        /* Animated indicator */
        #nav-indicator {
            position: absolute;
            bottom: -3px; left: 0;
            height: 2px; width: 0;
            background: linear-gradient(90deg, var(--azure), var(--electric));
            border-radius: 2px;
            box-shadow: 0 0 12px var(--azure-glow), 0 0 4px var(--electric-glow);
            transition: left 0.4s cubic-bezier(0.34,1.56,0.64,1), width 0.4s cubic-bezier(0.34,1.56,0.64,1);
            pointer-events: none;
        }
        /* ── DROPDOWNS ─────────────────────────────────── */
        .navbar-nav .dropdown-menu {
            background: rgba(4, 8, 15, 0.92) !important;
            backdrop-filter: var(--glass-blur) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 14px !important;
            padding: 6px !important;
            box-shadow: 0 24px 64px rgba(0,0,0,0.6), 0 0 0 1px rgba(59,130,246,0.06), inset 0 1px 0 rgba(255,255,255,0.03) !important;
            margin-top: 10px !important;
            min-width: 200px !important;
            animation: dropIn 0.3s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-8px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .navbar-nav .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -5px; left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 10px; height: 10px;
            background: rgba(4, 8, 15, 0.92);
            border-left: 1px solid var(--glass-border);
            border-top: 1px solid var(--glass-border);
        }
        .navbar-nav .dropdown-item {
            font-family: var(--font-body) !important;
            font-size: 0.82rem !important;
            color: rgba(255,255,255,0.55) !important;
            padding: 10px 14px !important;
            border-radius: 8px !important;
            transition: all 0.2s !important;
        }
        .navbar-nav .dropdown-item:hover {
            background: var(--surface-hover) !important;
            color: #fff !important;
        }
        .navbar-nav .dropdown-item:active {
            background: rgba(59,130,246,0.15) !important;
        }
        /* ── RIGHT SIDE NAV ────────────────────────────── */
        .navbar-nav.ml-auto,
        .navbar > .container > .navbar-nav:last-child,
        .navbar > .container-fluid > .navbar-nav:last-child {
            position: static !important;
            transform: none !important;
            flex-direction: row !important;
            gap: 6px !important;
            margin-left: auto !important;
        }
        .navbar-nav.ml-auto .nav-link,
        .navbar > .container > .navbar-nav:last-child .nav-link,
        .navbar > .container-fluid > .navbar-nav:last-child .nav-link {
            font-family: var(--font-body) !important;
            font-size: 0.8rem !important;
            font-weight: 500 !important;
            letter-spacing: 0.04em !important;
            color: rgba(255,255,255,0.55) !important;
            padding: 8px 18px !important;
            border-radius: 10px !important;
            border: 1px solid transparent !important;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1) !important;
        }
        .navbar-nav.ml-auto .nav-link:hover,
        .navbar > .container > .navbar-nav:last-child .nav-link:hover,
        .navbar > .container-fluid > .navbar-nav:last-child .nav-link:hover {
            color: #fff !important;
            background: var(--surface-hover) !important;
            border-color: var(--rim) !important;
        }
        /* CTA button */
        .navbar-nav.ml-auto .nav-item:last-child .nav-link,
        .navbar > .container > .navbar-nav:last-child .nav-item:last-child .nav-link,
        .navbar > .container-fluid > .navbar-nav:last-child .nav-item:last-child .nav-link {
            background: linear-gradient(135deg, var(--azure), var(--violet)) !important;
            color: #fff !important;
            border-color: transparent !important;
            box-shadow: 0 4px 20px var(--azure-glow), inset 0 1px 0 rgba(255,255,255,0.15) !important;
            position: relative;
            overflow: hidden;
        }
        .navbar-nav.ml-auto .nav-item:last-child .nav-link::before,
        .navbar > .container > .navbar-nav:last-child .nav-item:last-child .nav-link::before,
        .navbar > .container-fluid > .navbar-nav:last-child .nav-item:last-child .nav-link::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        .navbar-nav.ml-auto .nav-item:last-child .nav-link:hover::before,
        .navbar > .container > .navbar-nav:last-child .nav-item:last-child .nav-link:hover::before,
        .navbar > .container-fluid > .navbar-nav:last-child .nav-item:last-child .nav-link:hover::before {
            left: 100%;
        }
        .navbar-nav.ml-auto .nav-item:last-child .nav-link:hover,
        .navbar > .container > .navbar-nav:last-child .nav-item:last-child .nav-link:hover,
        .navbar > .container-fluid > .navbar-nav:last-child .nav-item:last-child .nav-link:hover {
            transform: translateY(-2px) scale(1.04) !important;
            box-shadow: 0 12px 36px var(--azure-glow), 0 0 0 1px rgba(139,92,246,0.3) !important;
        }
        /* ── TOGGLER (mobile burger) — COMPLETELY REBUILT ── */
        .navbar-toggler {
            width: 40px !important; height: 40px !important;
            padding: 0 !important;
            border-radius: 12px !important;
            background: var(--surface) !important;
            border: 1px solid var(--glass-border) !important;
            display: none !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1) !important;
            position: relative !important;
            z-index: 9999 !important;
            flex-direction: column !important;
            gap: 0 !important;
        }
        .navbar-toggler:hover {
            background: var(--surface-hover) !important;
            border-color: rgba(59,130,246,0.3) !important;
            box-shadow: 0 0 20px rgba(59,130,246,0.15) !important;
        }
        .navbar-toggler:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(59,130,246,0.3) !important;
        }
        /* Custom burger lines via the toggler-icon */
        .navbar-toggler-icon {
            background-image: none !important;
            width: 18px !important; height: 2px !important;
            background: rgba(255,255,255,0.7) !important;
            position: relative;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1) !important;
            border-radius: 2px;
        }
        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            position: absolute;
            left: 0; width: 100%; height: 100%;
            background: rgba(255,255,255,0.7);
            border-radius: 2px;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
        }
        .navbar-toggler-icon::before { top: -6px; }
        .navbar-toggler-icon::after  { top:  6px; }
        /* X state */
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon,
        .navbar-toggler.is-open .navbar-toggler-icon {
            background: transparent !important;
        }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before,
        .navbar-toggler.is-open .navbar-toggler-icon::before {
            transform: translateY(6px) rotate(45deg);
            background: var(--electric);
        }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after,
        .navbar-toggler.is-open .navbar-toggler-icon::after {
            transform: translateY(-6px) rotate(-45deg);
            background: var(--electric);
        }
        @media (max-width: 991px) {
            .navbar-toggler {
                display: flex !important;
            }
        }
        /* ── Mobile collapse ─────────────────────────── */
        .navbar-collapse {
            background: rgba(4, 8, 15, 0.95) !important;
            backdrop-filter: var(--glass-blur) !important;
            -webkit-backdrop-filter: var(--glass-blur) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 16px !important;
            margin-top: 10px !important;
            padding: 12px 10px !important;
            box-shadow: 0 24px 64px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.03) !important;
        }
        @media (min-width: 992px) {
            .navbar-collapse {
                background: transparent !important;
                border: none !important;
                border-radius: 0 !important;
                margin-top: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                backdrop-filter: none !important;
                display: flex !important;
                align-items: center !important;
                width: 100% !important;
            }
        }
        @media (max-width: 991px) {
            .navbar-nav {
                position: static !important;
                transform: none !important;
                flex-direction: column !important;
            }
            .navbar-nav .nav-link {
                justify-content: flex-start !important;
                padding: 12px 16px !important;
            }
            .navbar-nav.ml-auto,
            .navbar > .container > .navbar-nav:last-child,
            .navbar > .container-fluid > .navbar-nav:last-child {
                margin-left: 0 !important;
                border-top: 1px solid var(--rim) !important;
                margin-top: 8px !important;
                padding-top: 8px !important;
                flex-direction: column !important;
            }
        }
        /* ── SEARCH OVERLAY ──────────────────────────── */
        #nav-search-overlay {
            position: fixed; inset: 0; z-index: 9800;
            background: rgba(2,4,8,0.88);
            backdrop-filter: blur(30px) saturate(1.5);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 130px;
            opacity: 0; pointer-events: none;
            transition: opacity 0.35s cubic-bezier(0.16,1,0.3,1);
        }
        #nav-search-overlay.open { opacity: 1; pointer-events: all; }
        #nav-search-box { width: 100%; max-width: 620px; margin: 0 24px; animation: searchIn 0.4s cubic-bezier(0.16,1,0.3,1) both; }
        @keyframes searchIn {
            from { opacity: 0; transform: translateY(-16px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        #nav-search-input-wrap {
            display: flex; align-items: center;
            background: rgba(4, 8, 15, 0.85);
            border: 1px solid rgba(59,130,246,0.3);
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.08), 0 24px 64px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.04);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        #nav-search-input-wrap:focus-within {
            border-color: var(--azure);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.15), 0 24px 64px rgba(0,0,0,0.5), 0 0 40px rgba(59,130,246,0.1);
        }
        #nav-search-input-wrap .si { padding: 0 18px; color: var(--azure); font-size: 1rem; flex-shrink: 0; }
        #nav-search-field {
            flex: 1; background: transparent; border: none; outline: none;
            padding: 22px 0; font-family: var(--font-body); font-size: 1.05rem;
            font-weight: 300; color: #e8f0ff; letter-spacing: 0.02em;
        }
        #nav-search-field::placeholder { color: rgba(255,255,255,0.18); }
        #nav-search-close {
            padding: 0 18px; background: none; border: none;
            color: rgba(255,255,255,0.25); font-size: 0.9rem; cursor: pointer;
            transition: color 0.2s, transform 0.2s; flex-shrink: 0;
        }
        #nav-search-close:hover { color: #fff; transform: scale(1.15); }
        #nav-search-hint {
            margin-top: 16px; text-align: center;
            font-family: var(--font-body); font-size: 0.76rem;
            color: rgba(255,255,255,0.18); letter-spacing: 0.06em;
        }
        #nav-search-hint kbd {
            background: var(--surface); border: 1px solid var(--rim);
            border-radius: 6px; padding: 2px 8px;
            font-family: var(--font-body); font-size: 0.72rem;
            color: rgba(255,255,255,0.4);
        }
        /* ── SEARCH BUTTON ───────────────────────────── */
        #nav-search-btn {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--surface); border: 1px solid var(--glass-border);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.4); font-size: 0.82rem; cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            flex-shrink: 0; margin-right: 8px;
        }
        #nav-search-btn:hover {
            background: var(--surface-hover);
            border-color: rgba(59,130,246,0.3);
            color: #fff;
            transform: scale(1.1);
            box-shadow: 0 0 16px rgba(59,130,246,0.2);
        }
        /* Body padding for fixed nav */
        body { padding-top: 88px !important; }
        /* ══════════════════════════════════════════════════
           CUSTOM CURSOR
        ══════════════════════════════════════════════════ */
        * { cursor: none !important; }
        #cursor-dot, #cursor-ring {
            position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 99999; mix-blend-mode: difference;
        }
        #cursor-dot {
            width: 6px; height: 6px;
            background: #fff;
            transform: translate(-50%,-50%);
            box-shadow: 0 0 8px rgba(255,255,255,0.5);
        }
        #cursor-ring {
            width: 40px; height: 40px;
            border: 1.5px solid rgba(255,255,255,0.4);
            transform: translate(-50%,-50%);
            transition: width 0.35s cubic-bezier(0.16,1,0.3,1), height 0.35s cubic-bezier(0.16,1,0.3,1), border-color 0.35s, background 0.35s;
        }
        body:has(a:hover) #cursor-ring,
        body:has(button:hover) #cursor-ring {
            width: 60px; height: 60px;
            border-color: var(--electric);
            background: rgba(6,214,160,0.05);
        }
        /* ══════════════════════════════════════════════════
           PARTICLE CANVAS
        ══════════════════════════════════════════════════ */
        #particle-canvas {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 0; opacity: 0.45;
        }
        /* ══════════════════════════════════════════════════
           AMBIENT BLOBS — Reimagined
        ══════════════════════════════════════════════════ */
        .blob {
            position: fixed; border-radius: 50%;
            filter: blur(140px); pointer-events: none; z-index: 0;
            will-change: transform; opacity: 0.7;
        }
        .blob-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 65%);
            top: -180px; left: -100px;
            animation: blobMove1 24s ease-in-out infinite;
        }
        .blob-2 {
            width: 450px; height: 450px;
            background: radial-gradient(circle, rgba(139,92,246,0.08) 0%, transparent 65%);
            top: 30%; right: -80px;
            animation: blobMove2 30s ease-in-out infinite;
        }
        .blob-3 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(6,214,160,0.06) 0%, transparent 65%);
            bottom: 8%; left: 20%;
            animation: blobMove3 22s ease-in-out infinite;
        }
        @keyframes blobMove1 { 0%,100%{transform:translate(0,0) scale(1);}40%{transform:translate(80px,-50px) scale(1.1);}70%{transform:translate(-40px,40px) scale(0.92);} }
        @keyframes blobMove2 { 0%,100%{transform:translate(0,0) scale(1);}50%{transform:translate(-60px,50px) scale(1.08);} }
        @keyframes blobMove3 { 0%,100%{transform:translate(0,0) scale(1);}60%{transform:translate(50px,-40px) scale(1.12);} }
        /* ══════════════════════════════════════════════════
           HERO SLIDER — Fixed Height + Glass Morphism
        ══════════════════════════════════════════════════ */
        .container-fostrap { position: relative; }
        .container-fostrap > .container { position: relative; z-index: 1; }
        .hero-wrapper { perspective: 1200px !important; }
        .product-slider {
            position: relative;
            border-radius: var(--r-slider) !important;
            border: 1px solid var(--glass-border) !important;
            background: transparent !important;
            box-shadow:
                0 0 0 1px rgba(59,130,246,0.06),
                0 40px 80px rgba(0,0,0,0.5),
                0 0 120px rgba(59,130,246,0.04),
                inset 0 1px 0 rgba(255,255,255,0.05) !important;
            overflow: hidden !important;
        }
        /* Rotating border glow */
        .product-slider::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: calc(var(--r-slider) + 2px);
            background: conic-gradient(from var(--angle,0deg), transparent 0deg, var(--azure) 40deg, var(--electric) 80deg, var(--violet) 120deg, transparent 180deg, transparent 360deg);
            animation: spinBorder 6s linear infinite;
            z-index: 0;
            pointer-events: none;
            opacity: 0.6;
        }
        .product-slider::after {
            content: '';
            position: absolute;
            inset: 1px;
            border-radius: calc(var(--r-slider) - 1px);
            background: var(--deep);
            z-index: 0;
            pointer-events: none;
        }
        @property --angle { syntax: '<angle>'; initial-value: 0deg; inherits: false; }
        @keyframes spinBorder { to { --angle: 360deg; } }
        /* FIXED: Same height for all slider items */
        .slider-item {
            display: none;
            position: relative;
            z-index: 2;
            min-height: 420px;
            background: transparent !important;
            animation: sliderIn 0.7s cubic-bezier(0.16,1,0.3,1) both;
        }
        .slider-item.active { display: flex; align-items: center; }
        /* Inner padding via the row */
        .slider-item .row {
            position: relative;
            z-index: 1;
            width: 100%;
            padding: 50px;
            min-height: 420px;
            display: flex;
            align-items: center;
        }
        @keyframes sliderIn {
            0% { opacity: 0; transform: translateX(30px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        /* Inner glow overlay */
        .slider-item::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 70% 50%, rgba(59,130,246,0.05), transparent),
                radial-gradient(ellipse 50% 80% at 10% 50%, rgba(0,0,0,0.35), transparent),
                radial-gradient(ellipse 40% 40% at 90% 90%, rgba(139,92,246,0.04), transparent);
            pointer-events: none;
            z-index: 0;
        }
        /* Floating image */
        .floating-img {
            animation: hoverFloat 8s ease-in-out infinite !important;
            border-radius: 20px !important;
            border: 1px solid rgba(255,255,255,0.08) !important;
            box-shadow:
                0 4px 0 rgba(255,255,255,0.03),
                0 24px 48px rgba(0,0,0,0.5),
                0 0 80px rgba(59,130,246,0.08),
                inset 0 1px 0 rgba(255,255,255,0.1) !important;
            transition: all 0.5s cubic-bezier(0.16,1,0.3,1) !important;
            max-height: 320px;
            object-fit: cover;
        }
        @keyframes hoverFloat {
            0%,100% { transform: translateY(0px) rotate(-0.5deg); }
            33% { transform: translateY(-12px) rotate(0.3deg); }
            66% { transform: translateY(-18px) rotate(-0.3deg); }
        }
        /* Holographic shimmer on image container */
        .col-md-6.text-center { position: relative; }
        .col-md-6.text-center::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent 30%, rgba(59,130,246,0.05) 42%, rgba(6,214,160,0.06) 50%, rgba(139,92,246,0.05) 58%, transparent 70%);
            background-size: 200% 200%;
            animation: holoShimmer 5s ease-in-out infinite;
            pointer-events: none;
            border-radius: 20px;
            z-index: 2;
        }
        @keyframes holoShimmer { 0%,100%{background-position:200% 200%;opacity:0.4;}50%{background-position:0% 0%;opacity:1;} }
        /* Slider text styles */
        .slider-details h1.display-4 {
            font-family: var(--font-display) !important;
            font-size: clamp(2.5rem, 5vw, 1.5rem) !important;
            font-weight: 700 !important;
            letter-spacing: -0.02em !important;
            line-height: 1 !important;
            background: linear-gradient(170deg, #ffffff 25%, rgba(59,130,246,0.9) 60%, var(--electric));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 18px !important;
            animation: textReveal 0.8s 0.15s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes textReveal { from{opacity:0;transform:translateY(20px);filter:blur(6px);}to{opacity:1;transform:translateY(0);filter:blur(0);} }
        .slider-details .lead {
            font-family: var(--font-body) !important;
            font-weight: 300 !important;
            font-size: 1rem !important;
            color: rgba(255,255,255,0.5) !important;
            line-height: 1.7 !important;
            animation: textReveal 0.8s 0.3s cubic-bezier(0.16,1,0.3,1) both;
        }
        .rating { animation: textReveal 0.8s 0.4s cubic-bezier(0.16,1,0.3,1) both; }
        .fa-star, .fa-star-half {
            color: var(--gold) !important;
            filter: drop-shadow(0 0 6px var(--gold-glow)) !important;
            font-size: 0.9rem !important;
        }
        .rating .text-white {
            font-family: var(--font-body);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            color: var(--white-dim) !important;
        }
        .text-info {
            font-family: var(--font-body) !important;
            font-weight: 500 !important;
            font-size: 1.05rem !important;
            color: var(--electric) !important;
            text-shadow: 0 0 24px var(--electric-glow) !important;
            letter-spacing: 0.01em !important;
            animation: textReveal 0.8s 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        .text-success {
            font-family: var(--font-body) !important;
            font-weight: 500 !important;
            font-size: 1.05rem !important;
            color: #34d399 !important;
            text-shadow: 0 0 24px rgba(52,211,153,0.4) !important;
            animation: textReveal 0.8s 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        /* Badges */
        .badge-primary, .badge-info {
            font-family: var(--font-body) !important;
            font-size: 0.72rem !important;
            font-weight: 500 !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase;
            border-radius: 100px !important;
            padding: 7px 16px !important;
            backdrop-filter: blur(12px);
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            display: inline-block;
        }
        .badge-primary {
            background: rgba(59,130,246,0.12) !important;
            color: rgba(147,197,253,0.9) !important;
            border: 1px solid rgba(59,130,246,0.25) !important;
        }
        .badge-primary:hover {
            background: rgba(59,130,246,0.2) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(59,130,246,0.2);
        }
        .badge-info {
            background: rgba(6,214,160,0.08) !important;
            color: var(--electric) !important;
            border: 1px solid rgba(6,214,160,0.2) !important;
        }
        .badge-info:hover {
            background: rgba(6,214,160,0.15) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px var(--electric-glow);
        }
        /* CTA Button */
        .btn-modern {
            font-family: var(--font-body) !important;
            font-weight: 600 !important;
            font-size: 0.88rem !important;
            letter-spacing: 0.06em !important;
            text-transform: uppercase;
            color: #fff !important;
            background: linear-gradient(135deg, var(--azure), var(--azure-deep)) !important;
            border: none !important;
            border-radius: 14px !important;
            padding: 14px 36px !important;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1) !important;
            box-shadow: 0 8px 32px var(--azure-glow), inset 0 1px 0 rgba(255,255,255,0.15) !important;
            animation: textReveal 0.8s 0.65s cubic-bezier(0.16,1,0.3,1) both;
        }
        .btn-modern::before {
            content: '';
            position: absolute;
            width: 120%; height: 120%;
            top: -10%; left: -110%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), rgba(255,255,255,0.08), transparent);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
        }
        .btn-modern:hover::before { left: 110%; }
        .btn-modern:hover {
            transform: translateY(-4px) scale(1.04) !important;
            box-shadow: 0 20px 50px var(--azure-glow), 0 0 0 1px rgba(59,130,246,0.3), 0 0 60px rgba(59,130,246,0.15) !important;
        }
        /* Slider Arrows */
        .slider-arrow {
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            width: 50px !important; height: 50px !important;
            background: rgba(4, 8, 15, 0.6) !important;
            border: 1px solid var(--glass-border) !important;
            backdrop-filter: var(--glass-blur) !important;
            border-radius: 14px !important;
            color: rgba(255,255,255,0.5) !important;
            font-size: 0.85rem !important;
            cursor: pointer;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1) !important;
            z-index: 100 !important;
        }
        .slider-arrow:hover {
            background: linear-gradient(135deg, var(--azure), var(--violet)) !important;
            border-color: transparent !important;
            color: #fff !important;
            transform: translateY(-50%) scale(1.15) !important;
            box-shadow: 0 0 0 6px rgba(59,130,246,0.1), 0 0 32px var(--azure-glow) !important;
        }
        .prev { left: -25px !important; }
        .next { right: -25px !important; }
        /* Slider Progress & Dots */
        .slider-progress-track {
            width: 100%; height: 2px;
            background: rgba(255,255,255,0.04);
            overflow: hidden;
            border-radius: 2px;
            margin-top: 4px;
        }
        .slider-progress-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, var(--azure), var(--electric), var(--violet));
            box-shadow: 0 0 16px var(--electric-glow);
            border-radius: 2px;
        }
        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .slider-dot {
            width: 6px; height: 6px;
            border-radius: 100px;
            background: rgba(255,255,255,0.1);
            border: none;
            cursor: pointer;
            padding: 0;
            transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
        }
        .slider-dot:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.3);
        }
        .slider-dot.active {
            width: 32px;
            background: linear-gradient(90deg, var(--azure), var(--electric));
            box-shadow: 0 0 14px var(--azure-glow);
        }
        /* ══════════════════════════════════════════════════
           ACTION CARDS — Glass Morphism Redesign
        ══════════════════════════════════════════════════ */
        .action-card {
            background: rgba(255,255,255,0.025) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: var(--r-card) !important;
            overflow: hidden !important;
            backdrop-filter: blur(24px) saturate(1.4) !important;
            transition: all 0.5s cubic-bezier(0.16,1,0.3,1) !important;
            position: relative;
        }
        /* Spotlight follow */
        .action-card::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(650px circle at var(--mx,50%) var(--my,50%), rgba(59,130,246,0.08) 0%, rgba(139,92,246,0.04) 30%, transparent 60%);
            pointer-events: none;
            z-index: 0;
            opacity: 0;
            transition: opacity 0.5s;
        }
        .action-card:hover::before { opacity: 1; }
        /* Top edge glow */
        .action-card::after {
            content: '';
            position: absolute;
            top: 0; left: 8%; right: 8%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59,130,246,0.4) 25%, var(--electric) 50%, rgba(139,92,246,0.4) 75%, transparent);
            opacity: 0;
            transition: opacity 0.4s;
        }
        .action-card:hover::after { opacity: 1; }
        .action-card:hover {
            transform: translateY(-16px) scale(1.01) !important;
            border-color: rgba(59,130,246,0.2) !important;
            box-shadow:
                0 40px 80px rgba(0,0,0,0.5),
                0 0 0 1px rgba(59,130,246,0.06) inset,
                0 0 80px rgba(59,130,246,0.05) !important;
        }
        .card-img-container {
            position: relative;
            height: 220px !important;
            overflow: hidden;
        }
        .card-img-top {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: all 0.8s cubic-bezier(0.16,1,0.3,1) !important;
            filter: saturate(0.7) brightness(0.8);
        }
        .action-card:hover .card-img-top {
            transform: scale(1.08) !important;
            filter: saturate(1) brightness(0.9);
        }
        .img-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to bottom, rgba(4,8,15,0) 10%, rgba(4,8,15,0.4) 50%, rgba(4,8,15,0.98) 100%) !important;
        }
        .card-chip {
            position: absolute;
            top: 16px; left: 16px;
            background: rgba(4,8,15,0.6);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 100px;
            padding: 5px 14px;
            font-family: var(--font-body);
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--white-dim);
            z-index: 2;
        }
        .action-card .card-body {
            position: relative;
            z-index: 1;
            padding: 24px 28px 30px !important;
        }
        .action-card .card-body h3 {
            font-family: var(--font-display) !important;
            font-size: 1.7rem !important;
            font-weight: 700 !important;
            letter-spacing: -0.01em !important;
            color: #fff !important;
            margin-bottom: 10px !important;
        }
        .action-card .card-body p.text-muted {
            font-family: var(--font-body) !important;
            font-weight: 300 !important;
            font-size: 0.86rem !important;
            line-height: 1.65 !important;
            color: rgba(255,255,255,0.4) !important;
            margin-bottom: 22px !important;
        }
        /* Card buttons */
        .btn-rounded {
            font-family: var(--font-body) !important;
            font-weight: 500 !important;
            font-size: 0.8rem !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase;
            border-radius: 100px !important;
            border-width: 1px !important;
            padding: 10px 28px !important;
            backdrop-filter: blur(8px);
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1) !important;
        }
        .btn-outline-primary {
            border-color: rgba(59,130,246,0.3) !important;
            color: rgba(147,197,253,0.9) !important;
            background: rgba(59,130,246,0.05) !important;
        }
        .btn-outline-primary:hover {
            background: rgba(59,130,246,0.15) !important;
            border-color: var(--azure) !important;
            color: #fff !important;
            transform: translateY(-3px) scale(1.05) !important;
            box-shadow: 0 0 28px var(--azure-glow), 0 8px 24px rgba(59,130,246,0.2) !important;
        }
        .btn-outline-info {
            border-color: rgba(6,214,160,0.25) !important;
            color: var(--electric) !important;
            background: rgba(6,214,160,0.04) !important;
        }
        .btn-outline-info:hover {
            background: rgba(6,214,160,0.12) !important;
            border-color: var(--electric) !important;
            color: #fff !important;
            transform: translateY(-3px) scale(1.05) !important;
            box-shadow: 0 0 28px var(--electric-glow), 0 8px 24px rgba(6,214,160,0.2) !important;
        }
        /* ══════════════════════════════════════════════════
           PAGE ENTRANCE ANIMATIONS
        ══════════════════════════════════════════════════ */
        .hero-wrapper {
            animation: pageIn 1s 0.1s cubic-bezier(0.16,1,0.3,1) both;
        }
        .row.justify-content-center.mt-5 {
            animation: pageIn 1s 0.4s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes pageIn {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .tilt-target {
            transform-style: preserve-3d;
            transition: transform 0.12s ease-out;
            will-change: transform;
        }
        /* ══════════════════════════════════════════════════
           RESPONSIVE TWEAKS
        ══════════════════════════════════════════════════ */
        @media (max-width: 767px) {
            .slider-item .row {
                padding: 30px 20px;
                min-height: 500px;
                flex-direction: column;
            }
            .slider-item {
                min-height: 500px;
            }
            .floating-img {
                max-height: 200px;
                margin-bottom: 24px;
            }
            .slider-details h1.display-4 {
                font-size: 2.2rem !important;
                text-align: center;
            }
            .slider-details .lead,
            .slider-details .rating,
            .slider-details .text-info,
            .slider-details .text-success {
                text-align: center;
            }
            .slider-details .mb-4 { text-align: center; }
            .slider-details { text-align: center; }
            .slider-arrow { display: none !important; }
            .hero-wrapper { padding: 0 16px !important; }
        }
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--deep);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(59,130,246,0.2);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(59,130,246,0.4);
        }
        /* Selection color */
        ::selection {
            background: rgba(59,130,246,0.3);
            color: #fff;
        }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        /* ══════════════════════════════════════════════
           1. SCROLL PROGRESS BAR
        ══════════════════════════════════════════════ */
        const scrollBar = document.createElement('div');
        scrollBar.id = 'nav-scroll-bar';
        document.body.prepend(scrollBar);
        window.addEventListener('scroll', () => {
            const s = document.documentElement;
            const pct = s.scrollTop / (s.scrollHeight - s.clientHeight) * 100;
            scrollBar.style.width = (isNaN(pct) ? 0 : pct) + '%';
        }, { passive: true });
        /* ══════════════════════════════════════════════
           2. NAVBAR ENHANCEMENTS
        ══════════════════════════════════════════════ */
        const navbar = document.querySelector('.navbar');
        const navInner = navbar
            ? (navbar.querySelector('.container') || navbar.querySelector('.container-fluid') || navbar)
            : null;
        // Scrolled class
        if (navInner) {
            window.addEventListener('scroll', () => {
                navInner.classList.toggle('scrolled', window.scrollY > 40);
            }, { passive: true });
        }
        // FIX: Burger menu — ensure toggler works properly
        if (navbar) {
            const toggler = navbar.querySelector('.navbar-toggler');
            const collapseTarget = navbar.querySelector('.navbar-collapse');
            if (toggler && collapseTarget) {
                // Remove any broken Bootstrap collapse behavior and rebuild
                toggler.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isOpen = collapseTarget.classList.contains('show');
                    if (isOpen) {
                        collapseTarget.classList.remove('show');
                        collapseTarget.style.maxHeight = '0';
                        collapseTarget.style.opacity = '0';
                        toggler.setAttribute('aria-expanded', 'false');
                        toggler.classList.remove('is-open');
                    } else {
                        collapseTarget.classList.add('show');
                        collapseTarget.style.maxHeight = collapseTarget.scrollHeight + 'px';
                        collapseTarget.style.opacity = '1';
                        toggler.setAttribute('aria-expanded', 'true');
                        toggler.classList.add('is-open');
                    }
                });
                // Style the collapse for smooth animation
                collapseTarget.style.transition = 'max-height 0.4s cubic-bezier(0.16,1,0.3,1), opacity 0.3s ease';
                collapseTarget.style.overflow = 'hidden';
                // On desktop, reset inline styles
                const mq = window.matchMedia('(min-width: 992px)');
                function handleResize(e) {
                    if (e.matches) {
                        collapseTarget.style.maxHeight = '';
                        collapseTarget.style.opacity = '';
                        collapseTarget.style.overflow = '';
                    } else if (!collapseTarget.classList.contains('show')) {
                        collapseTarget.style.maxHeight = '0';
                        collapseTarget.style.opacity = '0';
                    }
                }
                mq.addEventListener('change', handleResize);
                handleResize(mq);
                // Close on clicking outside
                document.addEventListener('click', function(e) {
                    if (!navbar.contains(e.target) && collapseTarget.classList.contains('show')) {
                        collapseTarget.classList.remove('show');
                        collapseTarget.style.maxHeight = '0';
                        collapseTarget.style.opacity = '0';
                        toggler.setAttribute('aria-expanded', 'false');
                        toggler.classList.remove('is-open');
                    }
                });
            }
        }
        // Inject search button
        if (navInner) {
            const searchBtn = document.createElement('button');
            searchBtn.id = 'nav-search-btn';
            searchBtn.setAttribute('aria-label', 'Search');
            searchBtn.innerHTML = '<i class="fas fa-search"></i>';
            const toggler = navInner.querySelector('.navbar-toggler');
            if (toggler) {
                navInner.insertBefore(searchBtn, toggler);
            } else {
                navInner.appendChild(searchBtn);
            }
            searchBtn.addEventListener('click', openSearch);
        }
        // Nav indicator
        const mainNav = document.querySelector('.navbar-nav:not(.ml-auto):not([class*="mr-auto"])');
        const navUl = mainNav || document.querySelector('.navbar-nav');
        if (navUl) {
            const indicator = document.createElement('div');
            indicator.id = 'nav-indicator';
            navUl.style.position = 'relative';
            navUl.appendChild(indicator);
            const links = navUl.querySelectorAll('.nav-link');
            const activeLink = navUl.querySelector('.nav-link.active, .nav-item.active .nav-link');
            function moveIndicator(el) {
                const parentRect = navUl.getBoundingClientRect();
                const rect = el.getBoundingClientRect();
                indicator.style.left  = (rect.left - parentRect.left) + 'px';
                indicator.style.width = rect.width + 'px';
            }
            if (activeLink) moveIndicator(activeLink);
            links.forEach(a => {
                a.addEventListener('mouseenter', () => moveIndicator(a));
                a.addEventListener('focus',      () => moveIndicator(a));
            });
            navUl.addEventListener('mouseleave', () => {
                if (activeLink) moveIndicator(activeLink);
                else { indicator.style.left = '0'; indicator.style.width = '0'; }
            });
        }
        /* ══════════════════════════════════════════════
           3. SEARCH OVERLAY
        ══════════════════════════════════════════════ */
        const overlay = document.createElement('div');
        overlay.id = 'nav-search-overlay';
        overlay.innerHTML = `
            <div id="nav-search-box">
                <div id="nav-search-input-wrap">
                    <i class="fas fa-search si"></i>
                    <input type="text" id="nav-search-field" placeholder="Search books, journals, authors…" autocomplete="off">
                    <button id="nav-search-close"><i class="fas fa-times"></i></button>
                </div>
                <p id="nav-search-hint">Press <kbd>Esc</kbd> to close &nbsp;·&nbsp; Press <kbd>/</kbd> anywhere to open</p>
            </div>
        `;
        document.body.appendChild(overlay);
        function openSearch() {
            overlay.classList.add('open');
            setTimeout(() => document.getElementById('nav-search-field').focus(), 50);
        }
        function closeSearch() {
            overlay.classList.remove('open');
            document.getElementById('nav-search-field').value = '';
        }
        document.getElementById('nav-search-close').addEventListener('click', closeSearch);
        overlay.addEventListener('click', e => { if (e.target === overlay) closeSearch(); });
        document.addEventListener('keydown', e => {
            if (e.key === '/' && !['INPUT','TEXTAREA'].includes(document.activeElement.tagName)) {
                e.preventDefault(); openSearch();
            }
            if (e.key === 'Escape') closeSearch();
        });
        /* ══════════════════════════════════════════════
           4. AMBIENT BLOBS
        ══════════════════════════════════════════════ */
        ['blob-1','blob-2','blob-3'].forEach(cls => {
            const el = document.createElement('div');
            el.className = 'blob ' + cls;
            document.body.appendChild(el);
        });
        /* ══════════════════════════════════════════════
           5. CUSTOM CURSOR
        ══════════════════════════════════════════════ */
        const dot  = document.createElement('div'); dot.id  = 'cursor-dot';
        const ring = document.createElement('div'); ring.id = 'cursor-ring';
        document.body.append(dot, ring);
        let mx=0, my=0, rx=0, ry=0;
        document.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; });
        (function tick() {
            rx += (mx-rx)*0.12; ry += (my-ry)*0.12;
            dot.style.left=mx+'px'; dot.style.top=my+'px';
            ring.style.left=rx+'px'; ring.style.top=ry+'px';
            requestAnimationFrame(tick);
        })();
        /* ══════════════════════════════════════════════
           6. PARTICLE CANVAS
        ══════════════════════════════════════════════ */
        const canvas = document.createElement('canvas');
        canvas.id = 'particle-canvas';
        document.body.prepend(canvas);
        const ctx = canvas.getContext('2d');
        const resize = () => { canvas.width=innerWidth; canvas.height=innerHeight; };
        window.addEventListener('resize', resize); resize();
        const particles = Array.from({length:50}, () => ({
            x: Math.random()*innerWidth, y: Math.random()*innerHeight,
            r: Math.random()*1.2+0.3, dx: (Math.random()-0.5)*0.25,
            dy: -Math.random()*0.35-0.08, alpha: Math.random()*0.4+0.08,
            hue: [210, 160, 270][Math.floor(Math.random()*3)]
        }));
        (function draw() {
            ctx.clearRect(0,0,canvas.width,canvas.height);
            particles.forEach(p => {
                ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
                ctx.fillStyle=`hsla(${p.hue},70%,65%,${p.alpha})`; ctx.fill();
                p.x+=p.dx; p.y+=p.dy;
                if(p.y<-5){p.y=canvas.height+5;p.x=Math.random()*innerWidth;}
            });
            requestAnimationFrame(draw);
        })();
        /* ══════════════════════════════════════════════
           7. SLIDER
        ══════════════════════════════════════════════ */
        let current=0;
        const items=document.querySelectorAll('.slider-item'), TOTAL=items.length, DURATION=7000;
        const track=document.createElement('div'); track.className='slider-progress-track';
        const fill=document.createElement('div'); fill.className='slider-progress-fill';
        track.appendChild(fill);
        document.querySelector('.product-slider').after(track);
        const dotsWrap=document.createElement('div'); dotsWrap.className='slider-dots';
        items.forEach((_,i)=>{
            const btn=document.createElement('button');
            btn.className='slider-dot'+(i===0?' active':'');
            btn.addEventListener('click',()=>{goTo(i);restartAuto();});
            dotsWrap.appendChild(btn);
        });
        track.after(dotsWrap);
        document.querySelectorAll('.card-img-container').forEach((c,i)=>{
            const chip=document.createElement('div'); chip.className='card-chip';
            chip.textContent=['Inventory','Support'][i]||''; c.appendChild(chip);
        });
        function updateDots(){document.querySelectorAll('.slider-dot').forEach((d,i)=>d.classList.toggle('active',i===current));}
        function resetProgress(){fill.style.transition='none';fill.style.width='0%';requestAnimationFrame(()=>requestAnimationFrame(()=>{fill.style.transition=`width ${DURATION}ms linear`;fill.style.width='100%';}));}
        function goTo(idx){items[current].classList.remove('active');current=(idx+TOTAL)%TOTAL;items[current].classList.add('active');updateDots();resetProgress();}
        let autoTimer;
        function restartAuto(){clearInterval(autoTimer);autoTimer=setInterval(()=>goTo(current+1),DURATION);resetProgress();}
        document.querySelector('.next').addEventListener('click',()=>{goTo(current+1);restartAuto();});
        document.querySelector('.prev').addEventListener('click',()=>{goTo(current-1);restartAuto();});
        restartAuto();
        // Touch/swipe support for slider
        let touchStartX = 0, touchEndX = 0;
        const sliderEl = document.querySelector('.product-slider');
        sliderEl.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        sliderEl.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) { goTo(current+1); } else { goTo(current-1); }
                restartAuto();
            }
        }, { passive: true });
        /* ══════════════════════════════════════════════
           8. ACTION CARD SPOTLIGHT + TILT + RIPPLE
        ══════════════════════════════════════════════ */
        document.querySelectorAll('.action-card').forEach(card=>{
            card.addEventListener('mousemove',e=>{
                const r=card.getBoundingClientRect();
                card.style.setProperty('--mx',((e.clientX-r.left)/r.width*100).toFixed(2)+'%');
                card.style.setProperty('--my',((e.clientY-r.top)/r.height*100).toFixed(2)+'%');
            });
        });
        document.querySelectorAll('.floating-img').forEach(img=>{
            const wrap=img.parentElement; wrap.classList.add('tilt-target');
            wrap.addEventListener('mousemove',e=>{
                const r=wrap.getBoundingClientRect();
                const x=(e.clientX-r.left)/r.width-0.5, y=(e.clientY-r.top)/r.height-0.5;
                img.style.transform=`perspective(600px) rotateY(${x*16}deg) rotateX(${-y*12}deg) scale(1.03) translateY(-6px)`;
            });
            wrap.addEventListener('mouseleave',()=>{ img.style.transform=''; });
        });
        document.querySelectorAll('.btn-modern').forEach(btn=>{
            btn.addEventListener('click',e=>{
                const rp=document.createElement('span'), r=btn.getBoundingClientRect();
                rp.style.cssText=`position:absolute;border-radius:50%;background:rgba(255,255,255,0.2);transform:scale(0);animation:ripOut 0.55s ease forwards;left:${e.clientX-r.left-20}px;top:${e.clientY-r.top-20}px;width:40px;height:40px;pointer-events:none;`;
                btn.appendChild(rp); setTimeout(()=>rp.remove(),600);
            });
        });
        const ks=document.createElement('style');
        ks.textContent='@keyframes ripOut{to{transform:scale(6);opacity:0;}}';
        document.head.appendChild(ks);
        /* ══════════════════════════════════════════════
           9. INTERSECTION OBSERVER — Reveal on scroll
        ══════════════════════════════════════════════ */
        const observerOptions = { threshold: 0.15, rootMargin: '0px 0px -40px 0px' };
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    revealObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        document.querySelectorAll('.action-card').forEach((card, i) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `opacity 0.7s ${i * 0.15}s cubic-bezier(0.16,1,0.3,1), transform 0.7s ${i * 0.15}s cubic-bezier(0.16,1,0.3,1)`;
            revealObserver.observe(card);
        });
    });
    </script>
</x-user-layout>