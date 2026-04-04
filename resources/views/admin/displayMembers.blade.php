<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">
    <div>
        <div class="ss-section-label">Members</div>
        <h1 class="ss-page-title">User Management</h1>
        <p class="ss-page-subtitle">{{ $users->count() }} members — manage roles and permissions</p>
    </div>
</div>

<div class="ss-card anim-fade-up-1" style="overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Member</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Joined</th>
                    <th>Rentals</th>
                    <th>Role</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:var(--ss-text-3);font-size:0.78rem;">#{{ $user->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,rgba(0,212,255,0.12),rgba(37,99,235,0.10));color:var(--ss-cyan);display:flex;align-items:center;justify-content:center;font-family:var(--ss-font-display);font-weight:800;font-size:0.9rem;flex-shrink:0;border:1px solid rgba(0,212,255,0.18);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:700;color:#fff;font-size:0.88rem;">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--ss-text-2);font-size:0.82rem;">{{ $user->email }}</td>
                    <td style="color:var(--ss-text-2);font-size:0.82rem;max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ $user->address ?? '—' }}
                    </td>
                    <td style="color:var(--ss-text-2);font-size:0.82rem;">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        @php $rc = \App\Models\Rental::where('user_id', $user->id)->count(); @endphp
                        <span style="font-weight:700;color:{{ $rc > 0 ? 'var(--ss-electric)' : 'var(--ss-text-3)' }};">{{ $rc }}</span>
                    </td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="role-badge-admin">Admin</span>
                        @else
                            <span class="role-badge-user">User</span>
                        @endif
                    </td>
                    <td style="text-align:center;white-space:nowrap;">
                        <div style="display:inline-flex;gap:6px;">
                        @if($user->role === 'user')
                            <form action="{{ route('admin.members.promote', $user->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Promote {{ addslashes($user->name) }} to Admin?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-success ss-btn-sm" title="Promote to Admin">
                                    <i class="fas fa-arrow-up"></i> Promote
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.members.demote', $user->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Demote {{ addslashes($user->name) }} to User?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="ss-btn ss-btn-warn ss-btn-sm" title="Demote to User">
                                    <i class="fas fa-arrow-down"></i> Demote
                                </button>
                            </form>
                        @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:60px;color:var(--ss-text-3);">
                        <i class="fas fa-users" style="font-size:2rem;display:block;margin-bottom:12px;"></i>
                        No other members found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-admin-layout>