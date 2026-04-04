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
                <img src="{{ isset($rental->book) && $rental->book->image ? $rental->book->image : asset('img/no-cover.svg') }}" 
                     onerror="this.onerror=null;this.src='{{ asset('img/no-cover.svg') }}';"
                     style="width:100%;height:100%;object-fit:cover;">
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
                <div style="display:flex;flex-wrap:wrap;gap:16px;font-size:0.8rem;color:var(--ss-text-2);margin-bottom:12px;">
                    <span><i class="fas fa-hashtag" style="color:var(--ss-text-3);margin-right:4px;"></i>Qty: <strong style="color:#fff;">{{ $rental->quantity }}</strong></span>
                    <span><i class="fas fa-calendar" style="color:var(--ss-text-3);margin-right:4px;"></i>Return: <strong style="color:{{ $isOverdue ? 'var(--ss-rose)' : '#fff' }};">{{ $rd->format('d M Y') }}</strong></span>
                    <span><i class="fas fa-wifi" style="color:var(--ss-text-3);margin-right:4px;"></i>{{ $rental->status }}</span>
                    <span><i class="fas fa-clock" style="color:var(--ss-text-3);margin-right:4px;"></i>Requested {{ $rental->created_at->diffForHumans() }}</span>
                </div>
                
                @if($s === 'approved')
                    <div style="display:flex;align-items:center;gap:16px;">
                        <button class="ss-btn ss-btn-sm" style="background:rgba(0,212,255,0.1);color:var(--ss-cyan);border:1px solid rgba(0,212,255,0.25);" onclick="document.getElementById('qrModal{{ $rental->id }}').style.display='flex'">
                            <i class="fas fa-qrcode"></i> Show Return QR
                        </button>
                        @if(!$isOverdue)
                            <div style="font-size:0.78rem;color:var(--ss-electric);">
                                <i class="fas fa-hourglass-half mr-1"></i> {{ $rd->diffForHumans() }} remaining
                            </div>
                        @else
                            <div style="font-size:0.78rem;color:var(--ss-rose);">
                                <i class="fas fa-exclamation-triangle mr-1"></i> {{ $rd->diffForHumans() }} — please return immediately
                            </div>
                        @endif
                    </div>
                @elseif($s === 'pending')
                    <div style="font-size:0.78rem;color:var(--ss-amber);">
                        <i class="fas fa-info-circle mr-1"></i> Awaiting admin approval
                    </div>
                @endif
            </div>
        </div>

        @if($s === 'approved')
        <!-- QR Code Modal -->
        <div id="qrModal{{ $rental->id }}" class="modal" tabindex="-1" style="display:none;position:fixed;inset:0;background:rgba(10,10,11,0.9);z-index:9999;align-items:center;justify-content:center;">
            <div style="background:#0f0f14;padding:32px;border-radius:16px;border:1px solid var(--ss-border);text-align:center;max-width:320px;width:100%;position:relative;">
                <button onclick="document.getElementById('qrModal{{ $rental->id }}').style.display='none'" style="position:absolute;top:12px;right:16px;background:none;border:none;color:var(--ss-text-3);font-size:1.5rem;cursor:pointer;">&times;</button>
                <h4 style="color:#fff;font-size:1.1rem;margin-bottom:8px;font-weight:700;">Return Code</h4>
                <p style="color:var(--ss-text-2);font-size:0.85rem;margin-bottom:24px;">Show this QR code to the librarian.</p>
                <div style="background:#fff;padding:12px;border-radius:8px;display:inline-block;margin-bottom:16px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&color=000000&bgcolor=ffffff&data=RENTAL-{{ $rental->id }}" alt="QR">
                </div>
                <div style="font-family:monospace;font-size:1.2rem;color:var(--ss-cyan);letter-spacing:1px;">RENTAL-{{ $rental->id }}</div>
            </div>
        </div>
        @endif

        @endforeach
        </div>
    @endif
</div>
</div>

</x-user-layout>