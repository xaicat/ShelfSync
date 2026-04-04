<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}{{ isset($title) ? ' — ' : '' }}{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
    {{ $styles ?? '' }}
</head>
<body>

<!-- ── Navbar ── -->
<nav class="ss-navbar navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}" style="gap:10px;text-decoration:none;">
            <img src="{{ asset('img/shelfsync.svg') }}" height="36" alt="{{ config('app.name') }}">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
            style="border:1px solid var(--ss-border-strong);border-radius:8px;padding:6px 10px;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            @auth
            <span class="mx-auto d-none d-lg-block" style="font-family:var(--ss-font-display);font-size:0.82rem;font-weight:600;background:linear-gradient(135deg,#fff,var(--ss-cyan));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                {{ Auth::user()->name }}
            </span>
            @endauth

            <ul class="navbar-nav ml-auto d-flex align-items-center" style="gap:2px;">
                <!-- Search -->
                <li class="nav-item mr-2">
                    <button id="nav-search-btn" class="ss-btn ss-btn-ghost ss-btn-sm" aria-label="Search"
                        style="border:1px solid var(--ss-border-strong);border-radius:8px;width:34px;height:34px;padding:0;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-search" style="font-size:0.82rem;"></i>
                    </button>
                </li>
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('home') ? 'active':'' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('user.books') ? 'active':'' }}" href="{{ route('user.books') }}">Books</a></li>
                <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('contact') ? 'active':'' }}" href="{{ route('contact') }}">Contact</a></li>

                @auth
                    <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('user.my_rents') ? 'active':'' }}" href="{{ route('user.my_rents') }}">My Rents</a></li>
                    <li class="nav-item"><a class="ss-nav-link nav-link {{ request()->routeIs('user.wishlist*') ? 'active':'' }}" href="#">Wishlist</a></li>
                    <li class="nav-item ml-2">
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="ss-btn ss-btn-ghost ss-btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ml-2"><a class="ss-btn ss-btn-ghost ss-btn-sm" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item ml-2"><a class="ss-btn ss-btn-primary ss-btn-sm" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Search Overlay -->
<div id="search-overlay" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(10,10,11,0.92);backdrop-filter:blur(16px);align-items:flex-start;justify-content:center;padding-top:120px;">
    <div style="width:100%;max-width:600px;padding:0 20px;">
        <input id="search-input" type="text" class="ss-input" placeholder="Search books, authors, categories…"
            style="font-size:1.1rem;padding:16px 22px !important;border-radius:14px !important;">
        <p style="font-size:0.8rem;color:var(--ss-text-3);margin-top:12px;text-align:center;">Press Esc to close</p>
    </div>
</div>

<main>
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        </div>
    @endif
    {{ $slot }}
</main>

<button id="back-to-top" style="position:fixed;bottom:28px;right:28px;width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));border:none;color:#fff;opacity:0;transition:opacity 0.3s,transform 0.3s;z-index:1000;cursor:pointer;box-shadow:0 4px 16px var(--ss-cyan-glow);">
    <i class="fas fa-arrow-up" style="font-size:0.85rem;"></i>
</button>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
// Back to top
window.addEventListener('scroll', () => {
    document.getElementById('back-to-top').style.opacity = window.scrollY > 300 ? '1' : '0';
});
document.getElementById('back-to-top').addEventListener('click', () => window.scrollTo({top: 0, behavior: 'smooth'}));

// Search overlay
const overlay = document.getElementById('search-overlay');
const searchInput = document.getElementById('search-input');
document.getElementById('nav-search-btn').addEventListener('click', () => {
    overlay.style.display = 'flex';
    searchInput.focus();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') overlay.style.display = 'none';
});
overlay.addEventListener('click', e => { if (e.target === overlay) overlay.style.display = 'none'; });

// Search redirect
searchInput.addEventListener('keydown', e => {
    if (e.key === 'Enter' && searchInput.value.trim()) {
        window.location.href = '{{ route("user.books") }}?search=' + encodeURIComponent(searchInput.value.trim());
    }
});
</script>
{{ $scripts ?? '' }}
</body>
</html>