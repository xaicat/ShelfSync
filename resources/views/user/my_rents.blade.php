<x-user-layout>

<div style="padding:50px 0 80px;">
<div class="container" style="max-width:700px;">

    <div class="anim-fade-up" style="margin-bottom:28px;">
        <div class="ss-section-label">Borrowing</div>
        <h1 class="ss-page-title">My Rentals</h1>
        <p class="ss-page-subtitle">Track the status of your library rental requests</p>
    </div>

    @if($rentals->isEmpty())
        <div class="ss-card anim-fade-up-1" style="padding:60px;text-align:center;">
            <div style="font-size:3rem;margin-bottom:16px;">📚</div>
            <p style="color:var(--ss-text-2);margin-bottom:20px;">You haven't rented any books yet.</p>
            <a href="{{ route('user.books') }}" class="ss-btn ss-btn-primary"><i class="fas fa-book-open"></i> Browse Books</a>
        </div>
    @else
        <div style="display:flex;flex-direction:column;gap:14px;">
        @foreach($rentals as $rental)
        @php
            $s = $rental->approval_status;
            $rd = \Carbon\Carbon::parse($rental->return_date);
            $isOverdue = ($s === 'approved') && $rd->isPast();
            if ($isOverdue)       $badgeClass = 'ss-badge-overdue';
            elseif ($s === 'pending')  $badgeClass = 'ss-badge-pending';
            elseif ($s === 'approved') $badgeClass = 'ss-badge-approved';
            elseif ($s === 'returned') $badgeClass = 'ss-badge-returned';
            else                  $badgeClass = 'ss-badge-rejected';
        @endphp
        <div class="ss-card anim-fade-up-1" style="padding:22px;display:flex;gap:18px;align-items:flex-start;">
            <!-- Cover thumbnail -->
            <div style="width:52px;height:70px;border-radius:8px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,rgba(37,99,235,0.2),rgba(124,58,237,0.15));display:flex;align-items:center;justify-content:center;border:1px solid var(--ss-border);">
                @if($rental->book && $rental->book->image)
                    <img src="{{ asset('products/'.$rental->book->image) }}" style="width:100%;height:100%;object-fit:cover;">
                @else
                    <i class="fas fa-book" style="color:var(--ss-text-3);font-size:1.1rem;"></i>
                @endif
            </div>
            <!-- Details -->
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                    <div>
                        <div style="font-family:var(--ss-font-display);font-weight:700;color:#fff;font-size:0.95rem;margin-bottom:3px;">
                            {{ $rental->book->name ?? 'Deleted Book' }}
                        </div>
                        @if($rental->book && $rental->book->author)
                        <div style="font-size:0.78rem;color:var(--ss-text-2);margin-bottom:8px;">{{ $rental->book->author }}</div>
                        @endif
                    </div>
                    <span class="ss-badge {{ $badgeClass }}">
                        @if($isOverdue) ⚠ Overdue
                        @elseif($s === 'pending') ⏳ Pending
                        @elseif($s === 'approved') ✅ Active
                        @elseif($s === 'returned') 📦 Returned
                        @else ✕ Rejected @endif
                    </span>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:16px;font-size:0.8rem;color:var(--ss-text-2);">
                    <span><i class="fas fa-hashtag" style="color:var(--ss-text-3);margin-right:4px;"></i>Qty: <strong style="color:#fff;">{{ $rental->quantity }}</strong></span>
                    <span><i class="fas fa-calendar" style="color:var(--ss-text-3);margin-right:4px;"></i>Return: <strong style="color:{{ $isOverdue ? 'var(--ss-rose)' : '#fff' }};">{{ $rd->format('d M Y') }}</strong></span>
                    <span><i class="fas fa-wifi" style="color:var(--ss-text-3);margin-right:4px;"></i>{{ $rental->status }}</span>
                    <span><i class="fas fa-clock" style="color:var(--ss-text-3);margin-right:4px;"></i>Requested {{ $rental->created_at->diffForHumans() }}</span>
                </div>
                @if($s === 'approved' && !$isOverdue)
                    <div style="margin-top:8px;font-size:0.78rem;color:var(--ss-electric);">
                        <i class="fas fa-hourglass-half mr-1"></i> {{ $rd->diffForHumans() }} remaining
                    </div>
                @elseif($isOverdue)
                    <div style="margin-top:8px;font-size:0.78rem;color:var(--ss-rose);">
                        <i class="fas fa-exclamation-triangle mr-1"></i> {{ $rd->diffForHumans() }} — please return immediately
                    </div>
                @elseif($s === 'pending')
                    <div style="margin-top:8px;font-size:0.78rem;color:var(--ss-amber);">
                        <i class="fas fa-info-circle mr-1"></i> Awaiting admin approval
                    </div>
                @endif
            </div>
        </div>
        @endforeach
        </div>
    @endif
</div>
</div>

</x-user-layout>