<x-admin-layout>
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
            --glass-bg:      rgba(255,255,255,0.03);
            --glass-border:  rgba(255,255,255,0.08);
            --glass-blur:    blur(40px) saturate(1.8);
        }
        /* ══════════════════════════════════════════════════
           GLOBAL DARK BODY
        ══════════════════════════════════════════════════ */
        body {
            background: var(--deep) !important;
            color: rgba(255,255,255,0.8) !important;
            overflow-x: hidden;
            font-family: var(--font-body) !important;
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
        /* Noise texture */
        .admin-dashboard::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9000;
            opacity: 0.5;
        }
        /* ══════════════════════════════════════════════════
           AMBIENT BLOBS
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
           PARTICLE CANVAS
        ══════════════════════════════════════════════════ */
        #particle-canvas {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 0; opacity: 0.45;
        }
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
           SCROLL PROGRESS BAR
        ══════════════════════════════════════════════════ */
        #scroll-progress {
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
           ADMIN DASHBOARD LAYOUT
        ══════════════════════════════════════════════════ */
        .admin-dashboard {
            position: relative;
            z-index: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        /* ══════════════════════════════════════════════════
           HERO SECTION — Glassmorphism
        ══════════════════════════════════════════════════ */
        @property --angle { syntax: '<angle>'; initial-value: 0deg; inherits: false; }
        @keyframes spinBorder { to { --angle: 360deg; } }
        .admin-hero {
            position: relative;
            border-radius: var(--r-card);
            padding: 60px 40px;
            margin-bottom: 50px;
            overflow: hidden;
            animation: heroReveal 1s cubic-bezier(0.16,1,0.3,1) both;
        }
        /* Rotating border glow */
        .admin-hero::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: calc(var(--r-card) + 2px);
            background: conic-gradient(from var(--angle,0deg), transparent 0deg, var(--azure) 40deg, var(--electric) 80deg, var(--violet) 120deg, transparent 180deg, transparent 360deg);
            animation: spinBorder 6s linear infinite;
            z-index: 0;
            pointer-events: none;
            opacity: 0.5;
        }
        /* Solid inner fill */
        .admin-hero::after {
            content: '';
            position: absolute;
            inset: 1px;
            border-radius: calc(var(--r-card) - 1px);
            background: linear-gradient(135deg, rgba(4,8,15,0.95), rgba(8,14,26,0.98));
            backdrop-filter: var(--glass-blur);
            z-index: 0;
            pointer-events: none;
        }
        .admin-hero > * { position: relative; z-index: 1; }
        /* Hero inner glow */
        .admin-hero .hero-glow {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 60% at 20% 30%, rgba(59,130,246,0.08), transparent),
                radial-gradient(ellipse 40% 50% at 80% 70%, rgba(139,92,246,0.06), transparent),
                radial-gradient(ellipse 50% 40% at 50% 20%, rgba(6,214,160,0.04), transparent);
            pointer-events: none;
            z-index: 1;
            border-radius: var(--r-card);
        }
        .admin-hero h1 {
            font-family: var(--font-display) !important;
            font-weight: 600;
            font-size: clamp(3.5rem, 5vw, 3rem);
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, #fff 30%, var(--electric) 70%, var(--azure));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            line-height: 1.1;
        }
        .admin-hero p {
            font-family: var(--font-body);
            font-size: 1.1rem;
            color: var(--white-dim);
            max-width: 600px;
            margin: 0 auto 24px;
            line-height: 1.7;
        }
        .admin-hero .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 24px;
            border-radius: 50px;
            background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(139,92,246,0.15));
            border: 1px solid rgba(59,130,246,0.2);
            color: #fff;
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(59,130,246,0.1), inset 0 1px 0 rgba(255,255,255,0.06);
            animation: badgePulse 3s ease-in-out infinite;
        }
        .admin-badge::before {
            content: '';
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--electric);
            box-shadow: 0 0 12px var(--electric-glow);
            animation: dotBlink 2s ease-in-out infinite;
        }
        @keyframes dotBlink { 0%,100%{opacity:1;} 50%{opacity:0.3;} }
        @keyframes badgePulse { 0%,100%{box-shadow: 0 4px 20px rgba(59,130,246,0.1);} 50%{box-shadow: 0 4px 30px rgba(59,130,246,0.2), 0 0 40px rgba(139,92,246,0.08);} }
        @keyframes heroReveal {
            from { opacity: 0; transform: translateY(-30px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        /* ══════════════════════════════════════════════════
           STAT TILES — Glass Cards with Animated Icons
        ══════════════════════════════════════════════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }
        .stat-tile {
            position: relative;
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 28px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
            overflow: hidden;
            animation: statReveal 0.6s cubic-bezier(0.16,1,0.3,1) both;
        }
        .stat-tile:nth-child(1) { animation-delay: 0.15s; }
        .stat-tile:nth-child(2) { animation-delay: 0.25s; }
        .stat-tile:nth-child(3) { animation-delay: 0.35s; }
        @keyframes statReveal {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .stat-tile::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--mx, 50%) var(--my, 50%), rgba(255,255,255,0.06), transparent 60%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
        }
        .stat-tile:hover::before { opacity: 1; }
        .stat-tile:hover {
            transform: translateY(-6px);
            border-color: var(--rim-strong);
            box-shadow: 0 20px 50px rgba(0,0,0,0.4), 0 0 40px rgba(59,130,246,0.06);
        }
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
            position: relative;
            transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
        }
        .stat-tile:hover .stat-icon {
            transform: scale(1.15) rotate(-8deg);
        }
        .stat-icon.icon-azure {
            background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(59,130,246,0.05));
            color: var(--azure);
            box-shadow: 0 4px 16px rgba(59,130,246,0.15), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .stat-icon.icon-electric {
            background: linear-gradient(135deg, rgba(6,214,160,0.15), rgba(6,214,160,0.05));
            color: var(--electric);
            box-shadow: 0 4px 16px rgba(6,214,160,0.15), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .stat-icon.icon-violet {
            background: linear-gradient(135deg, rgba(139,92,246,0.15), rgba(139,92,246,0.05));
            color: var(--violet);
            box-shadow: 0 4px 16px rgba(139,92,246,0.15), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .stat-info h5 {
            font-family: var(--font-display) !important;
            font-weight: 700;
            font-size: 1.15rem;
            color: #fff;
            margin-bottom: 4px;
        }
        .stat-info small {
            font-family: var(--font-body);
            font-size: 0.78rem;
            color: var(--white-dim);
            letter-spacing: 0.04em;
        }
        /* Animated counter line */
        .stat-tile .stat-line {
            position: absolute;
            bottom: 0; left: 0;
            height: 2px;
            border-radius: 0 2px 0 0;
            transition: width 1.5s cubic-bezier(0.16,1,0.3,1);
            width: 0;
        }
        .stat-tile.revealed .stat-line { width: 100%; }
        .stat-line.line-azure { background: linear-gradient(90deg, var(--azure), transparent); }
        .stat-line.line-electric { background: linear-gradient(90deg, var(--electric), transparent); }
        .stat-line.line-violet { background: linear-gradient(90deg, var(--violet), transparent); }
        /* ══════════════════════════════════════════════════
           SECTION HEADER
        ══════════════════════════════════════════════════ */
        .section-header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeUp 0.8s cubic-bezier(0.16,1,0.3,1) 0.4s both;
        }
        .section-header h2 {
            font-family: var(--font-display) !important;
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: -0.02em;
            color: #fff;
            margin-bottom: 8px;
        }
        .section-header p {
            font-family: var(--font-body);
            font-size: 0.9rem;
            color: var(--white-dim);
        }
        .section-divider {
            width: 60px; height: 3px;
            margin: 16px auto 0;
            background: linear-gradient(90deg, var(--azure), var(--electric));
            border-radius: 3px;
            box-shadow: 0 0 16px var(--azure-glow);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        /* ══════════════════════════════════════════════════
           MANAGEMENT CARDS — Glass Morphism + Spotlight
        ══════════════════════════════════════════════════ */
        .mgmt-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .mgmt-card {
            position: relative;
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: var(--r-card);
            padding: 44px 32px 40px;
            text-align: center;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            animation: cardReveal 0.7s cubic-bezier(0.16,1,0.3,1) both;
        }
        .mgmt-card:nth-child(1) { animation-delay: 0.3s; }
        .mgmt-card:nth-child(2) { animation-delay: 0.45s; }
        .mgmt-card:nth-child(3) { animation-delay: 0.6s; }
        @keyframes cardReveal {
            from { opacity: 0; transform: translateY(30px) scale(0.94); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        /* Spotlight effect on hover */
        .mgmt-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle 250px at var(--mx, 50%) var(--my, 50%), rgba(255,255,255,0.05), transparent 70%);
            opacity: 0;
            transition: opacity 0.5s;
            pointer-events: none;
        }
        .mgmt-card:hover::before { opacity: 1; }
        /* Top accent line */
        .mgmt-card::after {
            content: '';
            position: absolute;
            top: 0; left: 20%; right: 20%;
            height: 2px;
            border-radius: 0 0 4px 4px;
            transition: all 0.5s cubic-bezier(0.16,1,0.3,1);
            opacity: 0;
        }
        .mgmt-card:hover::after {
            left: 10%; right: 10%;
            opacity: 1;
        }
        .mgmt-card:nth-child(1)::after { background: linear-gradient(90deg, transparent, var(--azure), transparent); }
        .mgmt-card:nth-child(2)::after { background: linear-gradient(90deg, transparent, var(--electric), transparent); }
        .mgmt-card:nth-child(3)::after { background: linear-gradient(90deg, transparent, var(--violet), transparent); }
        .mgmt-card:hover {
            transform: translateY(-12px);
            border-color: var(--rim-strong);
            box-shadow:
                0 24px 60px rgba(0,0,0,0.5),
                0 0 60px rgba(59,130,246,0.06),
                inset 0 1px 0 rgba(255,255,255,0.04);
        }
        .mgmt-card .card-icon {
            width: 80px; height: 80px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 24px;
            transition: all 0.5s cubic-bezier(0.34,1.56,0.64,1);
            position: relative;
        }
        .mgmt-card:hover .card-icon {
            transform: scale(1.15) rotate(-10deg);
        }
        .card-icon.ci-azure {
            background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(59,130,246,0.05));
            color: var(--azure);
            box-shadow: 0 8px 30px rgba(59,130,246,0.12), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .card-icon.ci-electric {
            background: linear-gradient(135deg, rgba(6,214,160,0.15), rgba(6,214,160,0.05));
            color: var(--electric);
            box-shadow: 0 8px 30px rgba(6,214,160,0.12), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        .card-icon.ci-violet {
            background: linear-gradient(135deg, rgba(139,92,246,0.15), rgba(139,92,246,0.05));
            color: var(--violet);
            box-shadow: 0 8px 30px rgba(139,92,246,0.12), inset 0 1px 0 rgba(255,255,255,0.06);
        }
        /* Orbiting ring on icon */
        .card-icon::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 30px;
            border: 1px dashed rgba(255,255,255,0.06);
            animation: orbitSpin 12s linear infinite;
        }
        @keyframes orbitSpin { to { transform: rotate(360deg); } }
        .mgmt-card h4 {
            font-family: var(--font-display) !important;
            font-weight: 700;
            font-size: 1.25rem;
            color: #fff;
            margin-bottom: 12px;
            letter-spacing: -0.01em;
        }
        .mgmt-card p {
            font-family: var(--font-body);
            font-size: 0.85rem;
            color: var(--white-dim);
            line-height: 1.7;
            margin-bottom: 28px;
        }
        /* ══════════════════════════════════════════════════
           MODERN BUTTON
        ══════════════════════════════════════════════════ */
        .btn-modern-admin {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 32px;
            border-radius: 50px;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none !important;
            color: #fff !important;
            background: linear-gradient(135deg, var(--azure), var(--violet));
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
            box-shadow: 0 6px 24px var(--azure-glow), inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .btn-modern-admin::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.6s;
        }
        .btn-modern-admin:hover::before { left: 100%; }
        .btn-modern-admin:hover {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 12px 40px var(--azure-glow), 0 0 0 1px rgba(139,92,246,0.3);
            color: #fff !important;
        }
        .btn-modern-admin::after {
            content: '→';
            font-size: 0.9rem;
            transition: transform 0.3s;
        }
        .btn-modern-admin:hover::after {
            transform: translateX(4px);
        }
        /* ══════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════ */
        @media (max-width: 991px) {
            .stats-grid, .mgmt-grid {
                grid-template-columns: 1fr;
            }
            .admin-hero { padding: 40px 24px; }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .mgmt-grid { grid-template-columns: repeat(3, 1fr); }
        }
        /* ══════════════════════════════════════════════════
           SCROLL REVEAL
        ══════════════════════════════════════════════════ */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s cubic-bezier(0.16,1,0.3,1), transform 0.7s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <!-- Ambient elements -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <canvas id="particle-canvas"></canvas>
    <div id="cursor-dot"></div>
    <div id="cursor-ring"></div>
    <div id="scroll-progress"></div>
    <div class="admin-dashboard">
        <!-- HERO -->
        <div class="admin-hero text-center">
            <div class="hero-glow"></div>
            <h1>System Overview</h1>
            <p>Welcome back, <strong>{{ Auth::user()->name }}</strong>. You have full control over the library ecosystem.</p>
            <div>
                <span class="admin-badge">Administrator Mode</span>
            </div>
        </div>
        <!-- STATS -->
        <div class="stats-grid">
            <div class="stat-tile reveal-on-scroll">
                <div class="stat-icon icon-azure">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-info">
                    <h5>Inventory</h5>
                    <small>Books Managed</small>
                </div>
                <div class="stat-line line-azure"></div>
            </div>
            <div class="stat-tile reveal-on-scroll">
                <div class="stat-icon icon-electric">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="stat-info">
                    <h5>Rentals</h5>
                    <small>Active Loans</small>
                </div>
                <div class="stat-line line-electric"></div>
            </div>
            <div class="stat-tile reveal-on-scroll">
                <div class="stat-icon icon-violet">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-info">
                    <h5>Members</h5>
                    <small>Verified Students</small>
                </div>
                <div class="stat-line line-violet"></div>
            </div>
        </div>
        <!-- SECTION HEADER -->
        <div class="section-header">
            <h2>Management Console</h2>
            <p>Quick access to all administrative modules</p>
            <div class="section-divider"></div>
        </div>
        <!-- MANAGEMENT CARDS -->
        <div class="mgmt-grid">
            <div class="mgmt-card reveal-on-scroll">
                <div class="card-icon ci-azure">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h4>Categories</h4>
                <p>Organize your library collections by departments, genres, or academic years.</p>
                <a href="{{ route('admin.categories') }}" class="btn-modern-admin">Manage Section</a>
            </div>
            <div class="mgmt-card reveal-on-scroll">
                <div class="card-icon ci-electric">
                    <i class="fas fa-book-open"></i>
                </div>
                <h4>Books Inventory</h4>
                <p>Add new arrivals, update stock quantities, and manage book details/previews.</p>
                <a href="{{ route('admin.books') }}" class="btn-modern-admin">Manage Stock</a>
            </div>
            <div class="mgmt-card reveal-on-scroll">
                <div class="card-icon ci-violet">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h4>Member Control</h4>
                <p>Monitor student registrations, view residential addresses, and track member IDs.</p>
                <a href="{{ route('admin.members') }}" class="btn-modern-admin">Manage Members</a>
            </div>
        </div>
    </div>
    <script>
    (function(){
        /* ── PARTICLE CANVAS ─────────────────────────── */
        const canvas = document.getElementById('particle-canvas');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            let W, H, particles = [];
            function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
            resize(); window.addEventListener('resize', resize);
            class Particle {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * W;
                    this.y = Math.random() * H;
                    this.r = Math.random() * 1.5 + 0.3;
                    this.dx = (Math.random() - 0.5) * 0.3;
                    this.dy = (Math.random() - 0.5) * 0.3;
                    this.o = Math.random() * 0.4 + 0.1;
                    const cols = ['59,130,246','6,214,160','139,92,246','255,255,255'];
                    this.c = cols[Math.floor(Math.random() * cols.length)];
                }
                update() {
                    this.x += this.dx; this.y += this.dy;
                    if (this.x < 0 || this.x > W || this.y < 0 || this.y > H) this.reset();
                }
                draw() {
                    ctx.beginPath(); ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(${this.c},${this.o})`; ctx.fill();
                }
            }
            for (let i = 0; i < 60; i++) particles.push(new Particle());
            function animate() {
                ctx.clearRect(0, 0, W, H);
                particles.forEach(p => { p.update(); p.draw(); });
                // Draw connections
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const dist = Math.sqrt(dx*dx + dy*dy);
                        if (dist < 120) {
                            ctx.beginPath();
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.strokeStyle = `rgba(59,130,246,${0.06 * (1 - dist/120)})`;
                            ctx.lineWidth = 0.5;
                            ctx.stroke();
                        }
                    }
                }
                requestAnimationFrame(animate);
            }
            animate();
        }
        /* ── CUSTOM CURSOR ────────────────────────────── */
        const dot = document.getElementById('cursor-dot');
        const ring = document.getElementById('cursor-ring');
        if (dot && ring) {
            let mx = 0, my = 0, rx = 0, ry = 0;
            document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; dot.style.left = mx+'px'; dot.style.top = my+'px'; });
            (function cursorLoop() {
                rx += (mx - rx) * 0.15; ry += (my - ry) * 0.15;
                ring.style.left = rx+'px'; ring.style.top = ry+'px';
                requestAnimationFrame(cursorLoop);
            })();
            // Hide on touch devices
            if ('ontouchstart' in window) { dot.style.display = 'none'; ring.style.display = 'none'; document.querySelectorAll('*').forEach(el => el.style.cursor = 'auto'); }
        }
        /* ── SCROLL PROGRESS ──────────────────────────── */
        const bar = document.getElementById('scroll-progress');
        if (bar) {
            window.addEventListener('scroll', () => {
                const h = document.documentElement.scrollHeight - window.innerHeight;
                bar.style.width = h > 0 ? (window.scrollY / h * 100) + '%' : '0%';
            });
        }
        /* ── SCROLL REVEAL ────────────────────────────── */
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('revealed'); } });
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
        /* ── SPOTLIGHT EFFECT on cards/tiles ───────────── */
        document.querySelectorAll('.mgmt-card, .stat-tile').forEach(card => {
            card.addEventListener('mousemove', e => {
                const r = card.getBoundingClientRect();
                card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
                card.style.setProperty('--my', (e.clientY - r.top) + 'px');
            });
        });
    })();
    </script>
</x-admin-layout>