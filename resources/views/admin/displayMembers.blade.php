<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">

<style>
.dropdown-item:hover {
    background-color: var(--ss-surface-light) !important;
    color: #fff !important;
}
.dropdown-divider {
    margin: 0.25rem 0;
}
</style>
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
                        <div class="dropdown">
                            <button class="ss-btn dropdown-toggle" style="background:var(--ss-surface-light);color:var(--ss-text-2);border:1px solid var(--ss-border);padding:6px 14px;display:inline-flex;align-items:center;gap:8px;font-size:0.75rem;" type="button" id="dropdownMenuButton_{{ $user->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i> Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton_{{ $user->id }}" style="background:#16161d;border:1px solid var(--ss-border);box-shadow:0 10px 30px rgba(0,0,0,0.5);min-width:180px;">
                                @if($user->role === 'user')
                                    <form action="{{ route('admin.members.promote', $user->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Promote {{ addslashes($user->name) }} to Admin?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="dropdown-item py-2" style="color:var(--ss-cyan);background:transparent;outline:none;font-size:0.8rem;font-weight:600;"><i class="fas fa-arrow-up fa-fw mr-2"></i> Promote Admin</button>
                                    </form>
                                    
                                    @if(!$user->libraryCard || $user->libraryCard->status !== 'revoked')
                                        <div class="dropdown-divider" style="border-top-color:var(--ss-border);"></div>
                                        <form action="{{ route('admin.revoke.card', $user->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Revoke Library Card access for {{ addslashes($user->name) }}? This will restrict them from borrowing.')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="dropdown-item py-2" style="color:var(--ss-rose);background:transparent;outline:none;font-size:0.8rem;font-weight:600;"><i class="fas fa-ban fa-fw mr-2"></i> Revoke Card</button>
                                        </form>
                                    @else
                                        <div class="dropdown-divider" style="border-top-color:var(--ss-border);"></div>
                                        <div class="dropdown-item disabled py-2" style="color:#666;background:transparent;font-size:0.8rem;font-weight:600;"><i class="fas fa-user-slash fa-fw mr-2"></i> Card Revoked</div>
                                    @endif
                                @else
                                    <form action="{{ route('admin.members.demote', $user->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Demote {{ addslashes($user->name) }} to User?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="dropdown-item py-2" style="color:var(--ss-amber);background:transparent;outline:none;font-size:0.8rem;font-weight:600;"><i class="fas fa-arrow-down fa-fw mr-2"></i> Demote to User</button>
                                    </form>
                                @endif
                            </div>
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