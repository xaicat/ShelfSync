<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}{{ isset($title) ? ' — ' : '' }}{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
    {{ $styles ?? '' }}
</head>
<body class="ss-body-offset">

{{-- ════════════════════════════════════════════════════════
     FLOATING PILL NAVBAR
     Wrapper: positions pill; pill has glass + blur
════════════════════════════════════════════════════════ --}}
<div class="ss-nav-float-wrap">
    <nav class="ss-navbar-pill navbar navbar-expand-lg navbar-dark">

        {{-- ── LEFT: Logo only ── --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/shelfsync.svg') }}" height="30" alt="{{ config('app.name') }}"
                 style="display:block;">
        </a>

        {{-- ── Mobile toggler ── --}}
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- ── RIGHT: Everything else in ONE ml-auto group ── --}}
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto align-items-center" style="gap:2px;">

                {{-- Search Icon (leftmost of right group) --}}
                <li class="nav-item">
                    <button id="nav-search-btn" aria-label="Search"
                            style="background:none;border:1px solid rgba(255,255,255,0.12);border-radius:8px;
                                   width:34px;height:34px;color:var(--ss-text-2);cursor:pointer;
                                   display:flex;align-items:center;justify-content:center;
                                   transition:border-color 0.2s,color 0.2s;margin-right:6px;">
                        <i class="fas fa-search" style="font-size:0.78rem;"></i>
                    </button>
                </li>

                {{-- Nav Links --}}
                <li class="nav-item">
                    <a class="ss-nav-link nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="ss-nav-link nav-link {{ request()->routeIs('user.books') ? 'active' : '' }}"
                       href="{{ route('user.books') }}">Books</a>
                </li>
                <li class="nav-item">
                    <a class="ss-nav-link nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">Contact</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="ss-nav-link nav-link {{ request()->routeIs('user.my_rents') ? 'active' : '' }}"
                       href="{{ route('user.my_rents') }}">My Rents</a>
                </li>
                @endauth

                {{-- Vertical separator --}}
                <li class="nav-item d-none d-lg-flex align-items-center">
                    <div class="ss-nav-sep"></div>
                </li>

                {{-- ── Auth area ── --}}
                @auth
                {{-- Avatar Dropdown --}}
                <li class="nav-item dropdown">
                    <button id="avatarBtn" class="ss-avatar-btn" aria-haspopup="true" aria-expanded="false">
                        <div class="ss-avatar-ring">
                            <div class="ss-avatar-inner">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <i class="fas fa-chevron-down ss-avatar-chevron"></i>
                    </button>

                    {{-- Glassmorphic Dropdown --}}
                    <div id="avatarDropdown" class="ss-dropdown">
                        <div class="ss-dropdown-header">
                            <div class="ss-dropdown-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="ss-dropdown-name">{{ Auth::user()->name }}</div>
                                <div class="ss-dropdown-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="ss-dropdown-divider"></div>

                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="ss-dropdown-item ss-dropdown-item-special">
                            <i class="fas fa-shield-alt"></i>
                            <span>Control Panel</span>
                            <i class="fas fa-external-link-alt ss-dropdown-item-arrow"></i>
                        </a>
                        <div class="ss-dropdown-divider"></div>
                        @endif

                        <a href="{{ route('user.dashboard') }}"
                           class="ss-dropdown-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-th-large"></i><span>My Dashboard</span>
                        </a>
                        <a href="{{ route('profile.edit') }}"
                           class="ss-dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <i class="fas fa-user-cog"></i><span>Profile Settings</span>
                        </a>
                        <a href="{{ route('user.my_rents') }}" class="ss-dropdown-item">
                            <i class="fas fa-book-open"></i><span>My Rentals</span>
                        </a>

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
                <li class="nav-item" style="margin-left:4px;">
                    <a class="ss-btn ss-btn-ghost ss-btn-sm" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item" style="margin-left:4px;">
                    <a class="ss-btn ss-btn-primary ss-btn-sm" href="{{ route('register') }}">Register</a>
                </li>
                @endauth

            </ul>
        </div>{{-- /navbar-collapse --}}

    </nav>
</div>{{-- /ss-nav-float-wrap --}}


{{-- Search Overlay --}}
<div id="search-overlay"
     style="display:none;position:fixed;inset:0;z-index:9999;
            background:rgba(10,10,11,0.94);backdrop-filter:blur(18px);
            align-items:flex-start;justify-content:center;padding-top:130px;">
    <div style="width:100%;max-width:640px;padding:0 20px;">
        <div style="position:relative;">
            <i class="fas fa-search"
               style="position:absolute;left:20px;top:50%;transform:translateY(-50%);
                      color:var(--ss-text-3);font-size:1rem;pointer-events:none;"></i>
            <input id="search-input" type="text" class="ss-input"
                   placeholder="Search books, authors, categories…"
                   style="font-size:1rem;padding:16px 22px 16px 48px !important;border-radius:16px !important;">
        </div>
        <p style="font-size:0.78rem;color:var(--ss-text-3);margin-top:14px;text-align:center;">
            Press <kbd style="background:rgba(255,255,255,0.08);border:1px solid var(--ss-border);border-radius:4px;padding:1px 6px;font-family:monospace;">Esc</kbd>
            to close &nbsp;·&nbsp;
            Press <kbd style="background:rgba(255,255,255,0.08);border:1px solid var(--ss-border);border-radius:4px;padding:1px 6px;font-family:monospace;">Enter</kbd>
            to search
        </p>
    </div>
</div>


{{-- Page Content --}}
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


{{-- Back to top --}}
<button id="back-to-top"
        style="position:fixed;bottom:28px;right:28px;width:44px;height:44px;border-radius:50%;
               background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));border:none;
               color:#fff;opacity:0;transition:opacity 0.3s,transform 0.3s;z-index:1000;
               cursor:pointer;box-shadow:0 4px 16px var(--ss-cyan-glow);">
    <i class="fas fa-arrow-up" style="font-size:0.85rem;"></i>
</button>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
// ── Mobile: when pill nav expands, soften border-radius ───────
$('#mainNav').on('show.bs.collapse', function () {
    document.querySelector('.ss-navbar-pill').style.borderRadius = '20px';
}).on('hide.bs.collapse', function () {
    document.querySelector('.ss-navbar-pill').style.borderRadius = '100px';
});

// ── Back to top ────────────────────────────────────────────────
window.addEventListener('scroll', function () {
    document.getElementById('back-to-top').style.opacity = window.scrollY > 300 ? '1' : '0';
});
document.getElementById('back-to-top').addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// ── Search overlay ─────────────────────────────────────────────
var overlay     = document.getElementById('search-overlay');
var searchInput = document.getElementById('search-input');
var searchBtn   = document.getElementById('nav-search-btn');
if (searchBtn) {
    searchBtn.addEventListener('click', function () {
        overlay.style.display = 'flex';
        setTimeout(function () { searchInput.focus(); }, 60);
    });
    searchBtn.addEventListener('mouseenter', function () {
        this.style.borderColor = 'rgba(0,212,255,0.45)';
        this.style.color       = 'var(--ss-cyan)';
    });
    searchBtn.addEventListener('mouseleave', function () {
        this.style.borderColor = 'rgba(255,255,255,0.12)';
        this.style.color       = 'var(--ss-text-2)';
    });
}
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') overlay.style.display = 'none';
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        overlay.style.display = 'flex';
        setTimeout(function () { searchInput.focus(); }, 60);
    }
});
overlay.addEventListener('click', function (e) {
    if (e.target === overlay) overlay.style.display = 'none';
});
if (searchInput) {
    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && searchInput.value.trim()) {
            window.location.href = '{{ route("user.books") }}?search=' + encodeURIComponent(searchInput.value.trim());
        }
    });
}

// ── Avatar dropdown ────────────────────────────────────────────
var avatarBtn      = document.getElementById('avatarBtn');
var avatarDropdown = document.getElementById('avatarDropdown');
if (avatarBtn && avatarDropdown) {
    avatarBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        var isOpen = avatarDropdown.classList.contains('open');
        avatarDropdown.classList.toggle('open', !isOpen);
        var chevron = avatarBtn.querySelector('.ss-avatar-chevron');
        if (chevron) chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
    });
    document.addEventListener('click', function () {
        avatarDropdown.classList.remove('open');
        var chevron = avatarBtn.querySelector('.ss-avatar-chevron');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
    });
    avatarDropdown.addEventListener('click', function (e) { e.stopPropagation(); });
}
</script>
{{ $scripts ?? '' }}
@include('components.book-ai-modal')
@include('components.global-fx')
</body>
</html>