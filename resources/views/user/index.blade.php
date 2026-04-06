<x-user-layout>

<style>
/* ── Landing Page Specific ── */
.hero {
    min-height: 92vh;
    display: flex; align-items: center; justify-content: center;
    text-align: center; position: relative;
    padding: 80px 0 60px;
}
.hero::before {
    content: '';
    position: absolute; inset: 0; z-index: 0; pointer-events: none;
    background:
        radial-gradient(ellipse 80% 60% at 50% 30%, rgba(0,212,255,0.07) 0%, transparent 60%),
        radial-gradient(ellipse 50% 40% at 80% 60%, rgba(124,58,237,0.05) 0%, transparent 60%);
}
.hero > .container { position: relative; z-index: 1; }

.hero-chip {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 18px; border-radius: var(--ss-r-pill);
    background: rgba(0,212,255,0.08); border: 1px solid rgba(0,212,255,0.20);
    font-size: 0.76rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--ss-cyan); margin-bottom: 28px;
}
.hero-chip-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--ss-cyan); box-shadow: 0 0 10px var(--ss-cyan-glow);
    animation: pulse-dot 2.2s ease-in-out infinite;
}

.hero h1 {
    font-family: var(--ss-font-display) !important;
    font-size: clamp(2.6rem, 6vw, 5rem);
    font-weight: 900; letter-spacing: -0.04em; line-height: 1.04;
    margin-bottom: 22px;
}
.hero p.lead {
    color: var(--ss-text-2); font-size: 1.08rem; max-width: 560px;
    margin: 0 auto 36px; line-height: 1.75;
}
.hero-actions { display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap; }

.hero-stats {
    display: flex; align-items: center; justify-content: center; gap: 40px;
    margin-top: 64px; flex-wrap: wrap;
}
.hero-stat-num {
    font-family: var(--ss-font-display) !important; font-size: 2rem; font-weight: 800;
    letter-spacing: -0.04em; color: #fff;
}
.hero-stat-label { font-size: 0.78rem; color: var(--ss-text-2); margin-top: 2px; }

/* Feature cards */
.features-section { padding: 100px 0; }
.features-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 22px;
}
.feature-card {
    background: var(--ss-surface);
    backdrop-filter: var(--ss-blur); -webkit-backdrop-filter: var(--ss-blur);
    border: 1px solid var(--ss-border); border-radius: var(--ss-r-lg);
    padding: 32px 28px;
    transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s;
    position: relative; overflow: hidden;
}
.feature-card::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    border-radius: 2px;
    transition: opacity 0.3s; opacity: 0;
}
.feature-card:hover { border-color: var(--ss-border-strong); transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.4); }
.feature-card:hover::after { opacity: 1; }
.fc-cyan::after   { background: linear-gradient(90deg, var(--ss-cyan), var(--ss-blue)); }
.fc-violet::after { background: linear-gradient(90deg, var(--ss-violet), var(--ss-cyan)); }
.fc-electric::after { background: linear-gradient(90deg, var(--ss-electric), var(--ss-blue)); }
.fc-amber::after  { background: linear-gradient(90deg, var(--ss-amber), var(--ss-rose)); }

.feature-icon {
    width: 54px; height: 54px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; margin-bottom: 20px;
    transition: transform 0.4s cubic-bezier(.34,1.56,.64,1);
}
.feature-card:hover .feature-icon { transform: scale(1.14) rotate(-8deg); }
.fi-cyan    { background: rgba(0,212,255,0.12);   color: var(--ss-cyan);    box-shadow: 0 4px 16px rgba(0,212,255,0.15); }
.fi-violet  { background: rgba(124,58,237,0.12);  color: #a78bfa;           box-shadow: 0 4px 16px rgba(124,58,237,0.15); }
.fi-electric{ background: rgba(6,214,160,0.12);   color: var(--ss-electric);box-shadow: 0 4px 16px rgba(6,214,160,0.15); }
.fi-amber   { background: rgba(245,158,11,0.12);  color: var(--ss-amber);   box-shadow: 0 4px 16px rgba(245,158,11,0.15); }

.feature-card h4 {
    font-family: var(--ss-font-display) !important; font-size: 1.05rem;
    font-weight: 700; color: #fff; margin-bottom: 10px;
}
.feature-card p { font-size: 0.86rem; color: var(--ss-text-2); line-height: 1.7; margin: 0; }

/* CTA Banner */
.cta-banner {
    background: linear-gradient(135deg, rgba(0,212,255,0.08), rgba(124,58,237,0.08));
    border: 1px solid rgba(0,212,255,0.14);
    border-radius: var(--ss-r-xl); padding: 60px 40px; text-align: center; margin: 0 0 80px;
    position: relative; overflow: hidden;
}
.cta-banner::before {
    content: ''; position: absolute; top: -60px; left: 50%; transform: translateX(-50%);
    width: 300px; height: 300px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,212,255,0.08), transparent 70%);
    pointer-events: none;
}
.cta-banner h2 { font-family: var(--ss-font-display) !important; font-size: 2rem; font-weight: 800; margin-bottom: 12px; }
.cta-banner p  { color: var(--ss-text-2); font-size: 0.95rem; max-width: 480px; margin: 0 auto 28px; line-height: 1.7; }
</style>

<!-- ── HERO ── -->
<section class="hero">
    <div class="container">
        <div class="hero-chip anim-fade-up">
            <div class="hero-chip-dot"></div>
            Open Access Library Platform
        </div>

        <h1 class="anim-fade-up-1">
            Your Knowledge<br>
            <span class="gradient-text">Hub Awaits</span>
        </h1>

        <p class="lead anim-fade-up-2">
            Discover, rent, and manage thousands of books, journals, and research papers.
            {{ config('app.name') }} brings the entire library to your fingertips.
        </p>

        <div class="hero-actions anim-fade-up-3">
            <a href="{{ route('user.books') }}" class="ss-btn ss-btn-primary ss-btn-lg">
                <i class="fas fa-book-open"></i> Browse Catalog
            </a>
            @guest
            <a href="{{ route('register') }}" class="ss-btn ss-btn-ghost ss-btn-lg">
                <i class="fas fa-user-plus"></i> Join Free
            </a>
            @endguest
        </div>

        <div class="hero-stats anim-fade-up-4">
            <div>
                <div class="hero-stat-num">{{ number_format(\App\Models\Book::count()) }}+</div>
                <div class="hero-stat-label">Books Available</div>
            </div>
            <div style="width:1px;height:40px;background:var(--ss-border);"></div>
            <div>
                <div class="hero-stat-num">{{ number_format(\App\Models\User::where('role','user')->count()) }}+</div>
                <div class="hero-stat-label">Registered Members</div>
            </div>
            <div style="width:1px;height:40px;background:var(--ss-border);"></div>
            <div>
                <div class="hero-stat-num">{{ number_format(\App\Models\Rental::count()) }}+</div>
                <div class="hero-stat-label">Books Rented</div>
            </div>
        </div>
    </div>
</section>

<!-- ── FEATURES ── -->
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <div class="ss-section-label" style="justify-content:center;">Features</div>
            <h2 style="font-size:2.2rem;font-weight:800;margin-bottom:12px;">Everything You Need</h2>
            <p style="color:var(--ss-text-2);font-size:0.95rem;max-width:480px;margin:0 auto;">A complete library management system built for students and researchers.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card fc-cyan anim-fade-up-1">
                <div class="feature-icon fi-cyan"><i class="fas fa-search"></i></div>
                <h4>Smart Search</h4>
                <p>Instantly find books by title, author, or category across our entire catalog with real-time results.</p>
            </div>
            <div class="feature-card fc-violet anim-fade-up-2">
                <div class="feature-icon fi-violet"><i class="fas fa-bookmark"></i></div>
                <h4>One-Click Rental</h4>
                <p>Submit rental requests online. Track your active rentals, return dates, and overdue alerts in one place.</p>
            </div>
            <div class="feature-card fc-electric anim-fade-up-3">
                <div class="feature-icon fi-electric"><i class="fas fa-heart"></i></div>
                <h4>Wishlist</h4>
                <p>Save books you're interested in to your personal wishlist. Your list is synced across all your devices.</p>
            </div>
            <div class="feature-card fc-amber anim-fade-up-4">
                <div class="feature-icon fi-amber"><i class="fas fa-clock"></i></div>
                <h4>Due Date Alerts</h4>
                <p>Never miss a return deadline. Live countdown timers show exactly how many days remain on each rental.</p>
            </div>
            <div class="feature-card fc-cyan">
                <div class="feature-icon fi-cyan"><i class="fas fa-layer-group"></i></div>
                <h4>Category Browse</h4>
                <p>Organized by subject, department, and genre — find exactly what you need for your coursework.</p>
            </div>
            <div class="feature-card fc-violet">
                <div class="feature-icon fi-violet"><i class="fas fa-history"></i></div>
                <h4>Rental History</h4>
                <p>View your complete borrowing history, including returned books and their original rental dates.</p>
            </div>
        </div>
    </div>
</section>

<!-- ── CTA ── -->
<div class="container">
    <div class="cta-banner">
        <h2>Ready to Start Reading?</h2>
        <p>Join {{ number_format(\App\Models\User::where('role','user')->count()) }} members already using {{ config('app.name') }} to access their library.</p>
        @guest
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="ss-btn ss-btn-primary ss-btn-lg">
                    <i class="fas fa-rocket"></i> Get Started Free
                </a>
                <a href="{{ route('login') }}" class="ss-btn ss-btn-ghost ss-btn-lg">Sign In</a>
            </div>
        @else
            <a href="{{ route('user.books') }}" class="ss-btn ss-btn-primary ss-btn-lg">
                <i class="fas fa-book-open"></i> Browse Collection
            </a>
        @endguest
    </div>
</div>

</x-user-layout>