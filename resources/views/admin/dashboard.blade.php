<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">
    <div>
        <div class="ss-section-label">Overview</div>
        <h1 class="ss-page-title">Control Center</h1>
        <p class="ss-page-subtitle">Welcome back, {{ Auth::user()->name }} — {{ now()->format('l, F j Y') }}</p>
    </div>
</div>

<!-- ── Stat Grid ── -->
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:18px;margin-bottom:40px;" class="anim-fade-up-1">

    <div class="stat-card stat-card-cyan">
        <div class="stat-icon stat-icon-cyan"><i class="fas fa-book"></i></div>
        <div class="stat-number">{{ $bookCount }}</div>
        <div class="stat-label">Total Books</div>
        <div class="stat-delta text-cyan">In catalog</div>
    </div>

    <div class="stat-card stat-card-electric">
        <div class="stat-icon stat-icon-electric"><i class="fas fa-check-circle"></i></div>
        <div class="stat-number">{{ $activeRentals }}</div>
        <div class="stat-label">Active Rentals</div>
        <div class="stat-delta" style="color:var(--ss-electric);">Currently out</div>
    </div>

    <div class="stat-card stat-card-amber">
        <div class="stat-icon stat-icon-amber"><i class="fas fa-clock"></i></div>
        <div class="stat-number">{{ $pendingRentals }}</div>
        <div class="stat-label">Pending Approvals</div>
        @if($pendingRentals > 0)
        <div class="stat-delta" style="color:var(--ss-amber);">
            <a href="{{ route('admin.rentals') }}" style="color:inherit;text-decoration:none;">⚠ Action required →</a>
        </div>
        @else
        <div class="stat-delta" style="color:var(--ss-electric);">All clear ✓</div>
        @endif
    </div>

    <div class="stat-card stat-card-rose">
        <div class="stat-icon stat-icon-rose"><i class="fas fa-exclamation-circle"></i></div>
        <div class="stat-number">{{ $overdueRentals }}</div>
        <div class="stat-label">Overdue Returns</div>
        <div class="stat-delta" style="color:var(--ss-rose);">Past due date</div>
    </div>

    <div class="stat-card stat-card-violet">
        <div class="stat-icon stat-icon-violet"><i class="fas fa-users"></i></div>
        <div class="stat-number">{{ $userCount }}</div>
        <div class="stat-label">Registered Members</div>
        <div class="stat-delta" style="color:#a78bfa;">Total users</div>
    </div>

    <div class="stat-card stat-card-cyan">
        <div class="stat-icon stat-icon-cyan"><i class="fas fa-tags"></i></div>
        <div class="stat-number">{{ $categoryCount }}</div>
        <div class="stat-label">Categories</div>
        <div class="stat-delta text-cyan">Book types</div>
    </div>

</div>

<!-- ── Quick Actions ── -->
<div class="anim-fade-up-2">
    <div class="ss-section-label">Quick Actions</div>
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:12px;">
        <a href="{{ route('admin.books.create') }}" class="ss-btn ss-btn-primary">
            <i class="fas fa-plus"></i> Add New Book
        </a>
        <a href="{{ route('admin.rentals') }}" class="ss-btn ss-btn-ghost">
            <i class="fas fa-exchange-alt"></i> Manage Rentals
            @if($pendingRentals > 0)
                <span style="background:rgba(245,158,11,0.2);color:var(--ss-amber);border-radius:20px;padding:0 7px;font-size:0.72rem;font-weight:700;margin-left:4px;">{{ $pendingRentals }}</span>
            @endif
        </a>
        <a href="{{ route('admin.categories') }}" class="ss-btn ss-btn-ghost">
            <i class="fas fa-tags"></i> Categories
        </a>
        <a href="{{ route('admin.members') }}" class="ss-btn ss-btn-ghost">
            <i class="fas fa-users"></i> Members
        </a>
    </div>
</div>

</x-admin-layout>