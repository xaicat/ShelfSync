<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">
    <div>
        <div class="ss-section-label">Rental Management</div>
        <h1 class="ss-page-title">Rentals Console</h1>
        <p class="ss-page-subtitle">Approve, return, or reject user rental requests</p>
    </div>
</div>

<!-- Status filter tabs -->
<div style="display:flex;gap:8px;margin-bottom:24px;" class="anim-fade-up-1">
    @php $currentFilter = request('status', 'all'); @endphp
    @foreach(['all' => 'All', 'pending' => 'Pending', 'approved' => 'Active', 'returned' => 'Returned', 'rejected' => 'Rejected'] as $val => $label)
    <a href="{{ route('admin.rentals', ['status' => $val]) }}"
       style="padding:7px 18px;border-radius:var(--ss-r-pill);font-size:0.78rem;font-weight:600;
              background:{{ $currentFilter === $val ? 'linear-gradient(135deg, var(--ss-cyan), var(--ss-blue))' : 'var(--ss-surface)' }};
              color:{{ $currentFilter === $val ? '#fff' : 'var(--ss-text-2)' }};
              border:1px solid {{ $currentFilter === $val ? 'transparent' : 'var(--ss-border)' }};
              text-decoration:none;transition:all 0.2s;">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="ss-card anim-fade-up-2" style="overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Qty</th>
                    <th>Type</th>
                    <th>Return Date</th>
                    <th>Requested</th>
                    <th>Status</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rentals as $rental)
                <tr>
                    <td style="color:var(--ss-text-3);font-size:0.78rem;">#{{ $rental->id }}</td>
                    <td>
                        <div style="font-weight:600;color:#fff;">{{ $rental->user->name ?? 'N/A' }}</div>
                        <div style="font-size:0.76rem;color:var(--ss-text-2);">{{ $rental->user->email ?? '' }}</div>
                    </td>
                    <td>
                        <div style="font-weight:600;color:#fff;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $rental->book->name ?? 'Deleted Book' }}
                        </div>
                        @if($rental->book && $rental->book->author)
                        <div style="font-size:0.76rem;color:var(--ss-text-2);">{{ $rental->book->author }}</div>
                        @endif
                    </td>
                    <td><span style="font-weight:700;color:var(--ss-cyan);">×{{ $rental->quantity }}</span></td>
                    <td style="font-size:0.8rem;color:var(--ss-text-2);">{{ $rental->status }}</td>
                    <td>
                        @php $rd = \Carbon\Carbon::parse($rental->return_date); @endphp
                        <span style="color:{{ $rd->isPast() && $rental->approval_status==='approved' ? 'var(--ss-rose)' : '#fff' }};font-size:0.85rem;">
                            {{ $rd->format('d M Y') }}
                        </span>
                        @if($rd->isPast() && $rental->approval_status === 'approved')
                            <div style="font-size:0.7rem;color:var(--ss-rose);">{{ $rd->diffForHumans() }}</div>
                        @endif
                    </td>
                    <td style="font-size:0.8rem;color:var(--ss-text-2);">{{ $rental->created_at->format('d M Y') }}</td>
                    <td>
                        @php $s = $rental->approval_status; @endphp
                        @if($s === 'pending')
                            <span class="ss-badge ss-badge-pending">Pending</span>
                        @elseif($s === 'approved')
                            <span class="ss-badge ss-badge-approved">Active</span>
                        @elseif($s === 'returned')
                            <span class="ss-badge ss-badge-returned">Returned</span>
                        @elseif($s === 'rejected')
                            <span class="ss-badge ss-badge-rejected">Rejected</span>
                        @endif
                    </td>
                    <td style="text-align:center;white-space:nowrap;">
                        <div style="display:inline-flex;gap:6px;">
                        @if($rental->approval_status === 'pending')
                            <form action="{{ route('admin.rentals.approve', $rental->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Approve this rental?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-success ss-btn-sm">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.rentals.reject', $rental->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Reject this rental?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-danger ss-btn-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @elseif($rental->approval_status === 'approved')
                            <form action="{{ route('admin.rentals.return', $rental->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Mark as returned? This will restock the book.')">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-primary ss-btn-sm" title="Return Book">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            <button type="button" class="ss-btn ss-btn-danger ss-btn-sm" onclick="document.getElementById('fineModal_{{ $rental->id }}').style.display='flex'" title="Add Fine">
                                <i class="fas fa-exclamation-circle"></i>
                            </button>
                        @elseif($rental->approval_status === 'returned')
                            <button type="button" class="ss-btn ss-btn-danger ss-btn-sm" onclick="document.getElementById('fineModal_{{ $rental->id }}').style.display='flex'" title="Add Fine">
                                <i class="fas fa-exclamation-circle"></i>
                            </button>
                        @else
                            <span style="color:var(--ss-text-3);font-size:0.78rem;">No action</span>
                        @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;padding:60px;color:var(--ss-text-3);">
                        <i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:12px;"></i>
                        No rental records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@foreach($rentals as $rental)
    @if(in_array($rental->approval_status, ['approved', 'returned']))
    <!-- Fine Modal -->
    <div id="fineModal_{{ $rental->id }}" class="modal" tabindex="-1" style="display:none;position:fixed;inset:0;background:rgba(10,10,11,0.9);z-index:9999;align-items:center;justify-content:center;">
        <div style="background:#16161d;padding:32px;border-radius:16px;border:1px solid rgba(239,68,68,0.4);max-width:400px;width:100%;position:relative;">
            <button onclick="document.getElementById('fineModal_{{ $rental->id }}').style.display='none'" style="position:absolute;top:12px;right:16px;background:none;border:none;color:var(--ss-text-3);font-size:1.5rem;cursor:pointer;">&times;</button>
            <h4 style="color:#fff;font-size:1.1rem;margin-bottom:8px;font-weight:700;">Apply Fine</h4>
            <p style="color:var(--ss-text-2);font-size:0.85rem;margin-bottom:20px;">Assign a penalty to <strong>{{ $rental->user->name ?? 'User' }}</strong> for this rental.</p>
            
            <form action="{{ route('admin.fines.adjust', $rental->id) }}" method="POST">
                @csrf @method('PATCH')
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <input type="number" name="amount" required class="ss-input" placeholder="Amount (e.g. 50)" style="width:100%;padding:12px;">
                </div>
                <button type="submit" class="ss-btn ss-btn-danger" style="width:100%;">Apply Fine</button>
            </form>
        </div>
    </div>
    @endif
@endforeach

@if($rentals->hasPages())
<div style="margin-top:20px;display:flex;justify-content:center;" class="anim-fade-up-3">
    {{ $rentals->links() }}
</div>
@endif

</x-admin-layout>
