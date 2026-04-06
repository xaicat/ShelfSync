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
        <div class="stat-number" data-counter="{{ $bookCount }}">0</div>
        <div class="stat-label">Total Books</div>
        <div class="stat-delta text-cyan">In catalog</div>
    </div>

    <div class="stat-card stat-card-electric">
        <div class="stat-icon stat-icon-electric"><i class="fas fa-check-circle"></i></div>
        <div class="stat-number" data-counter="{{ $activeRentals }}">0</div>
        <div class="stat-label">Active Rentals</div>
        <div class="stat-delta" style="color:var(--ss-electric);">Currently out</div>
    </div>

    <div class="stat-card stat-card-amber">
        <div class="stat-icon stat-icon-amber"><i class="fas fa-clock"></i></div>
        <div class="stat-number" data-counter="{{ $pendingRentals }}">0</div>
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
        <div class="stat-number" data-counter="{{ $overdueRentals }}">0</div>
        <div class="stat-label">Overdue Returns</div>
        <div class="stat-delta" style="color:var(--ss-rose);">Past due date</div>
    </div>

    <div class="stat-card stat-card-violet">
        <div class="stat-icon stat-icon-violet"><i class="fas fa-users"></i></div>
        <div class="stat-number" data-counter="{{ $userCount }}">0</div>
        <div class="stat-label">Registered Members</div>
        <div class="stat-delta" style="color:#a78bfa;">Total users</div>
    </div>

    <div class="stat-card stat-card-cyan">
        <div class="stat-icon stat-icon-cyan"><i class="fas fa-tags"></i></div>
        <div class="stat-number" data-counter="{{ $categoryCount }}">0</div>
        <div class="stat-label">Categories</div>
        <div class="stat-delta text-cyan">Book types</div>
    </div>

</div>

<!-- ── Insights Row: Activity Feed + Donut Chart ── -->
<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;margin-bottom:40px;" class="anim-fade-up-2">

    <!-- Activity Feed -->
    <div class="ss-card" style="padding:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
            <div>
                <div class="ss-section-label">Live Feed</div>
                <h3 style="font-size:1rem;font-weight:600;color:#fff;margin:0;">Recent Activity</h3>
            </div>
            <a href="{{ route('admin.rentals') }}" style="font-size:0.75rem;color:var(--ss-cyan);text-decoration:none;font-weight:500;">View all →</a>
        </div>

        @forelse($recentActivity as $activity)
        <div class="activity-feed-item">
            <div class="activity-dot activity-dot-{{ $activity->approval_status }}"></div>
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:3px;">
                    <span style="font-weight:600;color:#fff;font-size:0.85rem;">{{ $activity->user->name ?? 'Unknown' }}</span>
                    <span style="font-size:0.72rem;color:var(--ss-text-3);">{{ $activity->updated_at->diffForHumans() }}</span>
                </div>
                <div style="font-size:0.78rem;color:var(--ss-text-2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    @if($activity->approval_status === 'pending')
                        Requested <strong style="color:var(--ss-text);">{{ $activity->book->name ?? 'a book' }}</strong>
                    @elseif($activity->approval_status === 'approved')
                        Renting <strong style="color:var(--ss-text);">{{ $activity->book->name ?? 'a book' }}</strong>
                    @elseif($activity->approval_status === 'returned')
                        Returned <strong style="color:var(--ss-text);">{{ $activity->book->name ?? 'a book' }}</strong>
                    @else
                        Rejected for <strong style="color:var(--ss-text);">{{ $activity->book->name ?? 'a book' }}</strong>
                    @endif
                </div>
            </div>
            <span style="font-size:0.68rem;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;padding:3px 10px;border-radius:20px;flex-shrink:0;
                @if($activity->approval_status === 'pending') background:rgba(245,158,11,0.1);color:var(--ss-amber);border:1px solid rgba(245,158,11,0.2);
                @elseif($activity->approval_status === 'approved') background:rgba(6,214,160,0.1);color:var(--ss-electric);border:1px solid rgba(6,214,160,0.2);
                @elseif($activity->approval_status === 'returned') background:rgba(0,212,255,0.1);color:var(--ss-cyan);border:1px solid rgba(0,212,255,0.2);
                @else background:rgba(244,63,94,0.1);color:var(--ss-rose);border:1px solid rgba(244,63,94,0.2);
                @endif
            ">{{ $activity->approval_status }}</span>
        </div>
        @empty
        <div style="text-align:center;padding:30px 0;color:var(--ss-text-3);font-size:0.85rem;">
            <i class="fas fa-inbox" style="font-size:1.8rem;margin-bottom:10px;display:block;opacity:0.4;"></i>
            No recent activity yet.
        </div>
        @endforelse
    </div>

    <!-- Donut Chart -->
    <div class="ss-card" style="padding:24px;display:flex;flex-direction:column;">
        <div style="margin-bottom:18px;">
            <div class="ss-section-label">Analytics</div>
            <h3 style="font-size:1rem;font-weight:600;color:#fff;margin:0;">Rental Distribution</h3>
        </div>
        <div style="flex:1;display:flex;align-items:center;justify-content:center;position:relative;">
            <canvas id="rentalDonut" width="200" height="200"></canvas>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:16px;">
            <div style="display:flex;align-items:center;gap:8px;font-size:0.75rem;color:var(--ss-text-2);">
                <span style="width:8px;height:8px;border-radius:50%;background:var(--ss-electric);"></span> Active ({{ $rentalDistribution['active'] }})
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:0.75rem;color:var(--ss-text-2);">
                <span style="width:8px;height:8px;border-radius:50%;background:var(--ss-amber);"></span> Pending ({{ $rentalDistribution['pending'] }})
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:0.75rem;color:var(--ss-text-2);">
                <span style="width:8px;height:8px;border-radius:50%;background:var(--ss-cyan);"></span> Returned ({{ $rentalDistribution['returned'] }})
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:0.75rem;color:var(--ss-text-2);">
                <span style="width:8px;height:8px;border-radius:50%;background:var(--ss-rose);"></span> Rejected ({{ $rentalDistribution['rejected'] }})
            </div>
        </div>
    </div>

</div>

<!-- ── Quick Actions ── -->
<div class="anim-fade-up-3">
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

<style>
/* Dashboard grid responsive */
@media(max-width:900px) {
    .anim-fade-up-2 > div:first-child + div { grid-column: 1 / -1; }
    .anim-fade-up-2 { grid-template-columns: 1fr !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    /* ── Animated counters ── */
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter) || 0;
        if (target === 0) return;
        const duration = 1200;
        const start = performance.now();
        function tick(now) {
            const p = Math.min((now - start) / duration, 1);
            const ease = 1 - Math.pow(1 - p, 3); // easeOutCubic
            el.textContent = Math.round(target * ease);
            if (p < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    });

    /* ── Donut Chart ── */
    const ctx = document.getElementById('rentalDonut');
    if (ctx && typeof Chart !== 'undefined') {
        const dist = @json($rentalDistribution);
        const total = dist.active + dist.pending + dist.returned + dist.rejected;
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Pending', 'Returned', 'Rejected'],
                datasets: [{
                    data: [dist.active, dist.pending, dist.returned, dist.rejected],
                    backgroundColor: [
                        'rgba(6,214,160,0.8)',
                        'rgba(245,158,11,0.8)',
                        'rgba(0,212,255,0.8)',
                        'rgba(244,63,94,0.8)'
                    ],
                    borderColor: 'transparent',
                    borderWidth: 0,
                    spacing: 3,
                    borderRadius: 6,
                }]
            },
            options: {
                cutout: '72%',
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15,15,20,0.9)',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        cornerRadius: 10,
                        padding: 12,
                        callbacks: {
                            label: function(ctx) {
                                const pct = total > 0 ? Math.round(ctx.raw / total * 100) : 0;
                                return ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>

</x-admin-layout>