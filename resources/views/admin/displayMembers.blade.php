<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">
    <div>
        <div class="ss-section-label">Members</div>
        <h1 class="ss-page-title">Registered Members</h1>
        <p class="ss-page-subtitle">{{ $users->count() }} registered library members</p>
    </div>
</div>

<div class="ss-card anim-fade-up-1" style="overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0;">
            <thead>
                <tr>
                    <th width="8%">#</th>
                    <th>Member</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Joined</th>
                    <th>Rentals</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:var(--ss-text-3);font-size:0.78rem;">#{{ $user->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,rgba(0,212,255,0.15),rgba(37,99,235,0.15));color:var(--ss-cyan);display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0;font-family:var(--ss-font-display);font-weight:800;border:1px solid rgba(0,212,255,0.2);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:700;color:#fff;">{{ $user->name }}</div>
                                <span class="ss-badge ss-badge-approved" style="padding:1px 8px;font-size:0.62rem;">Active Member</span>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--ss-text-2);font-size:0.84rem;">
                        <i class="fas fa-envelope" style="color:var(--ss-text-3);margin-right:6px;font-size:0.75rem;"></i>
                        {{ $user->email }}
                    </td>
                    <td style="color:var(--ss-text-2);font-size:0.82rem;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ $user->address ?? '—' }}
                    </td>
                    <td style="color:var(--ss-text-2);font-size:0.82rem;">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td>
                        @php $rcount = \App\Models\Rental::where('user_id', $user->id)->count(); @endphp
                        <span style="font-weight:700;color:{{ $rcount > 0 ? 'var(--ss-electric)' : 'var(--ss-text-3)' }};">
                            {{ $rcount }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:60px;color:var(--ss-text-3);">
                        <i class="fas fa-users" style="font-size:2rem;display:block;margin-bottom:12px;"></i>
                        No members registered yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-admin-layout>