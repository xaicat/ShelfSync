<x-admin-layout>

<div style="padding:40px 0 80px;">
<div class="container" style="max-width:960px;">

    <!-- Header -->
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:32px;">
        <div class="anim-fade-up">
            <div class="ss-section-label">Members</div>
            <h1 class="ss-page-title">Library Card Requests</h1>
            <p class="ss-page-subtitle">Review and manage student library access.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success anim-fade-up mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger anim-fade-up mb-4">{{ session('error') }}</div>
    @endif

    <div class="ss-card anim-fade-up-1" style="overflow:hidden;">
        <table class="ss-table">
            <thead>
                <tr>
                    <th style="width:200px;">Student</th>
                    <th>ID Number</th>
                    <th>Department</th>
                    <th>Requested</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cards as $card)
                <tr>
                    <td>
                        <div style="font-weight:700;color:#fff;">{{ $card->user->name }}</div>
                        <div style="font-size:0.8rem;color:var(--ss-text-2);">{{ $card->user->email }}</div>
                    </td>
                    <td style="font-family:monospace;color:#fff;">{{ $card->student_id }}</td>
                    <td style="color:var(--ss-text-2);">{{ $card->department }}</td>
                    <td style="color:var(--ss-text-2);">{{ $card->updated_at->diffForHumans() }}</td>
                    <td>
                        @if($card->status === 'pending')
                            <span class="ss-badge" style="background:rgba(245,158,11,0.15);color:var(--ss-amber);">Pending</span>
                        @elseif($card->status === 'approved')
                            <span class="ss-badge" style="background:rgba(0,212,255,0.15);color:var(--ss-cyan);">Approved</span>
                        @elseif($card->status === 'expired')
                            <span class="ss-badge" style="background:#333;color:#999;">Expired</span>
                        @elseif($card->status === 'revoked')
                            <span class="ss-badge" style="background:rgba(244,63,94,0.15);color:var(--ss-rose);">Revoked</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        @if($card->status === 'pending' || $card->status === 'expired' || $card->status === 'revoked')
                        <div style="display:inline-flex;gap:6px;">
                            <form action="{{ route('admin.cards.approve', $card->id) }}" method="POST" style="margin:0;">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-success ss-btn-sm" title="Approve & Issue Template">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            @if($card->status === 'pending')
                            <form action="{{ route('admin.cards.reject', $card->id) }}" method="POST" style="margin:0;">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-danger ss-btn-sm" title="Reject Request">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </form>
                            @endif
                        </div>
                        @else
                        <span style="font-size:0.8rem;color:var(--ss-text-3);">Active until {{ $card->expires_at->format('M Y') }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:var(--ss-text-3);">
                        <i class="fas fa-id-card-alt" style="font-size:2rem;margin-bottom:10px;display:block;"></i>
                        No card requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</div>

</x-admin-layout>
