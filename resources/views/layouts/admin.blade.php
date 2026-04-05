<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Control Panel' }} — {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/fivicon.svg') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
</head>
<body>
<div class="admin-shell">

    {{-- ════════════════════════════════════════════
         SIDEBAR — unchanged, left alone
    ════════════════════════════════════════════ --}}
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
            <img src="{{ asset('img/shelfsync.svg') }}" height="28" alt="ShelfSync"
                 style="filter:drop-shadow(0 0 6px rgba(0,212,255,0.3));">
        </a>

        <div class="sidebar-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-tachometer-alt"></i></span> Dashboard
        </a>
        <a href="{{ route('admin.books') }}"
           class="sidebar-item {{ request()->routeIs('admin.books*') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-book"></i></span> Books
        </a>
        <a href="{{ route('admin.rentals') }}"
           class="sidebar-item {{ request()->routeIs('admin.rentals*') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-exchange-alt"></i></span> Rentals
            @php $pending = \App\Models\Rental::where('approval_status','pending')->count(); @endphp
            @if($pending > 0)
                <span class="sidebar-badge">{{ $pending }}</span>
            @endif
        </a>
        <a href="{{ route('admin.returns.scan') }}"
           class="sidebar-item {{ request()->routeIs('admin.returns*') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-barcode"></i></span> Quick Return
        </a>
        <a href="{{ route('admin.categories') }}"
           class="sidebar-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-tags"></i></span> Categories
        </a>
        <a href="{{ route('admin.members') }}"
           class="sidebar-item {{ request()->routeIs('admin.members') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-users"></i></span> Members
        </a>
        
        <a href="{{ route('admin.cards') }}"
           class="sidebar-item {{ request()->routeIs('admin.cards') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-id-badge"></i></span> Card Requests
            @php $pendingCount = \App\Models\LibraryCard::where('status', 'pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="sidebar-badge">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.fines') }}"
           class="sidebar-item {{ request()->routeIs('admin.fines') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-gavel"></i></span> Fines & Appeals
            @php 
                $pendingAppeals = \App\Models\FineAppeal::where('status', 'pending')->count(); 
            @endphp
            @if($pendingAppeals > 0)
                <span class="sidebar-badge" style="background:var(--ss-rose);">{{ $pendingAppeals }}</span>
            @endif
        </a>

        <div class="sidebar-section-label">Account</div>
        <a href="{{ route('profile.edit') }}" class="sidebar-item">
            <span class="si-icon"><i class="fas fa-user-cog"></i></span> Profile
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="sidebar-item"
                    style="width:100%;background:none;border:none;text-align:left;cursor:pointer;">
                <span class="si-icon"><i class="fas fa-sign-out-alt"></i></span> Logout
            </button>
        </form>
    </aside>

    {{-- ════════════════════════════════════════════
         MAIN AREA
    ════════════════════════════════════════════ --}}
    <div class="admin-main">

        {{-- ── FLOATING PILL TOPBAR ─────────────────
             Matches the user navbar pill aesthetic.
             Positioned sticky inside admin-main so
             it floats as-you-scroll within the panel.
        ─────────────────────────────────────────── --}}
        <div class="admin-topbar-pill">

            {{-- Left: breadcrumb / current section hint --}}
            <div style="display:flex;align-items:center;gap:12px;">
                <span style="font-size:0.76rem;color:var(--ss-text-3);letter-spacing:0.05em;text-transform:uppercase;font-weight:600;">
                    <i class="fas fa-shield-alt" style="color:var(--ss-cyan);margin-right:6px;"></i>Control Panel
                </span>
                <div style="width:1px;height:16px;background:rgba(255,255,255,0.1);"></div>
                <span style="font-size:0.78rem;color:var(--ss-text-2);">
                    Logged in as <strong style="color:#fff;">{{ Auth::user()->name ?? 'Admin' }}</strong>
                </span>
            </div>

            {{-- Right: actions + avatar --}}
            <div style="display:flex;align-items:center;gap:10px;">
                @php $pending = \App\Models\Rental::where('approval_status','pending')->count(); @endphp
                @if($pending > 0)
                <a href="{{ route('admin.rentals', ['status'=>'pending']) }}"
                   class="ss-btn ss-btn-sm"
                   style="background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.28);
                          color:var(--ss-amber);border-radius:var(--ss-r-pill);padding:5px 14px;
                          font-size:0.72rem;font-weight:700;text-decoration:none;">
                    <i class="fas fa-bell"></i> {{ $pending }} Pending
                </a>
                @endif

                <a href="{{ route('home') }}"
                   style="display:flex;align-items:center;gap:6px;font-size:0.78rem;
                          color:var(--ss-text-2);text-decoration:none;padding:6px 12px;
                          border-radius:var(--ss-r-pill);border:1px solid rgba(255,255,255,0.1);
                          transition:color 0.2s,border-color 0.2s;"
                   onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.2)'"
                   onmouseout="this.style.color='var(--ss-text-2)';this.style.borderColor='rgba(255,255,255,0.1)'">
                    <i class="fas fa-external-link-alt" style="font-size:0.7rem;"></i> View Site
                </a>

                {{-- Avatar with initial --}}
                <div style="width:34px;height:34px;border-radius:50%;flex-shrink:0;
                            background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));
                            display:flex;align-items:center;justify-content:center;
                            font-family:var(--ss-font-display);font-size:0.85rem;
                            font-weight:800;color:#fff;
                            box-shadow:0 0 0 2px rgba(0,212,255,0.22);"
                     title="{{ Auth::user()->name ?? 'Admin' }}">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>

        </div>{{-- /admin-topbar-pill --}}


        {{-- ── Page Content ──────────────────────── --}}
        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mb-4" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            {{ $slot }}
        </div>

    </div>{{-- /admin-main --}}

</div>{{-- /admin-shell --}}

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
@include('components.global-fx')
</body>
</html>