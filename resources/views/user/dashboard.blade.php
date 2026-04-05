<x-user-layout>
<style>
.dash-page { padding: 46px 0 80px; }
.dash-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; margin-bottom: 36px; }
.reading-list { display: flex; flex-direction: column; gap: 14px; }
</style>

<div class="dash-page">
<div class="container">

    <!-- Header -->
    <div class="anim-fade-up" style="margin-bottom:32px;">
        <div class="ss-section-label">Student Portal</div>
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <h1 class="ss-page-title">
                    Welcome back, <span class="gradient-text">{{ explode(' ', $user->name)[0] }}</span> 👋
                </h1>
                <p class="ss-page-subtitle">Here's your reading activity at a glance</p>
            </div>
            @if(isset($totalFines) && $totalFines > 0)
            <div style="background:rgba(239, 68, 68, 0.15);border:1px solid rgba(239,68,68,0.4);border-radius:12px;padding:12px 20px;display:flex;align-items:center;gap:12px;box-shadow:0 0 15px rgba(239, 68, 68, 0.2);">
                <i class="fas fa-exclamation-triangle" style="color:var(--ss-rose);font-size:1.5rem;"></i>
                <div>
                    <div style="font-size:0.75rem;color:var(--ss-rose);text-transform:uppercase;font-weight:800;letter-spacing:1px;">Active Fine</div>
                    <div style="font-family:monospace;font-size:1.2rem;font-weight:700;color:#fff;">-{{ number_format($totalFines, 0) }} BDT</div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Stat Tiles -->
    <div class="dash-grid anim-fade-up-1">
        <div class="stat-card stat-card-cyan">
            <div class="stat-icon stat-icon-cyan"><i class="fas fa-book-reader"></i></div>
            <div class="stat-number">{{ $activeRentals->count() }}</div>
            <div class="stat-label">Active Rentals</div>
            <div class="stat-delta text-cyan">Currently checked out</div>
        </div>
        <div class="stat-card stat-card-electric">
            <div class="stat-icon stat-icon-electric"><i class="fas fa-check-double"></i></div>
            <div class="stat-number">{{ $completedBooks }}</div>
            <div class="stat-label">Books Read</div>
            <div class="stat-delta" style="color:var(--ss-electric);">All time</div>
        </div>
        <div class="stat-card stat-card-amber">
            <div class="stat-icon stat-icon-amber"><i class="fas fa-clock"></i></div>
            <div class="stat-number">{{ $pendingRentals }}</div>
            <div class="stat-label">Pending Requests</div>
            <div class="stat-delta" style="color:var(--ss-amber);">Awaiting approval</div>
        </div>
        <div class="stat-card stat-card-rose">
            <div class="stat-icon stat-icon-rose"><i class="fas fa-heart"></i></div>
            <div class="stat-number">{{ $wishlistCount }}</div>
            <div class="stat-label">Wishlist</div>
            <div class="stat-delta" style="color:var(--ss-rose);">Saved books</div>
        </div>
    </div>

    <div class="row">
        <!-- Currently Reading -->
        <div class="col-lg-7 mb-4 anim-fade-up-2">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <div class="ss-section-label">Reading Tracker</div>
                <a href="{{ route('user.books') }}" class="ss-btn ss-btn-ghost ss-btn-sm"><i class="fas fa-plus"></i> Add Book</a>
            </div>

            @if($currentlyReading->isEmpty())
            <div class="ss-card" style="padding:48px;text-align:center;">
                <div style="font-size:2.5rem;margin-bottom:14px;">📖</div>
                <p style="color:var(--ss-text-2);margin-bottom:16px;font-size:0.9rem;">You're not currently tracking any books.</p>
                <a href="{{ route('user.books') }}" class="ss-btn ss-btn-primary ss-btn-sm">Browse Books</a>
            </div>
            @else
            <div class="reading-list">
                @foreach($currentlyReading as $rp)
                <div class="reading-card">
                    <div style="display:flex;gap:14px;align-items:flex-start;margin-bottom:14px;">
                        <!-- Cover -->
                        <div style="width:46px;height:60px;border-radius:8px;overflow:hidden;flex-shrink:0;border:1px solid var(--ss-border);background:linear-gradient(135deg,rgba(37,99,235,0.15),rgba(124,58,237,0.12));display:flex;align-items:center;justify-content:center;">
                            <img src="{{ $rp->book->image ?? asset('img/no-cover.svg') }}" 
                                 onerror="this.onerror=null;this.src='{{ asset('img/no-cover.svg') }}';"
                                 style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:700;color:#fff;font-size:0.92rem;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $rp->book->name }}</div>
                            <div style="font-size:0.76rem;color:var(--ss-text-2);margin-bottom:10px;">{{ $rp->book->author ?? 'Unknown Author' }}</div>

                            <!-- Progress bar -->
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                                <div class="ss-progress-wrap" style="flex:1;">
                                    <div class="ss-progress-bar" style="width:{{ $rp->progress }}%;"></div>
                                </div>
                                <span style="font-size:0.78rem;font-weight:700;color:var(--ss-cyan);min-width:36px;text-align:right;">{{ $rp->progress }}%</span>
                            </div>

                            <!-- Actions -->
                            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                <!-- Update progress -->
                                <form action="{{ route('user.reading.progress', $rp->id) }}" method="POST" style="display:flex;gap:6px;align-items:center;" id="prog-form-{{ $rp->id }}">
                                    @csrf @method('PATCH')
                                    <input type="range" name="progress" min="0" max="100" value="{{ $rp->progress }}"
                                        style="width:90px;height:4px;accent-color:var(--ss-cyan);"
                                        oninput="document.getElementById('pv-{{ $rp->id }}').textContent=this.value+'%'"
                                        onchange="this.closest('form').submit()">
                                    <span id="pv-{{ $rp->id }}" style="font-size:0.72rem;color:var(--ss-text-3);width:34px;">{{ $rp->progress }}%</span>
                                </form>
                                <form action="{{ route('user.reading.mark_read', $rp->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Mark as completed?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="ss-btn ss-btn-success ss-btn-sm"><i class="fas fa-check"></i> Mark Read</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right Column: Active Rentals + History -->
        <div class="col-lg-5 anim-fade-up-3">
            <!-- Active Rentals -->
            <div style="margin-bottom:16px;" class="ss-section-label">Active Rentals</div>
            @if($activeRentals->isEmpty())
            <div class="ss-card" style="padding:30px;text-align:center;margin-bottom:24px;">
                <p style="color:var(--ss-text-3);font-size:0.85rem;margin:0;">No active rentals</p>
            </div>
            @else
            <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:24px;">
                @foreach($activeRentals as $rental)
                <div class="ss-card" style="padding:14px;display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:52px;border-radius:7px;overflow:hidden;flex-shrink:0;border:1px solid var(--ss-border);background:rgba(37,99,235,0.1);display:flex;align-items:center;justify-content:center;">
                        <img src="{{ isset($rental->book) && $rental->book->image ? $rental->book->image : asset('img/no-cover.svg') }}" 
                             onerror="this.onerror=null;this.src='{{ asset('img/no-cover.svg') }}';"
                             style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:600;color:#fff;font-size:0.84rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $rental->book->name ?? 'N/A' }}</div>
                        <div style="font-size:0.74rem;color:{{ \Carbon\Carbon::parse($rental->return_date)->isPast() ? 'var(--ss-rose)' : 'var(--ss-text-2)' }};">
                            Due: {{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}
                        </div>
                    </div>

                    <!-- Add to reading tracker button -->
                    @php $alreadyTracking = $currentlyReading->where('book_id', $rental->book_id)->first(); @endphp
                    @if(!$alreadyTracking && $rental->book)
                    <form action="{{ route('user.reading.add') }}" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $rental->book_id }}">
                        <button type="submit" class="ss-btn ss-btn-ghost ss-btn-sm" style="white-space:nowrap;" title="Track reading progress">
                            <i class="fas fa-book-open"></i>
                        </button>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <!-- Reading History -->
            @if($readingHistory->isNotEmpty())
            <div class="ss-section-label" style="margin-bottom:12px;">Reading History</div>
            <div style="display:flex;flex-direction:column;gap:8px;">
                @foreach($readingHistory as $hist)
                <div style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:rgba(6,214,160,0.04);border:1px solid rgba(6,214,160,0.14);border-radius:10px;">
                    <i class="fas fa-check-circle" style="color:var(--ss-electric);font-size:0.85rem;flex-shrink:0;"></i>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:0.82rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $hist->book->name }}</div>
                        @if($hist->completed_at)
                        <div style="font-size:0.72rem;color:var(--ss-text-3);">{{ $hist->completed_at->format('d M Y') }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

</div>
</div>
</x-user-layout>
