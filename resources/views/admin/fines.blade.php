<x-admin-layout>

<div style="padding:40px 0 80px;">
<div class="container" style="max-width:960px;">

    <!-- Header -->
    <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:32px;">
        <div class="anim-fade-up">
            <div class="ss-section-label">Compliance</div>
            <h1 class="ss-page-title">Fines & Appeals</h1>
            <p class="ss-page-subtitle">Manage penalty fees and review student appeal tickets.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success anim-fade-up mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger anim-fade-up mb-4">{{ session('error') }}</div>
    @endif

    <div class="ss-card anim-fade-up-1" style="overflow-x:auto;">
        <table class="ss-table w-100">
            <thead>
                <tr>
                    <th style="width:200px;">Student & Book</th>
                    <th>Fine Balance</th>
                    <th>Appeal Ticket</th>
                    <th style="min-width:280px;text-align:right;">Admin Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rentals as $rental)
                <tr>
                    <td>
                        <div style="font-weight:700;color:#fff;">{{ $rental->user->name }}</div>
                        <div style="font-size:0.8rem;color:var(--ss-text-2);margin-bottom:4px;">{{ $rental->book->name }}</div>
                        <div style="font-size:0.75rem;color:var(--ss-text-3);"><i class="fas fa-barcode"></i> RENTAL-{{ $rental->id }}</div>
                    </td>
                    <td>
                        <div style="font-family:monospace;font-size:1.2rem;font-weight:700;color:{{ $rental->fine_amount > 0 ? 'var(--ss-rose)' : 'var(--ss-text-3)' }};">
                            {{ number_format($rental->fine_amount, 0) }} BDT
                        </div>
                    </td>
                    <td>
                        @if($rental->fineAppeal && $rental->fineAppeal->status === 'pending')
                            <div style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.3);padding:10px;border-radius:8px;">
                                <div style="display:flex;align-items:center;gap:6px;margin-bottom:6px;">
                                    <span class="ss-badge ss-badge-pending" style="font-size:0.6rem;padding:2px 6px;">Pending Appeal</span>
                                </div>
                                <div style="font-size:0.8rem;color:var(--ss-text-2);max-width:200px;">
                                    "{{ $rental->fineAppeal->reason }}"
                                </div>
                                <div style="display:flex;gap:6px;margin-top:10px;">
                                    <form action="{{ route('admin.appeals.resolve', $rental->fineAppeal->id) }}" method="POST" style="margin:0;">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="resolved">
                                        <button type="submit" class="ss-btn ss-btn-success ss-btn-sm" style="padding:4px 8px;font-size:0.7rem;"><i class="fas fa-check"></i> Resolve</button>
                                    </form>
                                    <form action="{{ route('admin.appeals.resolve', $rental->fineAppeal->id) }}" method="POST" style="margin:0;">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="ss-btn ss-btn-sm ss-btn-danger" style="padding:4px 8px;font-size:0.7rem;"><i class="fas fa-times"></i> Reject</button>
                                    </form>
                                </div>
                            </div>
                        @elseif($rental->fineAppeal)
                            <span class="ss-badge" style="background:#333;color:#999;">{{ ucfirst($rental->fineAppeal->status) }}</span>
                        @else
                            <span style="color:var(--ss-text-3);font-size:0.8rem;">No active tickets</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end;">
                            <form action="{{ route('admin.fines.adjust', $rental->id) }}" method="POST" style="margin:0;display:flex;gap:6px;max-width:300px;">
                                @csrf @method('PATCH')
                                <input type="number" name="amount" required class="ss-input" placeholder="Amount" style="padding:6px;width:90px;text-align:center;">
                                <button type="submit" name="action" value="add" class="ss-btn ss-btn-primary ss-btn-sm">Add Fine</button>
                                <button type="submit" name="action" value="reduce" class="ss-btn ss-btn-danger ss-btn-sm" style="background:rgba(239,68,68,0.1);color:var(--ss-rose);border:1px solid rgba(239,68,68,0.3);">Reduce/Clear</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;padding:40px;color:var(--ss-text-3);">
                        <i class="fas fa-gavel" style="font-size:2rem;margin-bottom:10px;display:block;"></i>
                        No active fines or appeals detected.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</div>

</x-admin-layout>
