<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShelfSync — Your University Digital Library</title>
    <meta name="description" content="Search books, get a Digital ID Card, and rent from the DIU library — all in one place.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/fivicon.svg') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Poppins — clean geometric sans for the entire landing page -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
    <style>
    /* ═══════════════════════════════════════════════════
       LANDING — DESIGN SYSTEM
    ═══════════════════════════════════════════════════ */
    /* ── Landing-page luxury font variables (override shelfsync globals) ── */
    :root {
        --gold:   #f59e0b;
        --r-card: 24px;
        --r-pill: 100px;
        --r-input: 18px;
        /* Poppins everywhere */
        --lp-font: 'Poppins', system-ui, sans-serif;
    }
    html { scroll-behavior: smooth; }

    /* ── Core font rendering — beats shelfsync.css ── */
    body.welcome-page {
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
        text-rendering: optimizeLegibility !important;
        font-family: var(--lp-font) !important;
        font-weight: 400 !important;
        line-height: 1.7 !important;
        padding-top: 0 !important;
    }

    /* Heading weight hierarchy — Poppins everywhere */
    body.welcome-page h1 { font-family: var(--lp-font) !important; font-weight: 700 !important; letter-spacing: -0.02em !important; }
    body.welcome-page h2 { font-family: var(--lp-font) !important; font-weight: 600 !important; letter-spacing: -0.02em !important; }
    body.welcome-page h3 { font-family: var(--lp-font) !important; font-weight: 500 !important; }
    body.welcome-page h4 { font-family: var(--lp-font) !important; font-weight: 500 !important; }
    body.welcome-page p  { font-family: var(--lp-font) !important; font-weight: 400 !important; line-height: 1.75 !important; color: rgba(255,255,255,0.6); }

    /* Ambient drifting orbs */
    .orb {
        position: fixed; border-radius: 50%;
        filter: blur(110px); pointer-events: none; z-index: 0;
        animation: driftOrb 22s infinite alternate ease-in-out;
    }
    .orb1{width:750px;height:750px;background:radial-gradient(circle,rgba(0,212,255,0.06),transparent);top:-180px;left:-220px;}
    .orb2{width:600px;height:600px;background:radial-gradient(circle,rgba(124,58,237,0.05),transparent);top:35%;right:-180px;animation-delay:-10s;}
    .orb3{width:500px;height:500px;background:radial-gradient(circle,rgba(6,214,160,0.04),transparent);bottom:5%;left:15%;animation-delay:-18s;}
    @keyframes driftOrb{0%{transform:translate(0,0) scale(1);}100%{transform:translate(35px,25px) scale(1.12);}}
    body>*{position:relative;z-index:1;}

    /* ── Shared components ── */
    .pill-tag{
        display:inline-flex;align-items:center;gap:7px;
        font-size:0.68rem;font-weight:500;text-transform:uppercase;letter-spacing:3px;
        color:var(--ss-cyan);background:rgba(0,212,255,0.07);
        border:1px solid rgba(0,212,255,0.2);
        padding:5px 16px;border-radius:var(--r-pill);margin-bottom:18px;
    }
    .section-title{
        font-size:clamp(1.8rem,3.8vw,2.8rem);
        font-weight:600 !important;
        letter-spacing:-0.02em;
        line-height:1.15;
        margin-bottom:14px;
        color:#fff;
    }
    .section-sub{color:rgba(255,255,255,0.6);font-size:0.95rem;line-height:1.75;font-weight:400 !important;max-width:520px;}
    .btn-primary-ss{display:inline-flex;align-items:center;gap:9px;padding:14px 32px;border-radius:var(--r-pill);font-size:0.88rem;font-weight:700;text-decoration:none;color:#fff;background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));box-shadow:0 8px 28px rgba(0,212,255,0.28);transition:all 0.3s cubic-bezier(.16,1,.3,1);border:none;letter-spacing:0.02em;}
    .btn-primary-ss:hover{transform:translateY(-3px);box-shadow:0 14px 38px rgba(0,212,255,0.42);color:#fff;}
    .btn-ghost-ss{display:inline-flex;align-items:center;gap:9px;padding:14px 32px;border-radius:var(--r-pill);font-size:0.88rem;font-weight:600;text-decoration:none;color:var(--ss-text-2);border:1px solid rgba(255,255,255,0.13);background:rgba(255,255,255,0.04);transition:all 0.28s;letter-spacing:0.02em;}
    .btn-ghost-ss:hover{border-color:var(--ss-cyan);color:var(--ss-cyan);background:rgba(0,212,255,0.05);}

    /* Divider */
    .section-divider{border:none;border-top:1px solid rgba(255,255,255,0.05);margin:0;}

    /* ═══════════════════════════════════════════════════
       § 0 — NAVBAR — exact premium glassmorphic recipe
    ═══════════════════════════════════════════════════ */
    .ss-nav-float-wrap{position:fixed;top:20px;left:50%;transform:translateX(-50%);width:calc(100% - 48px);max-width:1200px;z-index:9000;}
    .ss-navbar-pill {
        width:100% !important;
        display:flex !important;
        align-items:center !important;
        flex-wrap:nowrap !important;
        padding:9px 22px !important;
        border-radius:9999px !important;
        /* Exact premium recipe */
        background:rgba(10,10,12,0.65) !important;
        backdrop-filter:blur(24px) saturate(1.5) !important;
        -webkit-backdrop-filter:blur(24px) saturate(1.5) !important;
        border:none !important;
        border-bottom:1px solid rgba(255,255,255,0.08) !important;
        box-shadow:0 4px 30px rgba(0,0,0,0.1) !important;
        transition:background 0.4s ease, box-shadow 0.4s ease !important;
    }
    .ss-navbar-pill:hover {
        background: rgba(10,10,12,0.78) !important;
        box-shadow: 0 6px 40px rgba(0,0,0,0.15) !important;
    }
    /* Elegant nav-link hover — soft fade, perfectly rounded */
    .ss-nav-float-wrap .ss-nav-link {
        border-radius: 99px !important;
        padding: 6px 14px !important;
        font-weight: 400 !important;
        font-size: 0.85rem !important;
        color: rgba(255,255,255,0.55) !important;
        transition: color 0.22s ease, background 0.22s ease !important;
        background: transparent !important;
    }
    .ss-nav-float-wrap .ss-nav-link:hover {
        color: rgba(255,255,255,0.9) !important;
        background: rgba(255,255,255,0.05) !important;
    }
    .ss-nav-float-wrap .ss-nav-link.active {
        color: var(--ss-cyan) !important;
        background: rgba(0,212,255,0.08) !important;
    }
    .ss-nav-sep{width:1px;height:18px;background:rgba(255,255,255,0.1);margin:0 8px;flex-shrink:0;}

    /* ═══════════════════════════════════════════════════
       § 1 — HERO
    ═══════════════════════════════════════════════════ */
    .hero{
        min-height:100vh;display:flex;flex-direction:column;
        align-items:center;justify-content:center;
        text-align:center;padding:130px 24px 80px;
        position:relative;
    }
    .hero-kicker{
        display:inline-flex;align-items:center;gap:8px;
        font-size:0.7rem;font-weight:500;text-transform:uppercase;letter-spacing:3px;
        color:var(--ss-cyan);border:1px solid rgba(0,212,255,0.22);
        background:rgba(0,212,255,0.07);padding:7px 20px;
        border-radius:var(--r-pill);margin-bottom:36px;
        animation:fadeUp 0.8s ease both;
    }
    .hero-h1{
        font-size: clamp(2.8rem, 6.5vw, 5rem) !important;
        font-weight: 700 !important;
        line-height: 1.1 !important;
        letter-spacing: -0.02em !important;
        margin-bottom: 24px;
        color: #fff;
        animation: fadeUp 0.9s ease 0.1s both;
    }
    .hero-h1 .grad{
        background:linear-gradient(110deg, var(--ss-cyan), var(--ss-violet));
        -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
        font-weight: 700 !important;
    }
    .hero-p{
        max-width:520px;font-size:1rem;line-height:1.8;
        color:rgba(255,255,255,0.6);font-weight:400 !important;
        margin-bottom:44px;animation:fadeUp 0.9s ease 0.2s both;
    }
    .hero-ctas{display:flex;gap:14px;flex-wrap:wrap;justify-content:center;animation:fadeUp 0.9s ease 0.3s both;}

    /* Live stat strip */
    .hero-stats{margin-top:72px;display:flex;gap:52px;justify-content:center;flex-wrap:wrap;animation:fadeUp 1s ease 0.45s both;}
    .hs{text-align:center;}
    .hs-n{font-size:2.4rem;font-weight:600 !important;line-height:1;letter-spacing:-0.02em;}
    .hs-l{font-size:0.65rem;color:var(--ss-text-3);letter-spacing:3px;text-transform:uppercase;margin-top:8px;font-weight:500;}
    .hs-div{width:1px;height:50px;background:rgba(255,255,255,0.08);margin:auto 0;}

    /* ═══════════════════════════════════════════════════
       § 2 — SMART SEARCH SANDBOX
       NOTE: shelfsync.css applies border-radius:var(--ss-r-sm)!important
       to ALL inputs. Every rule here uses !important to win that fight.
    ═══════════════════════════════════════════════════ */
    .search-section{padding:100px 24px;text-align:center;}
    .search-wrap{display:flex;flex-direction:column;align-items:center;}

    /* Pill container */
    .search-bar{
        position:relative;width:100%;max-width:700px;
        background:rgba(255,255,255,0.04) !important;
        border:1px solid rgba(255,255,255,0.09) !important;
        border-radius:9999px !important;
        padding:5px 5px 5px 26px !important;
        display:flex;align-items:center;gap:10px;
        backdrop-filter:blur(20px);
        box-shadow:none !important;
        transition:border-color 0.28s,box-shadow 0.28s;
    }
    .search-bar:focus-within{
        border-color:rgba(0,212,255,0.5) !important;
        box-shadow:0 0 0 4px rgba(0,212,255,0.09),0 8px 40px rgba(0,0,0,0.2) !important;
    }

    /* Override shelfsync.css global input rule entirely */
    .search-bar #live-search-input,
    .search-bar input[type="text"] {
        flex:1 !important;
        background:transparent !important;
        border:none !important;
        outline:none !important;
        box-shadow:none !important;
        border-radius:0 !important;           /* flat inside pill container */
        padding:13px 4px !important;
        color:var(--ss-text) !important;
        font-size:0.95rem !important;
        font-family:var(--lp-font) !important;
        font-weight:300 !important;
        letter-spacing:0.01em !important;
        width:100% !important;
        -webkit-appearance:none !important;
        appearance:none !important;
    }
    .search-bar #live-search-input:focus {
        outline:none !important;
        box-shadow:none !important;
        border-color:transparent !important;
        background:transparent !important;
    }

    .search-ico{color:var(--ss-text-3);font-size:0.9rem;flex-shrink:0;}

    /* Submit pill — must also win against Bootstrap .btn */
    .search-submit-btn {
        background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue)) !important;
        color:#fff !important;
        border:none !important;
        padding:12px 26px !important;
        border-radius:9999px !important;
        font-weight:600 !important;
        font-size:0.8rem !important;
        letter-spacing:0.04em !important;
        flex-shrink:0 !important;
        box-shadow:none !important;
        transition:box-shadow 0.25s,transform 0.25s !important;
        cursor:pointer !important;
    }
    .search-submit-btn:hover {
        transform:translateY(-1px) !important;
        box-shadow:0 6px 22px rgba(0,212,255,0.32) !important;
        color:#fff !important;
    }

    /* Results dropdown */
    .search-results-drop{
        width:100%;max-width:700px;margin-top:8px;
        background:rgba(8,8,12,0.98);
        border:1px solid rgba(0,212,255,0.18);
        border-radius:20px !important;
        overflow:hidden;display:none;
        backdrop-filter:blur(28px);
        box-shadow:0 24px 60px rgba(0,0,0,0.55);
    }
    .sri{display:flex;align-items:center;gap:14px;padding:13px 20px;border-bottom:1px solid rgba(255,255,255,0.04);transition:background 0.2s;text-decoration:none;color:var(--ss-text);}
    .sri:last-child{border-bottom:none;}
    .sri:hover{background:rgba(0,212,255,0.05);}
    .sri-thumb{width:36px;height:50px;object-fit:cover;border-radius:8px;flex-shrink:0;background:rgba(255,255,255,0.04);}
    .sri-ph{width:36px;height:50px;border-radius:8px;flex-shrink:0;background:rgba(0,212,255,0.07);display:flex;align-items:center;justify-content:center;color:rgba(0,212,255,0.3);font-size:0.9rem;}
    .sri-name{font-size:0.9rem;font-weight:600;color:#fff;}
    .sri-auth{font-size:0.74rem;color:var(--ss-text-3);margin-top:2px;}
    .sri-cta{font-size:0.68rem;padding:4px 12px;border-radius:var(--r-pill);background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));color:#fff;font-weight:700;margin-left:auto;flex-shrink:0;white-space:nowrap;}

    /* ═══════════════════════════════════════════════════
       § 3 — LIVE AVAILABILITY FEED
    ═══════════════════════════════════════════════════ */
    .avail-section{padding:100px 24px 80px;}
    .avail-inner{max-width:1200px;margin:0 auto;}
    .avail-header{display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;margin-bottom:48px;}
    .book-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:20px;}
    .bcard{
        background:rgba(255,255,255,0.03);
        border:1px solid rgba(255,255,255,0.07);
        border-radius:var(--r-card);overflow:hidden;
        position:relative;
        transition:transform 0.38s cubic-bezier(.16,1,.3,1),border-color 0.3s,box-shadow 0.38s;
    }
    .bcard:hover{transform:translateY(-10px);border-color:rgba(0,212,255,0.3);box-shadow:0 24px 60px rgba(0,0,0,0.5),0 0 40px rgba(0,212,255,0.07);}
    .bcard-cover{width:100%;height:240px;object-fit:cover;display:block;}
    .bcard-cover-ph{width:100%;height:240px;background:linear-gradient(160deg,rgba(0,212,255,0.09),rgba(124,58,237,0.09));display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;}
    .bcard-cover-ph i{font-size:2.4rem;color:rgba(0,212,255,0.22);}
    .bcard-cover-ph span{font-size:0.7rem;color:var(--ss-text-3);text-align:center;padding:0 14px;}
    .bcard-body{padding:16px;}
    .bcard-title{font-size:0.88rem;font-weight:700;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:4px;}
    .bcard-author{font-size:0.73rem;color:var(--ss-text-3);}
    .bcard-qty{position:absolute;top:12px;right:12px;background:rgba(10,10,11,0.8);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.1);border-radius:var(--r-pill);padding:3px 11px;font-size:0.65rem;font-weight:700;color:var(--ss-electric);}
    /* Hover CTA overlay */
    .bcard-hover-layer{position:absolute;inset:0;border-radius:var(--r-card);background:linear-gradient(to top,rgba(0,0,0,0.88) 0%,transparent 55%);display:flex;align-items:flex-end;justify-content:center;padding-bottom:18px;opacity:0;transition:opacity 0.3s;}
    .bcard:hover .bcard-hover-layer{opacity:1;}
    .bcard-rent-btn{background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));color:#fff;border:none;padding:10px 24px;border-radius:var(--r-pill);font-size:0.8rem;font-weight:700;text-decoration:none;display:inline-block;}

    /* ═══════════════════════════════════════════════════
       § 4 — DIGITAL ACCESS SHOWCASE
    ═══════════════════════════════════════════════════ */
    .id-section{padding:120px 24px;position:relative;overflow:hidden;}
    .id-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}
    @media(max-width:900px){.id-inner{grid-template-columns:1fr;gap:48px;}.id-card-wrap{display:flex;justify-content:center;}}
    /* Steps */
    .id-steps{display:flex;flex-direction:column;gap:32px;}
    .id-step{display:flex;gap:20px;align-items:flex-start;opacity:0;transform:translateX(-20px);transition:opacity 0.6s,transform 0.6s;}
    .id-step.visible{opacity:1;transform:translateX(0);}
    .id-step-icon{width:48px;height:48px;border-radius:14px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1rem;border:1px solid rgba(255,255,255,0.07);}
    .id-step-body h3{font-size:1rem;font-weight:700;color:#fff;margin-bottom:5px;}
    .id-step-body p{font-size:0.85rem;color:var(--ss-text-2);line-height:1.65;}

    /* Glassmorphic ID Card mockup */
    .id-card-wrap{perspective:1200px;display:flex;justify-content:center;align-items:center;}
    .id-card{
        width:360px;max-width:100%;
        background:linear-gradient(135deg,rgba(0,212,255,0.12) 0%,rgba(124,58,237,0.12) 50%,rgba(0,0,0,0.2) 100%);
        border:1px solid rgba(255,255,255,0.14);
        border-radius:24px;padding:28px;
        backdrop-filter:blur(20px);
        box-shadow:0 40px 100px rgba(0,0,0,0.6),0 0 60px rgba(0,212,255,0.08),inset 0 1px 0 rgba(255,255,255,0.12);
        position:relative;overflow:hidden;
        /* Hardware-accelerate the tilt — composited layer, no repaints */
        will-change:transform;
        transform:perspective(1000px) rotateY(-8deg) rotateX(4deg);
        /* Smooth glide in, slow elegant reset */
        transition:transform 0.12s ease-out;
        animation:cardFloat 6s ease-in-out infinite alternate;
    }
    .id-card.is-tilting { animation:none !important; }
    .id-card.is-resetting { transition:transform 0.55s cubic-bezier(.16,1,.3,1); }
    @keyframes cardFloat{
        0%  {transform:perspective(1000px) rotateY(-8deg) rotateX(4deg) translateY(0);}
        100%{transform:perspective(1000px) rotateY(-5deg) rotateX(3deg) translateY(-14px);}
    }
    /* Card noise texture */
    .id-card::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;border-radius:24px;}
    /* Card glow orb */
    .id-card::after{content:'';position:absolute;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(0,212,255,0.25),transparent);top:-60px;right:-60px;pointer-events:none;}
    .card-logo-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;}
    .card-logo-text{font-family:var(--ss-font-display);font-size:0.75rem;font-weight:800;color:rgba(255,255,255,0.6);letter-spacing:3px;text-transform:uppercase;}
    .card-chip{width:38px;height:28px;background:linear-gradient(135deg,rgba(245,158,11,0.6),rgba(245,158,11,0.3));border-radius:5px;border:1px solid rgba(245,158,11,0.3);}
    .card-id-ring{width:58px;height:58px;border-radius:50%;background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue),var(--ss-violet));display:flex;align-items:center;justify-content:center;font-family:var(--ss-font-display);font-size:1.5rem;font-weight:800;color:#fff;box-shadow:0 0 20px rgba(0,212,255,0.35);margin-bottom:16px;}
    .card-name{font-family:var(--ss-font-display);font-size:1.1rem;font-weight:700;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;letter-spacing:0.5px;margin-bottom:4px;}
    .card-dept{font-size:0.78rem;color:rgba(255,255,255,0.5);letter-spacing:1px;margin-bottom:20px;}
    .card-bottom{display:flex;justify-content:space-between;align-items:flex-end;}
    .card-sid{font-size:0.7rem;color:rgba(255,255,255,0.4);font-family:'Courier New',monospace;letter-spacing:1px;}
    .card-active{background:rgba(6,214,160,0.15);border:1px solid rgba(6,214,160,0.3);color:var(--ss-electric);font-size:0.65rem;font-weight:700;padding:4px 12px;border-radius:var(--r-pill);letter-spacing:1px;}
    .card-valid{font-size:0.62rem;color:rgba(255,255,255,0.35);text-align:right;}
    .card-valid span{display:block;color:rgba(255,255,255,0.55);font-weight:600;font-size:0.72rem;}

    /* ═══════════════════════════════════════════════════
       § 5 — DUE BACK SOON RADAR
    ═══════════════════════════════════════════════════ */
    .radar-section{padding:100px 24px;}
    .radar-inner{max-width:1100px;margin:0 auto;}
    .radar-header{margin-bottom:48px;}
    .radar-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;}
    .radar-card{
        background:rgba(255,255,255,0.03);
        border:1px solid rgba(255,255,255,0.07);
        border-radius:var(--r-card);padding:20px;
        display:flex;align-items:center;gap:18px;
        transition:background 0.3s,border-color 0.3s;
    }
    .radar-card:hover{background:rgba(255,255,255,0.05);border-color:rgba(0,212,255,0.18);}
    .radar-book-thumb{width:52px;height:72px;border-radius:10px;object-fit:cover;flex-shrink:0;background:rgba(255,255,255,0.04);}
    .radar-book-ph{width:52px;height:72px;border-radius:10px;flex-shrink:0;background:linear-gradient(135deg,rgba(0,212,255,0.1),rgba(124,58,237,0.1));display:flex;align-items:center;justify-content:center;color:rgba(0,212,255,0.3);font-size:1.2rem;}
    .radar-info{flex:1;min-width:0;}
    .radar-title{font-size:0.9rem;font-weight:700;color:#fff;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .radar-author{font-size:0.74rem;color:var(--ss-text-3);margin-bottom:10px;}
    .radar-due{display:flex;align-items:center;gap:6px;font-size:0.72rem;font-weight:600;}
    .radar-pulse{width:7px;height:7px;border-radius:50%;background:var(--ss-amber);box-shadow:0 0 8px rgba(245,158,11,0.7);animation:pulse 1.5s infinite;}
    @keyframes pulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:0.6;transform:scale(0.75);}}
    .radar-empty{text-align:center;padding:60px;color:var(--ss-text-3);font-size:0.9rem;}

    /* ═══════════════════════════════════════════════════
       § 6 — CONVERSION CTA BANNER
    ═══════════════════════════════════════════════════ */
    .cta-banner{
        margin:60px 24px;max-width:1100px;margin-left:auto;margin-right:auto;
        background:linear-gradient(135deg,rgba(0,212,255,0.08),rgba(124,58,237,0.08));
        border:1px solid rgba(0,212,255,0.15);
        border-radius:var(--r-card);padding:72px 60px;
        text-align:center;position:relative;overflow:hidden;
    }
    .cta-banner::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(0,212,255,0.1),transparent);top:-150px;left:-100px;pointer-events:none;}
    .cta-banner::after{content:'';position:absolute;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(124,58,237,0.1),transparent);bottom:-100px;right:-80px;pointer-events:none;}
    .cta-banner h2{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:600 !important;letter-spacing:-0.02em;margin-bottom:16px;position:relative;color:#fff;}
    .cta-banner p{color:rgba(255,255,255,0.6);font-size:0.95rem;line-height:1.75;font-weight:400 !important;max-width:480px;margin:0 auto 36px;position:relative;}
    .cta-banner-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;position:relative;}

    /* ═══════════════════════════════════════════════════
       § 7 — FOOTER
    ═══════════════════════════════════════════════════ */
    .landing-footer{border-top:1px solid rgba(255,255,255,0.05);padding:44px 48px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;margin-top:80px;}
    .footer-links{display:flex;gap:24px;}
    .footer-links a{color:var(--ss-text-3);text-decoration:none;font-size:0.82rem;transition:color 0.2s;}
    .footer-links a:hover{color:var(--ss-cyan);}
    @media(max-width:640px){.landing-footer{flex-direction:column;text-align:center;padding:32px 20px;}.footer-links{justify-content:center;}}

    /* ═══════════════════════════════════════════════════
       § NEW-A — INFINITE MARQUEE STRIP
    ═══════════════════════════════════════════════════ */
    .marquee-section{padding:0;overflow:hidden;border-top:1px solid rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.05);background:rgba(0,212,255,0.02);}
    .marquee-track{display:flex;width:max-content;animation:marqueeScroll 30s linear infinite;}
    .marquee-track:hover{animation-play-state:paused;}
    .marquee-item{display:inline-flex;align-items:center;gap:10px;padding:18px 40px;font-size:0.82rem;font-weight:500;color:rgba(255,255,255,0.5);white-space:nowrap;letter-spacing:0.02em;}
    .marquee-item i{font-size:0.9rem;color:var(--ss-cyan);opacity:0.7;}
    .marquee-dot{width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,0.15);flex-shrink:0;margin:0 8px;}
    @keyframes marqueeScroll{0%{transform:translateX(0);}100%{transform:translateX(-50%);}}

    /* ═══════════════════════════════════════════════════
       § NEW-B — JOURNEY TIMELINE
    ═══════════════════════════════════════════════════ */
    .timeline-section{padding:100px 24px;text-align:center;}
    .timeline-inner{max-width:1100px;margin:0 auto;}
    .timeline-track{display:flex;align-items:flex-start;justify-content:center;position:relative;margin-top:56px;gap:0;}
    /* The connecting line */
    .timeline-track::before{content:'';position:absolute;top:32px;left:12%;right:12%;height:2px;background:linear-gradient(90deg,var(--ss-cyan),var(--ss-violet),var(--ss-electric));opacity:0.3;border-radius:2px;}
    .timeline-node{flex:1;max-width:220px;display:flex;flex-direction:column;align-items:center;text-align:center;position:relative;z-index:1;padding:0 12px;cursor:default;}
    .timeline-circle{width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:20px;border:2px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);backdrop-filter:blur(12px);transition:all 0.35s cubic-bezier(.16,1,.3,1);position:relative;}
    .timeline-circle::after{content:'';position:absolute;inset:-6px;border-radius:50%;border:1px solid transparent;transition:border-color 0.35s,box-shadow 0.35s;}
    .timeline-node:hover .timeline-circle{transform:scale(1.15);border-color:var(--ss-cyan);background:rgba(0,212,255,0.08);box-shadow:0 0 30px rgba(0,212,255,0.2);}
    .timeline-node:hover .timeline-circle::after{border-color:rgba(0,212,255,0.2);box-shadow:0 0 20px rgba(0,212,255,0.1);}
    .timeline-num{font-size:0.6rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--ss-text-3);margin-bottom:10px;transition:color 0.3s;}
    .timeline-node:hover .timeline-num{color:var(--ss-cyan);}
    .timeline-title{font-size:0.92rem;font-weight:600;color:#fff;margin-bottom:8px;transition:color 0.3s;}
    .timeline-desc{font-size:0.78rem;color:rgba(255,255,255,0.4);line-height:1.6;max-height:0;overflow:hidden;opacity:0;transition:max-height 0.4s ease,opacity 0.35s ease;}
    .timeline-node:hover .timeline-desc{max-height:80px;opacity:1;}

    /* ═══════════════════════════════════════════════════
       § NEW-C — FEATURE SHOWCASE (BENTO GRID)
    ═══════════════════════════════════════════════════ */
    .features-section{padding:100px 24px;position:relative;overflow:hidden;}
    .features-inner{max-width:1100px;margin:0 auto;}
    .features-header{text-align:center;margin-bottom:56px;}
    /* Background scrolling text */
    .features-bg-text{position:absolute;top:50%;left:0;width:200%;white-space:nowrap;font-size:6rem;font-weight:700;color:rgba(255,255,255,0.015);letter-spacing:0.05em;pointer-events:none;animation:featureBgScroll 40s linear infinite;transform:translateY(-50%);}
    @keyframes featureBgScroll{0%{transform:translateY(-50%) translateX(0);}100%{transform:translateY(-50%) translateX(-50%);}}
    .bento-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;position:relative;z-index:1;}
    .bento-card{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:var(--r-card);padding:28px;position:relative;overflow:hidden;transition:transform 0.35s cubic-bezier(.16,1,.3,1),border-color 0.3s,box-shadow 0.35s;}
    .bento-card:hover{transform:translateY(-6px);border-color:rgba(0,212,255,0.25);box-shadow:0 20px 50px rgba(0,0,0,0.4),0 0 30px rgba(0,212,255,0.06);}
    .bento-card.large{grid-column:span 2;}
    .bento-card .bento-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:18px;border:1px solid rgba(255,255,255,0.07);transition:transform 0.3s,box-shadow 0.3s;}
    .bento-card:hover .bento-icon{transform:scale(1.1);box-shadow:0 0 20px rgba(0,212,255,0.15);}
    .bento-card h3{font-size:1rem;font-weight:600;color:#fff;margin-bottom:8px;}
    .bento-card p{font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.65;margin:0;}

    /* ═══════════════════════════════════════════════════
       § NEW-D — FAQ ACCORDION
    ═══════════════════════════════════════════════════ */
    .faq-section{padding:100px 24px;}
    .faq-inner{max-width:760px;margin:0 auto;}
    .faq-header{text-align:center;margin-bottom:48px;}
    .faq-item{border:1px solid rgba(255,255,255,0.07);border-radius:16px;margin-bottom:10px;overflow:hidden;background:rgba(255,255,255,0.02);transition:border-color 0.3s,background 0.3s;}
    .faq-item.open{border-color:rgba(0,212,255,0.2);background:rgba(0,212,255,0.03);}
    .faq-q{display:flex;align-items:center;justify-content:space-between;padding:18px 24px;cursor:pointer;gap:16px;transition:background 0.2s;}
    .faq-q:hover{background:rgba(255,255,255,0.02);}
    .faq-q span{font-size:0.92rem;font-weight:500;color:#fff;}
    .faq-chevron{font-size:0.7rem;color:var(--ss-text-3);transition:transform 0.3s,color 0.3s;flex-shrink:0;}
    .faq-item.open .faq-chevron{transform:rotate(180deg);color:var(--ss-cyan);}
    .faq-a{max-height:0;overflow:hidden;transition:max-height 0.4s ease,padding 0.3s ease;}
    .faq-item.open .faq-a{max-height:200px;padding:0 24px 20px;}
    .faq-a p{font-size:0.85rem;color:rgba(255,255,255,0.55);line-height:1.75;margin:0;}

    @keyframes fadeUp{from{opacity:0;transform:translateY(22px);}to{opacity:1;transform:translateY(0);}}
    @media(max-width:768px){
        .ss-nav-float-wrap{width:calc(100% - 24px);}
        .hero-ctas{flex-direction:column;align-items:center;}
        .hero-stats{gap:28px;}
        .avail-section,.search-section,.id-section,.radar-section,.timeline-section,.features-section,.faq-section{padding:70px 20px;}
        .cta-banner{padding:48px 24px;margin:40px 16px;}
        .book-grid{grid-template-columns:repeat(auto-fill,minmax(150px,1fr));}
        .id-card{transform:none;}
        .timeline-track{flex-direction:column;align-items:center;gap:32px;}
        .timeline-track::before{display:none;}
        .timeline-desc{max-height:none;opacity:1;}
        .bento-grid{grid-template-columns:1fr;}
        .bento-card.large{grid-column:span 1;}
    }
    </style>
</head>
<body class="welcome-page">

<!-- Ambient orbs -->
<div style="position:fixed;inset:0;z-index:0;pointer-events:none;">
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>
    <div class="orb orb3"></div>
</div>

{{-- ═══════ § 0 — REAL NAVBAR (content preserved, glassmorphism enhanced) ═══════ --}}
<div class="ss-nav-float-wrap">
    <nav class="ss-navbar-pill navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/shelfsync.svg') }}" height="30" alt="{{ config('app.name') }}" style="display:block;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto align-items-center" style="gap:2px;">
                <li class="nav-item">
                    <button id="nav-search-btn" aria-label="Search"
                            style="background:none;border:1px solid rgba(255,255,255,0.12);border-radius:8px;width:34px;height:34px;color:var(--ss-text-2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:border-color 0.2s,color 0.2s;margin-right:6px;">
                        <i class="fas fa-search" style="font-size:0.78rem;"></i>
                    </button>
                </li>
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('user.books') ? 'active' : '' }}" href="{{ route('user.books') }}">Books</a></li>
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                @auth
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('user.my_rents') ? 'active' : '' }}" href="{{ route('user.my_rents') }}">My Rents</a></li>
                @endauth
                <li class="nav-item d-none d-lg-flex align-items-center"><div class="ss-nav-sep"></div></li>
                @auth
                <li class="nav-item dropdown">
                    <button id="avatarBtn" class="ss-avatar-btn" aria-haspopup="true" aria-expanded="false">
                        <div class="ss-avatar-ring"><div class="ss-avatar-inner">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div></div>
                        <i class="fas fa-chevron-down ss-avatar-chevron"></i>
                    </button>
                    <div id="avatarDropdown" class="ss-dropdown">
                        <div class="ss-dropdown-header">
                            <div class="ss-dropdown-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            <div>
                                <div class="ss-dropdown-name">{{ Auth::user()->name }}</div>
                                <div class="ss-dropdown-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="ss-dropdown-divider"></div>
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="ss-dropdown-item ss-dropdown-item-special">
                            <i class="fas fa-shield-alt"></i><span>Control Panel</span><i class="fas fa-external-link-alt ss-dropdown-item-arrow"></i>
                        </a>
                        <div class="ss-dropdown-divider"></div>
                        @endif
                        <a href="{{ route('user.dashboard') }}" class="ss-dropdown-item"><i class="fas fa-th-large"></i><span>My Dashboard</span></a>
                        <a href="{{ route('profile.edit') }}"   class="ss-dropdown-item"><i class="fas fa-user-cog"></i><span>Profile Settings</span></a>
                        <a href="{{ route('user.my_rents') }}"  class="ss-dropdown-item"><i class="fas fa-book-open"></i><span>My Rentals</span></a>
                        <div class="ss-dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="ss-dropdown-item ss-dropdown-item-danger">
                                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item" style="margin-left:4px;"><a class="ss-btn ss-btn-ghost ss-btn-sm" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item" style="margin-left:4px;"><a class="ss-btn ss-btn-primary ss-btn-sm" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>
</div>

{{-- ═══════ § 1 — HERO ═══════ --}}
<section class="hero">
    <div class="hero-kicker"><i class="fas fa-bolt"></i> DIU Digital Library · Powered by ShelfSync</div>
    <h1 class="hero-h1">Your university books,<br><span class="grad">one smart platform.</span></h1>
    <p class="hero-p">Search the full catalog, get your Digital Student ID, and rent books — all without touching a physical form.</p>
    <div class="hero-ctas">
        @auth
            <a href="{{ url('/dashboard') }}" class="btn-primary-ss"><i class="fas fa-rocket"></i> Go to Dashboard</a>
        @else
            <a href="{{ route('register') }}" class="btn-primary-ss"><i class="fas fa-rocket"></i> Register & Start Renting</a>
            <a href="#search"                 class="btn-ghost-ss">Search Books First <i class="fas fa-arrow-down"></i></a>
        @endauth
    </div>
    <div class="hero-stats">
        <div class="hs">
            <div class="hs-n" style="color:var(--ss-cyan);">{{ $metrics['books'] }}<span style="font-size:1.4rem;">+</span></div>
            <div class="hs-l">Books</div>
        </div>
        <div class="hs-div"></div>
        <div class="hs">
            <div class="hs-n" style="color:#a78bfa;">{{ $metrics['students'] }}<span style="font-size:1.4rem;">+</span></div>
            <div class="hs-l">Students</div>
        </div>
        <div class="hs-div"></div>
        <div class="hs">
            <div class="hs-n" style="color:var(--ss-electric);">{{ $metrics['rentals'] }}<span style="font-size:1.4rem;">+</span></div>
            <div class="hs-l">Rentals Processed</div>
        </div>
    </div>
</section>

{{-- ═══════ INFINITE MARQUEE STRIP ═══════ --}}
<div class="marquee-section">
    <div class="marquee-track">
        <div class="marquee-item"><i class="fas fa-book-open"></i> {{ $metrics['books'] }}+ Books Available</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-graduation-cap"></i> DIU Exclusive Platform</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-bolt"></i> Instant Digital Student ID</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-lock"></i> Zero Paperwork Required</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-clock"></i> 24/7 Online Access</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-id-card-alt"></i> Premium Glassmorphic Cards</div>
        <span class="marquee-dot"></span>
        <!-- Duplicate for seamless loop -->
        <div class="marquee-item"><i class="fas fa-book-open"></i> {{ $metrics['books'] }}+ Books Available</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-graduation-cap"></i> DIU Exclusive Platform</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-bolt"></i> Instant Digital Student ID</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-lock"></i> Zero Paperwork Required</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-clock"></i> 24/7 Online Access</div>
        <span class="marquee-dot"></span>
        <div class="marquee-item"><i class="fas fa-id-card-alt"></i> Premium Glassmorphic Cards</div>
        <span class="marquee-dot"></span>
    </div>
</div>

<hr class="section-divider">

{{-- ═══════ § 2 — SMART SEARCH SANDBOX ═══════ --}}
<section class="search-section" id="search">
    <div class="search-wrap">
        <div class="pill-tag"><i class="fas fa-search"></i> Smart Search</div>
        <h2 class="section-title">Is it in the library?<br><span style="color:var(--ss-cyan);">Find out instantly.</span></h2>
        <p class="section-sub" style="text-align:center;margin:0 auto 36px;">No login needed to browse. Type any title or author and see live availability results.</p>

        <div class="search-bar">
            <i class="fas fa-search search-ico"></i>
            <input type="text" id="live-search-input" placeholder="Try: Clean Code, Harry Potter…" autocomplete="off">
            <button class="search-submit-btn">Search</button>
        </div>
        <div class="search-results-drop" id="search-drop"></div>
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ § 3 — LIVE AVAILABILITY FEED ═══════ --}}
<section class="avail-section" id="available">
    <div class="avail-inner">
        <div class="avail-header">
            <div>
                <div class="pill-tag"><i class="fas fa-circle" style="font-size:0.5rem;"></i> Available Now</div>
                <h2 class="section-title">Ready to rent today.</h2>
                <p class="section-sub">These books are on the shelf right now. Hover to rent — just log in first.</p>
            </div>
            <a href="{{ route('user.books') }}" class="btn-ghost-ss" style="flex-shrink:0;align-self:flex-end;">View All Books <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="book-grid">
            @forelse($availableBooks as $book)
            <div class="bcard">
                @if($book->image && filter_var($book->image, FILTER_VALIDATE_URL))
                    <img class="bcard-cover" src="{{ $book->image }}" alt="{{ $book->name }}"
                         onerror="this.parentNode.querySelector('.bcard-cover-ph').style.display='flex';this.style.display='none';">
                    <div class="bcard-cover-ph" style="display:none;"><i class="fas fa-book"></i><span>{{ Str::limit($book->name, 28) }}</span></div>
                @else
                    <div class="bcard-cover-ph"><i class="fas fa-book"></i><span>{{ Str::limit($book->name, 28) }}</span></div>
                @endif
                <span class="bcard-qty">{{ $book->quantity }} left</span>
                <div class="bcard-hover-layer">
                    @auth
                        <a href="{{ route('user.rent', $book->id) }}" class="bcard-rent-btn">Rent This Book</a>
                    @else
                        <a href="{{ route('login') }}" class="bcard-rent-btn">Login to Rent</a>
                    @endauth
                </div>
                <div class="bcard-body">
                    <div class="bcard-title">{{ $book->name }}</div>
                    <div class="bcard-author">{{ $book->author ?? 'Unknown Author' }}</div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--ss-text-3);">
                <i class="fas fa-book" style="font-size:2rem;margin-bottom:16px;display:block;"></i>
                No books are currently available. Check back soon!
            </div>
            @endforelse
        </div>
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ JOURNEY TIMELINE ═══════ --}}
<section class="timeline-section">
    <div class="timeline-inner">
        <div class="pill-tag"><i class="fas fa-route"></i> How It Works</div>
        <h2 class="section-title">From sign-up to your first book.<br><span style="color:var(--ss-cyan);">In 4 simple steps.</span></h2>
        <p class="section-sub" style="text-align:center;margin:0 auto;">No queues, no forms, no waiting. Here's your journey to unlimited library access.</p>

        <div class="timeline-track">
            <div class="timeline-node">
                <div class="timeline-circle" style="color:var(--ss-cyan);">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="timeline-num">Step 01</div>
                <div class="timeline-title">Register</div>
                <div class="timeline-desc">Create your account with your student email. Takes under 2 minutes.</div>
            </div>
            <div class="timeline-node">
                <div class="timeline-circle" style="color:var(--ss-violet);">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="timeline-num">Step 02</div>
                <div class="timeline-title">Get Approved</div>
                <div class="timeline-desc">A library admin verifies and activates your membership instantly.</div>
            </div>
            <div class="timeline-node">
                <div class="timeline-circle" style="color:var(--ss-electric);">
                    <i class="fas fa-id-card-alt"></i>
                </div>
                <div class="timeline-num">Step 03</div>
                <div class="timeline-title">Get Your Card</div>
                <div class="timeline-desc">Your premium glassmorphic Digital ID is generated automatically.</div>
            </div>
            <div class="timeline-node">
                <div class="timeline-circle" style="color:var(--gold);">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="timeline-num">Step 04</div>
                <div class="timeline-title">Rent Books!</div>
                <div class="timeline-desc">Browse the catalog and rent any available book from your dashboard.</div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ § 4 — DIGITAL ACCESS SHOWCASE ═══════ --}}
<section class="id-section" id="how-it-works">
    <div class="id-inner">

        {{-- Left: Steps --}}
        <div>
            <div class="pill-tag"><i class="fas fa-id-card-alt"></i> Digital Access</div>
            <h2 class="section-title">Your Digital Student ID.<br><span style="color:var(--ss-cyan);">Generated instantly.</span></h2>
            <p class="section-sub" style="margin-bottom:48px;">Stop hunting for physical cards. ShelfSync issues a premium glassmorphic Digital Access Card the moment your account is approved.</p>

            <div class="id-steps">
                <div class="id-step" data-idstep>
                    <div class="id-step-icon" style="background:rgba(0,212,255,0.09);color:var(--ss-cyan);"><i class="fas fa-user-plus"></i></div>
                    <div class="id-step-body">
                        <h3>Step 1 — Register Your Account</h3>
                        <p>Sign up with your student email and ID number. Takes under 2 minutes.</p>
                    </div>
                </div>
                <div class="id-step" data-idstep style="transition-delay:0.12s">
                    <div class="id-step-icon" style="background:rgba(124,58,237,0.09);color:var(--ss-violet);"><i class="fas fa-user-check"></i></div>
                    <div class="id-step-body">
                        <h3>Step 2 — Get Admin Approval</h3>
                        <p>A library admin verifies your details and activates your account with a single click.</p>
                    </div>
                </div>
                <div class="id-step" data-idstep style="transition-delay:0.24s">
                    <div class="id-step-icon" style="background:rgba(6,214,160,0.09);color:var(--ss-electric);"><i class="fas fa-id-card-alt"></i></div>
                    <div class="id-step-body">
                        <h3>Step 3 — Receive Your Digital ID</h3>
                        <p>Your premium glassmorphic Digital Access Card is instantly generated with your name, department, and a 6-month validity.</p>
                    </div>
                </div>
                <div class="id-step" data-idstep style="transition-delay:0.36s">
                    <div class="id-step-icon" style="background:rgba(245,158,11,0.09);color:var(--gold);"><i class="fas fa-book-open"></i></div>
                    <div class="id-step-body">
                        <h3>Step 4 — Start Renting Books</h3>
                        <p>Browse the full catalog and rent any available book from your dashboard. No paperwork, ever.</p>
                    </div>
                </div>
            </div>

            <div style="margin-top:40px;">
                @guest
                <a href="{{ route('register') }}" class="btn-primary-ss"><i class="fas fa-rocket"></i> Get Your Digital ID Now</a>
                @endguest
            </div>
        </div>

        {{-- Right: ID Card Mockup --}}
        <div class="id-card-wrap">
            <div class="id-card" id="id-card-mockup">
                <div class="card-logo-row">
                    <div class="card-logo-text">ShelfSync</div>
                    <div class="card-chip"></div>
                </div>
                <div class="card-id-ring">S</div>
                <div class="card-name">Student Name</div>
                <div class="card-dept">Department of Software Engineering</div>
                <div class="card-bottom">
                    <div>
                        <div class="card-sid">232-35-XXX</div>
                        <div class="card-active" style="margin-top:8px;">● ACTIVE</div>
                    </div>
                    <div class="card-valid">
                        VALID THRU
                        <span>{{ now()->addMonths(6)->format('m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ § 5 — DUE BACK SOON RADAR ═══════ --}}
<section class="radar-section" id="radar">
    <div class="radar-inner">
        <div class="radar-header">
            <div class="pill-tag" style="color:var(--ss-amber);background:rgba(245,158,11,0.07);border-color:rgba(245,158,11,0.2);">
                <span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:var(--ss-amber);box-shadow:0 0 8px rgba(245,158,11,0.7);animation:pulse 1.5s infinite;"></span>
                Due Back Soon
            </div>
            <h2 class="section-title">Popular books returning soon.</h2>
            <p class="section-sub">These titles are currently checked out but returning within the next 10 days. Register now to be ready to rent them the moment they land back on the shelf.</p>
        </div>

        @if($dueSoonRentals->count() > 0)
        <div class="radar-grid">
            @foreach($dueSoonRentals as $rental)
            @php $daysLeft = now()->diffInDays($rental->due_date, false); @endphp
            <div class="radar-card">
                @if($rental->book && $rental->book->image && filter_var($rental->book->image, FILTER_VALIDATE_URL))
                    <img class="radar-book-thumb" src="{{ $rental->book->image }}" alt="{{ $rental->book->name }}" onerror="this.outerHTML='<div class=radar-book-ph><i class=fas fa-book></i></div>'">
                @else
                    <div class="radar-book-ph"><i class="fas fa-book"></i></div>
                @endif
                <div class="radar-info">
                    <div class="radar-title">{{ $rental->book->name ?? 'Unknown Book' }}</div>
                    <div class="radar-author">{{ $rental->book->author ?? 'Unknown Author' }}</div>
                    <div class="radar-due">
                        <span class="radar-pulse"></span>
                        <span style="color:var(--ss-amber);">
                            @if($daysLeft <= 0) Due today
                            @elseif($daysLeft === 1) Due tomorrow
                            @else Due in {{ $daysLeft }} days
                            @endif
                        </span>
                    </div>
                </div>
                @guest
                <a href="{{ route('register') }}" style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.25);color:var(--gold);border-radius:var(--r-pill);padding:6px 14px;font-size:0.7rem;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0;">Notify me</a>
                @endguest
            </div>
            @endforeach
        </div>
        @else
        <div class="radar-empty">
            <i class="fas fa-check-circle" style="font-size:2.5rem;color:var(--ss-electric);margin-bottom:16px;display:block;"></i>
            <strong style="color:#fff;display:block;margin-bottom:8px;">Great news!</strong>
            No popular books are overdue right now — most titles are available to rent today.
            <div style="margin-top:20px;"><a href="{{ route('user.books') }}" class="btn-primary-ss" style="font-size:0.82rem;padding:10px 24px;">Browse the Catalog</a></div>
        </div>
        @endif
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ FEATURE SHOWCASE (BENTO GRID) ═══════ --}}
<section class="features-section" id="features">
    <div class="features-bg-text">Smart Search · Digital ID · Zero Fines Confusion · Track Progress · Instant Rentals · Smart Search · Digital ID · Zero Fines Confusion · Track Progress · Instant Rentals ·</div>
    <div class="features-inner">
        <div class="features-header">
            <div class="pill-tag"><i class="fas fa-star"></i> Platform Features</div>
            <h2 class="section-title">Everything you need.<br><span style="color:var(--ss-cyan);">All in one place.</span></h2>
            <p class="section-sub" style="text-align:center;margin:0 auto;">ShelfSync isn't just a catalog — it's your complete digital library companion.</p>
        </div>
        <div class="bento-grid">
            <div class="bento-card large">
                <div class="bento-icon" style="background:rgba(0,212,255,0.08);color:var(--ss-cyan);"><i class="fas fa-search"></i></div>
                <h3>Smart Search</h3>
                <p>Search the entire catalog in real-time. Find books by title, author, or category — results appear as you type with instant availability status.</p>
            </div>
            <div class="bento-card">
                <div class="bento-icon" style="background:rgba(124,58,237,0.08);color:var(--ss-violet);"><i class="fas fa-id-card-alt"></i></div>
                <h3>Digital Student ID</h3>
                <p>A premium glassmorphic access card generated automatically with your details and 6-month validity.</p>
            </div>
            <div class="bento-card">
                <div class="bento-icon" style="background:rgba(6,214,160,0.08);color:var(--ss-electric);"><i class="fas fa-balance-scale"></i></div>
                <h3>Fine Management</h3>
                <p>Transparent fine tracking with a built-in appeal system. Know exactly what you owe and why.</p>
            </div>
            <div class="bento-card">
                <div class="bento-icon" style="background:rgba(245,158,11,0.08);color:var(--gold);"><i class="fas fa-clock"></i></div>
                <h3>24/7 Online Access</h3>
                <p>Browse and rent books anytime, from any device. The library never closes.</p>
            </div>
            <div class="bento-card large">
                <div class="bento-icon" style="background:rgba(244,63,94,0.08);color:var(--ss-rose);"><i class="fas fa-chart-line"></i></div>
                <h3>Reading Progress Tracker</h3>
                <p>Track every book you've rented, monitor due dates at a glance, and build your reading history. ShelfSync keeps your entire library journey organized in one beautiful dashboard.</p>
            </div>
            <div class="bento-card">
                <div class="bento-icon" style="background:rgba(0,212,255,0.08);color:var(--ss-cyan);"><i class="fas fa-file-alt"></i></div>
                <h3>Zero Paperwork</h3>
                <p>Everything is digital — registration, approvals, rentals, and returns. No forms required.</p>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ FAQ ACCORDION ═══════ --}}
<section class="faq-section" id="faq">
    <div class="faq-inner">
        <div class="faq-header">
            <div class="pill-tag"><i class="fas fa-question-circle"></i> FAQ</div>
            <h2 class="section-title">Got questions?<br><span style="color:var(--ss-cyan);">We've got answers.</span></h2>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)">
                <span>How do I start renting books?</span>
                <i class="fas fa-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-a"><p>Create a free account, wait for admin approval (usually within 24 hours), then browse the catalog and rent any available book with a single click.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)">
                <span>Is there a fine for late returns?</span>
                <i class="fas fa-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-a"><p>Yes, a small daily fine is applied after your due date. You can track all fines in your dashboard and even submit an appeal if you believe it was an error.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)">
                <span>How do I get my Digital Student ID?</span>
                <i class="fas fa-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-a"><p>Your Digital Access Card is automatically generated the moment an admin approves your account. You'll find it in your dashboard — no extra steps required.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)">
                <span>Can I rent multiple books at once?</span>
                <i class="fas fa-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-a"><p>Absolutely! You can rent as many available books as you need. Each rental has its own due date that you can track from your personal dashboard.</p></div>
        </div>
        <div class="faq-item">
            <div class="faq-q" onclick="toggleFaq(this)">
                <span>What happens if I lose a book?</span>
                <i class="fas fa-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-a"><p>Contact the library admin through the platform. A replacement fee based on the book's value will be applied to your account, and you can use the fine appeal system if needed.</p></div>
        </div>
    </div>
</section>

<hr class="section-divider">

{{-- ═══════ § 6 — CONVERSION CTA BANNER ═══════ --}}
@guest
<div class="cta-banner">
    <h2>Ready to get started?</h2>
    <p>Join hundreds of DIU students already using ShelfSync. Register in under 2 minutes and get your Digital Library Card today.</p>
    <div class="cta-banner-btns">
        <a href="{{ route('register') }}" class="btn-primary-ss" style="font-size:1rem;padding:16px 40px;"><i class="fas fa-rocket"></i> Register Free</a>
        <a href="{{ route('login') }}"    class="btn-ghost-ss"  style="font-size:1rem;padding:16px 40px;">Already have an account? Log In</a>
    </div>
</div>
@endguest

{{-- ═══════ § 7 — FOOTER ═══════ --}}
<footer class="landing-footer">
    <a href="/" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
        <img src="{{ asset('img/shelfsync.svg') }}" height="24" alt="ShelfSync">
        <span style="font-family:var(--ss-font-display);font-weight:700;font-size:0.92rem;color:var(--ss-text-3);">ShelfSync</span>
    </a>
    <div class="footer-links">
        <a href="#search">Search Books</a>
        <a href="#available">Available Now</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#features">Features</a>
        <a href="#faq">FAQ</a>
        @auth <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else <a href="{{ route('login') }}">Log In</a><a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
    <p style="color:var(--ss-text-3);font-size:0.78rem;">© {{ date('Y') }} ShelfSync · DIU Digital Library</p>
</footer>

{{-- ═══════ SEARCH OVERLAY (triggered by nav search icon) ═══════ --}}
<div id="search-overlay"
     style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(10,10,11,0.94);backdrop-filter:blur(18px);align-items:flex-start;justify-content:center;padding-top:130px;">
    <div style="width:100%;max-width:640px;padding:0 20px;">
        <div style="position:relative;">
            <i class="fas fa-search" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);color:var(--ss-text-3);font-size:1rem;pointer-events:none;"></i>
            <input id="overlay-search-input" type="text" class="ss-input" placeholder="Search books, authors…"
                   style="font-size:1rem;padding:16px 22px 16px 48px !important;border-radius:16px !important;">
        </div>
        <p style="font-size:0.78rem;color:var(--ss-text-3);margin-top:14px;text-align:center;">
            Press <kbd style="background:rgba(255,255,255,0.08);border:1px solid var(--ss-border);border-radius:4px;padding:1px 6px;font-family:monospace;">Esc</kbd> to close &nbsp;·&nbsp;
            Press <kbd style="background:rgba(255,255,255,0.08);border:1px solid var(--ss-border);border-radius:4px;padding:1px 6px;font-family:monospace;">Enter</kbd> to search
        </p>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Mobile navbar border-radius ── */
    $('#mainNav')
        .on('show.bs.collapse', ()=>{ document.querySelector('.ss-navbar-pill').style.borderRadius='20px'; })
        .on('hide.bs.collapse', ()=>{ document.querySelector('.ss-navbar-pill').style.borderRadius='100px'; });

    /* ── Avatar Dropdown ── */
    const avatarBtn = document.getElementById('avatarBtn');
    const avatarDd  = document.getElementById('avatarDropdown');
    if (avatarBtn && avatarDd) {
        avatarBtn.addEventListener('click', e => {
            e.stopPropagation();
            const open = avatarDd.classList.contains('open');
            avatarDd.classList.toggle('open', !open);
            const chev = avatarBtn.querySelector('.ss-avatar-chevron');
            if (chev) chev.style.transform = open ? 'rotate(0deg)' : 'rotate(180deg)';
        });
        document.addEventListener('click', () => {
            avatarDd.classList.remove('open');
            const chev = avatarBtn?.querySelector('.ss-avatar-chevron');
            if (chev) chev.style.transform = 'rotate(0deg)';
        });
        avatarDd.addEventListener('click', e => e.stopPropagation());
    }

    /* ── Nav Search Overlay ── */
    const overlay      = document.getElementById('search-overlay');
    const overlayInput = document.getElementById('overlay-search-input');
    const navSearchBtn = document.getElementById('nav-search-btn');
    if (navSearchBtn) {
        navSearchBtn.addEventListener('click', ()=>{ overlay.style.display='flex'; setTimeout(()=>overlayInput.focus(),60); });
        navSearchBtn.addEventListener('mouseenter', function(){ this.style.borderColor='rgba(0,212,255,0.45)'; this.style.color='var(--ss-cyan)'; });
        navSearchBtn.addEventListener('mouseleave', function(){ this.style.borderColor='rgba(255,255,255,0.12)'; this.style.color='var(--ss-text-2)'; });
    }
    document.addEventListener('keydown', e => {
        if (e.key==='Escape') overlay.style.display='none';
        if ((e.ctrlKey||e.metaKey)&&e.key==='k'){ e.preventDefault(); overlay.style.display='flex'; setTimeout(()=>overlayInput?.focus(),60); }
    });
    overlay?.addEventListener('click', e=>{ if(e.target===overlay) overlay.style.display='none'; });
    overlayInput?.addEventListener('keydown', e=>{
        if (e.key==='Enter'&&overlayInput.value.trim())
            window.location.href = '{{ route("user.books") }}?search='+encodeURIComponent(overlayInput.value.trim());
    });

    /* ── ID Card: RAF-based 60fps tilt (zero jank) ── */
    const card = document.getElementById('id-card-mockup');
    if (card) {
        let rafId    = null;
        let targetRY = -8, targetRX = 4;   // resting defaults
        let currentRY= -8, currentRX = 4;
        const LERP = 0.12;                  // interpolation speed

        function lerpVal(a, b, t) { return a + (b - a) * t; }

        function animateTilt() {
            currentRY = lerpVal(currentRY, targetRY, LERP);
            currentRX = lerpVal(currentRX, targetRX, LERP);
            card.style.transform =
                `perspective(1000px) rotateY(${currentRY.toFixed(3)}deg) rotateX(${currentRX.toFixed(3)}deg) scale(1.025)`;
            // Keep looping while mouse is over
            rafId = requestAnimationFrame(animateTilt);
        }

        card.addEventListener('mouseenter', () => {
            card.classList.add('is-tilting');
            card.classList.remove('is-resetting');
            card.style.transition = 'none'; // RAF drives it — no CSS transition during move
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(animateTilt);
        });

        card.addEventListener('mousemove', e => {
            const r  = card.getBoundingClientRect();
            const cx = (e.clientX - r.left) / r.width  - 0.5; // -0.5 … +0.5
            const cy = (e.clientY - r.top)  / r.height - 0.5;
            targetRY =  cx * 16;   // max ±16° horizontal
            targetRX = -cy * 10;   // max ±10° vertical
        });

        card.addEventListener('mouseleave', () => {
            // Cancel RAF loop
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            // Smooth CSS transition back to rest
            card.classList.remove('is-tilting');
            card.classList.add('is-resetting');
            card.style.transition = '';
            card.style.transform  = 'perspective(1000px) rotateY(-8deg) rotateX(4deg)';
            // Re-enable float animation after the reset settles
            setTimeout(() => {
                card.classList.remove('is-resetting');
                card.style.transform = '';
            }, 580);
        });
    }

    /* ── Live Section Search ── */
    const searchInput = document.getElementById('live-search-input');
    const searchDrop  = document.getElementById('search-drop');
    const allBooks    = @json($searchableBooks);

    function imgEl(b) {
        if (b.image) return `<img class="sri-thumb" src="${b.image}" alt="" onerror="this.outerHTML='<div class=sri-ph><i class=fas fa-book></i></div>'">`;
        return `<div class="sri-ph"><i class="fas fa-book"></i></div>`;
    }

    searchInput?.addEventListener('input', () => {
        const q = searchInput.value.trim().toLowerCase();
        if (!q) { searchDrop.style.display = 'none'; return; }
        const hits = allBooks.filter(b => b.name.toLowerCase().includes(q) || (b.author||'').toLowerCase().includes(q)).slice(0, 7);
        if (!hits.length) { searchDrop.style.display = 'none'; return; }
        searchDrop.innerHTML = hits.map(b => `
            <a class="sri" href="{{ route('user.books') }}">
                ${imgEl(b)}
                <div style="flex:1;min-width:0;">
                    <div class="sri-name">${b.name}</div>
                    <div class="sri-auth">${b.author || 'Unknown Author'}</div>
                </div>
                <span class="sri-cta">{{ auth()->check() ? 'View' : 'Login to Rent' }}</span>
            </a>`).join('');
        searchDrop.style.display = 'block';
    });
    document.addEventListener('click', e => {
        if (!e.target.closest('.search-wrap')) searchDrop.style.display = 'none';
    });

    /* Typewriter placeholder */
    const hints = ['Clean Code', 'Harry Potter', 'Introduction to Algorithms', 'The Alchemist', 'JavaScript'];
    let hi = 0, ci = 0, typing = true;
    (function type() {
        if (document.activeElement === searchInput) { setTimeout(type, 200); return; }
        const h = hints[hi];
        if (typing) { searchInput.placeholder = 'Try: ' + h.substring(0, ci+1) + '…'; ci++; if (ci >= h.length){ typing=false; setTimeout(type, 1800); return; } }
        else { ci--; searchInput.placeholder = 'Try: ' + h.substring(0, ci) + '…'; if (ci <= 0){ typing=true; hi=(hi+1)%hints.length; } }
        setTimeout(type, typing ? 90 : 50);
    })();

    /* ── Journey steps IntersectionObserver ── */
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.25 });
    document.querySelectorAll('[data-idstep]').forEach(el => io.observe(el));
});

/* ── FAQ Accordion (one-at-a-time toggle) ── */
function toggleFaq(el) {
    const item = el.parentElement;
    const wasOpen = item.classList.contains('open');
    // Close all
    document.querySelectorAll('.faq-item.open').forEach(i => i.classList.remove('open'));
    // Toggle clicked
    if (!wasOpen) item.classList.add('open');
}
</script>

@include('components.global-fx')
</body>
</html>
