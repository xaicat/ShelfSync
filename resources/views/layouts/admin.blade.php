<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
</head>
<body>
<div class="admin-shell">

    <!-- ── Sidebar ── -->
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
            <div class="admin-sidebar-brand-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <span class="admin-sidebar-brand-name">ShelfSync</span>
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
        <a href="{{ route('admin.categories') }}"
           class="sidebar-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-tags"></i></span> Categories
        </a>
        <a href="{{ route('admin.members') }}"
           class="sidebar-item {{ request()->routeIs('admin.members') ? 'active' : '' }}">
            <span class="si-icon"><i class="fas fa-users"></i></span> Members
        </a>

        <div class="sidebar-section-label">Account</div>
        <a href="{{ route('profile.edit') }}" class="sidebar-item">
            <span class="si-icon"><i class="fas fa-user-cog"></i></span> Profile
        </a>
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="sidebar-item" style="width:100%;background:none;border:none;text-align:left;cursor:pointer;">
                <span class="si-icon"><i class="fas fa-sign-out-alt"></i></span> Logout
            </button>
        </form>
    </aside>

    <!-- ── Main ── -->
    <div class="admin-main">
        <!-- Top bar -->
        <div class="admin-topbar">
            <div>
                <span style="font-size:0.78rem;color:var(--ss-text-2);">
                    <i class="fas fa-shield-alt mr-1" style="color:var(--ss-cyan);"></i>
                    Logged in as <strong style="color:#fff;">{{ Auth::user()->name ?? 'Admin' }}</strong>
                </span>
            </div>
            <div style="display:flex;align-items:center;gap:14px;">
                <a href="{{ route('home') }}" class="ss-btn ss-btn-ghost ss-btn-sm" style="background:transparent;">
                    <i class="fas fa-eye"></i> View Site
                </a>
                <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--ss-cyan),var(--ss-blue));display:flex;align-items:center;justify-content:center;font-size:0.85rem;font-weight:700;color:#fff;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Content -->
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
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>