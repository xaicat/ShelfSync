<x-user-layout>

<div style="padding:50px 0 80px;">
<div class="container" style="max-width:820px;">

    <div class="anim-fade-up" style="margin-bottom:32px;">
        <div class="ss-section-label">Account</div>
        <h1 class="ss-page-title">Profile Settings</h1>
        <p class="ss-page-subtitle">Manage your account information and preferences</p>
    </div>

    @if(session('status') === 'profile-updated')
    <div class="alert alert-success anim-fade-up mb-4"><i class="fas fa-check-circle mr-2"></i> Profile updated successfully!</div>
    @endif
    @if(session('success'))
    <div class="alert alert-success anim-fade-up mb-4"><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</div>
    @endif

    @php $totalFine = Auth::user()->rentals ? Auth::user()->rentals->sum('fine_amount') : 0; @endphp
    @if($totalFine > 0)
    <div class="alert alert-danger shadow-sm border-danger anim-fade-up mb-4" style="box-shadow:0 0 15px rgba(239, 68, 68, 0.2) !important;">
        ⚠️ You have an active fine balance of -{{ $totalFine }} BDT. Please resolve this to keep your account in good standing.
    </div>
    @endif

    <!-- Digital ID Card Section -->
    <div class="ss-card anim-fade-up-1" style="padding:32px;margin-bottom:20px;">
        <div style="margin-bottom:22px;">
            <div class="ss-section-label">Membership</div>
            <h3 style="font-size:1rem;font-weight:700;color:#fff;margin:0;">Digital Library Card</h3>
        </div>

        @php $card = Auth::user()->libraryCard; @endphp
        
        @if(!$card)
            <!-- Apply for Card -->
            <div style="background:rgba(255,255,255,0.03);border:1px dashed var(--ss-border-strong);border-radius:14px;padding:30px;text-align:center;">
                <i class="fas fa-id-card" style="font-size:2.5rem;color:var(--ss-text-3);margin-bottom:14px;display:block;"></i>
                <h4 style="color:#fff;font-size:1.1rem;font-weight:700;margin-bottom:6px;">Apply for Library Access</h4>
                <p style="color:var(--ss-text-2);font-size:0.85rem;margin-bottom:20px;">You need an approved library card to rent books.</p>
                
                <form method="POST" action="{{ route('user.card.apply') }}" style="max-width:400px;margin:0 auto;text-align:left;">
                    @csrf
                    <div class="mb-3">
                        <label>Student ID Number</label>
                        <input type="text" name="student_id" required class="ss-input" placeholder="232-35-XXX">
                    </div>
                    <div class="mb-3">
                        <label>Department</label>
                        <input type="text" name="department" required class="ss-input" placeholder="SWE, CSE, ITM etc">
                    </div>
                    <button type="submit" class="ss-btn ss-btn-primary" style="width:100%;"><i class="fas fa-paper-plane"></i> Submit Application</button>
                </form>
            </div>
        @elseif($card->status === 'pending')
            <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:14px;padding:24px;text-align:center;">
                <i class="fas fa-hourglass-half" style="font-size:2rem;color:var(--ss-amber);margin-bottom:12px;display:block;"></i>
                <h4 style="color:#fff;font-size:1rem;font-weight:700;margin-bottom:4px;">Application Under Review</h4>
                <p style="color:var(--ss-amber);font-size:0.85rem;margin:0;">Your library card request is pending admin approval.</p>
            </div>
        @else
            <!-- The Card -->
            @php 
                $cStatus = Auth::user()->card_status; 
                $glowClass = $cStatus === 'approved' ? 'rgba(0,212,255,0.4)' : ($cStatus === 'revoked' ? 'rgba(244,63,94,0.4)' : 'rgba(255,255,255,0.1)');
                $borderClass = $cStatus === 'approved' ? 'var(--ss-cyan)' : ($cStatus === 'revoked' ? 'var(--ss-rose)' : 'var(--ss-border-strong)');
                $filter = $cStatus === 'expired' ? 'grayscale(100%) opacity(0.7)' : 'none';
            @endphp
            
            <div style="display:flex;justify-content:center;margin-bottom:20px;">
                <div style="max-width:350px;width:100%;min-height:220px;border-radius:18px;position:relative;background:linear-gradient(135deg,rgba(0,0,0,0.8),rgba(15,15,20,0.95));border:1px solid rgba(255,255,255,0.1);box-shadow:0 10px 30px rgba(0,0,0,0.5);overflow:hidden;" class="p-4 mx-auto id-card-glow {{ $cStatus === 'expired' ? 'card-expired' : '' }}">
                    
                    <!-- SVG Overlay Pattern -->
                    <svg style="position:absolute;top:0;right:0;width:150px;height:100%;opacity:0.05;" viewBox="0 0 100 100">
                        <circle cx="80" cy="20" r="40" fill="#fff"/>
                        <circle cx="100" cy="80" r="30" fill="#fff"/>
                    </svg>
                    
                    <!-- Header -->
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px;">
                        <div>
                            <div style="font-family:var(--ss-font-display);font-size:0.75rem;font-weight:800;letter-spacing:1px;color:var(--ss-cyan);text-transform:uppercase;">DIU Student</div>
                            <div style="font-size:0.65rem;color:var(--ss-text-3);">Digital Access Card</div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div style="margin-bottom:16px;">
                        <div style="font-family:monospace;font-size:1.1rem;color:#fff;letter-spacing:2px;margin-bottom:4px;text-shadow: 0 0 4px rgba(255,255,255,0.2);">UID: {{ $card->student_id }}</div>
                        <div style="font-size:1.25rem;font-weight:700;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;width:100%;">{{ Auth::user()->name }}</div>
                        <div style="font-size:0.85rem;color:var(--ss-text-2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;width:100%;">{{ $card->department }}</div>
                    </div>

                    <!-- Footer -->
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div class="text-truncate">
                            <div style="font-size:0.6rem;color:var(--ss-text-3);text-transform:uppercase;">Valid Thru</div>
                            <div style="font-size:0.8rem;color:#fff;font-weight:600;">
                                {{ $card->expires_at ? $card->expires_at->format('m/Y') : 'Lifetime' }}
                            </div>
                        </div>
                        
                        @if($cStatus === 'approved')
                            <span class="ss-badge" style="background:var(--ss-cyan);color:#000;border:none;font-weight:800;">ACTIVE</span>
                        @elseif($cStatus === 'expired')
                            <span class="ss-badge" style="background:#555;color:#fff;border:none;">EXPIRED</span>
                        @elseif($cStatus === 'revoked')
                            <span class="ss-badge ss-badge-danger" style="background:var(--ss-rose);color:#fff;border:none;">REVOKED</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($cStatus === 'expired' || $cStatus === 'revoked')
                <div style="text-align:center;">
                    <form method="POST" action="{{ route('user.card.renew') }}">
                        @csrf
                        <button type="submit" class="ss-btn ss-btn-primary">
                            <i class="fas fa-sync"></i> Request Renewal
                        </button>
                    </form>
                </div>
            @endif
        @endif
    </div>

    <style>
    @keyframes pulse-red {
        0% { box-shadow: 0 0 0 0 rgba(244,63,94, 0.4); border-color: rgba(244,63,94, 1); }
        70% { box-shadow: 0 0 0 15px rgba(244,63,94, 0); border-color: rgba(244,63,94, 0.5); }
        100% { box-shadow: 0 0 0 0 rgba(244,63,94, 0); border-color: rgba(244,63,94, 1); }
    }
    </style>

    <!-- Profile Card -->
    <div class="ss-card anim-fade-up-1" style="padding:32px;margin-bottom:20px;">
        <div style="display:flex;align-items:center;gap:22px;margin-bottom:28px;">
            <div class="profile-avatar-large">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-family:var(--ss-font-display);font-size:1.3rem;font-weight:800;color:#fff;margin-bottom:4px;">{{ $user->name }}</div>
                <div style="font-size:0.84rem;color:var(--ss-text-2);margin-bottom:8px;">{{ $user->email }}</div>
                <span class="{{ $user->role === 'admin' ? 'role-badge-admin' : 'role-badge-user' }}">
                    {{ $user->role === 'admin' ? '⚡ Admin' : '🎓 Student Member' }}
                </span>
            </div>
        </div>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf @method('patch')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="ss-input">
                    @error('name')<div style="color:var(--ss-rose);font-size:0.78rem;margin-top:5px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="ss-input">
                    @error('email')<div style="color:var(--ss-rose);font-size:0.78rem;margin-top:5px;">{{ $message }}</div>@enderror
                </div>
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:10px;padding:14px;margin-bottom:18px;font-size:0.82rem;color:var(--ss-amber);">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Your email is unverified.
                <form method="POST" action="{{ route('verification.send') }}" style="display:inline;margin:0;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:var(--ss-cyan);text-decoration:underline;cursor:pointer;font-size:inherit;">Resend verification email</button>
                </form>
            </div>
            @endif

            <button type="submit" class="ss-btn ss-btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </form>
    </div>

    <!-- Password Update -->
    <div class="ss-card anim-fade-up-2" style="padding:32px;margin-bottom:20px;">
        <div style="margin-bottom:22px;">
            <div class="ss-section-label">Security</div>
            <h3 style="font-size:1rem;font-weight:700;color:#fff;margin:0;">Change Password</h3>
        </div>

        <form method="post" action="{{ route('password.update') }}">
            @csrf @method('put')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Current Password</label>
                    <input type="password" name="current_password" autocomplete="current-password" class="ss-input" placeholder="••••••••">
                    @error('current_password', 'updatePassword')<div style="color:var(--ss-rose);font-size:0.78rem;margin-top:5px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label>New Password</label>
                    <input type="password" name="password" autocomplete="new-password" class="ss-input" placeholder="••••••••">
                    @error('password', 'updatePassword')<div style="color:var(--ss-rose);font-size:0.78rem;margin-top:5px;">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password" class="ss-input" placeholder="••••••••">
                </div>
            </div>

            @if(session('status') === 'password-updated')
            <div style="color:var(--ss-electric);font-size:0.82rem;margin-bottom:14px;"><i class="fas fa-check-circle mr-1"></i> Password updated.</div>
            @endif
            <button type="submit" class="ss-btn ss-btn-ghost"><i class="fas fa-lock"></i> Update Password</button>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="ss-card anim-fade-up-3" style="padding:28px;border-color:rgba(244,63,94,0.18);">
        <div style="margin-bottom:14px;">
            <div class="ss-section-label" style="color:var(--ss-rose);">Danger Zone</div>
            <h3 style="font-size:0.95rem;font-weight:700;color:#fff;margin:0 0 6px;">Delete Account</h3>
            <p style="font-size:0.82rem;color:var(--ss-text-2);margin:0;">Permanently delete your account and all associated data. This cannot be undone.</p>
        </div>
        <button type="button" class="ss-btn ss-btn-danger ss-btn-sm" data-toggle="modal" data-target="#deleteModal">
            <i class="fas fa-trash-alt"></i> Delete My Account
        </button>
    </div>
</div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background:#0f0f14;border:1px solid var(--ss-border-strong);border-radius:var(--ss-r-lg);">
            <div class="modal-header" style="border-bottom:1px solid var(--ss-border);padding:20px 24px;">
                <h5 class="modal-title" style="color:#fff;font-family:var(--ss-font-display);font-weight:700;">Confirm Account Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:var(--ss-text-2);font-size:1.4rem;">&times;</button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf @method('delete')
                <div class="modal-body" style="padding:24px;">
                    <p style="color:var(--ss-text-2);margin-bottom:16px;font-size:0.88rem;">This action is irreversible. Please enter your password to confirm.</p>
                    <label>Password</label>
                    <input type="password" name="password" required class="ss-input" placeholder="Enter your current password">
                    @error('password', 'userDeletion')<div style="color:var(--ss-rose);font-size:0.78rem;margin-top:5px;">{{ $message }}</div>@enderror
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--ss-border);padding:16px 24px;">
                    <button type="button" class="ss-btn ss-btn-ghost ss-btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="ss-btn ss-btn-danger ss-btn-sm"><i class="fas fa-trash-alt"></i> Permanently Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

</x-user-layout>