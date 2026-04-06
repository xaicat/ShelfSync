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
            <!-- The Premium Card -->
            @php 
                $cStatus = Auth::user()->card_status; 
                $isActive = $cStatus === 'approved';
                $isRevoked = $cStatus === 'revoked';
            @endphp
            
            <div style="display:flex;justify-content:center;margin-bottom:20px;">
                <div class="premium-id-card {{ $isActive ? 'card-active' : '' }} {{ $isRevoked ? 'card-revoked' : '' }} {{ $cStatus === 'expired' ? 'card-expired' : '' }}" id="profileCard">
                    <!-- Holographic shine overlay -->
                    <div class="card-shine"></div>
                    <!-- Background pattern -->
                    <div class="card-pattern">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="150" cy="30" r="60" fill="rgba(255,255,255,0.03)"/>
                            <circle cx="180" cy="120" r="40" fill="rgba(255,255,255,0.02)"/>
                            <circle cx="20" cy="160" r="50" fill="rgba(0,212,255,0.02)"/>
                        </svg>
                    </div>
                    <!-- Card content -->
                    <div class="card-content">
                        <div class="card-header-row">
                            <div>
                                <div class="card-brand">DIU Student</div>
                                <div class="card-sub-brand">Digital Access Card</div>
                            </div>
                            <div class="card-chip">
                                <div class="chip-line"></div>
                                <div class="chip-line"></div>
                            </div>
                        </div>
                        <div class="card-body-section">
                            <div class="card-uid">UID: {{ $card->student_id }}</div>
                            <div class="card-holder-name">{{ Auth::user()->name }}</div>
                            <div class="card-department">{{ $card->department }}</div>
                        </div>
                        <div class="card-footer-row">
                            <div>
                                <div class="card-label">Valid Thru</div>
                                <div class="card-valid-date">{{ $card->expires_at ? $card->expires_at->format('m/Y') : 'Lifetime' }}</div>
                            </div>
                            @if($isActive)
                                <span class="card-status-badge active">● ACTIVE</span>
                            @elseif($cStatus === 'expired')
                                <span class="card-status-badge expired">EXPIRED</span>
                            @elseif($isRevoked)
                                <span class="card-status-badge revoked">REVOKED</span>
                            @endif
                        </div>
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
    /* ── Premium ID Card ── */
    .premium-id-card {
        max-width: 380px; width: 100%; min-height: 230px;
        border-radius: 20px; position: relative; overflow: hidden;
        background: linear-gradient(145deg, rgba(15,15,22,0.95), rgba(8,8,14,0.98));
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04) inset;
        transition: transform 0.12s ease-out;
        cursor: default;
        perspective: 1000px;
    }
    .premium-id-card.card-active {
        border-color: rgba(0,212,255,0.15);
        box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 40px rgba(0,212,255,0.06);
        animation: cardBorderPulse 3s ease-in-out infinite alternate;
    }
    .premium-id-card.card-revoked {
        border-color: rgba(244,63,94,0.2);
        box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 20px rgba(244,63,94,0.08);
    }
    .premium-id-card.card-expired { filter: grayscale(70%) brightness(0.7); }
    @keyframes cardBorderPulse {
        0% { border-color: rgba(0,212,255,0.1); }
        100% { border-color: rgba(0,212,255,0.25); }
    }

    /* Holographic shine */
    .card-shine {
        position: absolute; inset: 0; z-index: 2; pointer-events: none;
        background: linear-gradient(
            105deg,
            transparent 30%,
            rgba(255,255,255,0.04) 42%,
            rgba(255,255,255,0.12) 48%,
            rgba(0,212,255,0.08) 50%,
            rgba(255,255,255,0.04) 52%,
            transparent 62%
        );
        background-size: 250% 100%;
        background-position: 200% 0;
        transition: background-position 0.6s ease;
    }
    .premium-id-card:hover .card-shine {
        background-position: -50% 0;
    }

    /* Pattern */
    .card-pattern {
        position: absolute; inset: 0; z-index: 0; pointer-events: none;
    }
    .card-pattern svg { width: 100%; height: 100%; }

    /* Content */
    .card-content { position: relative; z-index: 1; padding: 24px 26px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; min-height: 230px; }
    .card-header-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 22px; }
    .card-brand { font-size: 0.72rem; font-weight: 700; letter-spacing: 1.5px; color: var(--ss-cyan); text-transform: uppercase; }
    .card-sub-brand { font-size: 0.62rem; color: var(--ss-text-3); margin-top: 2px; }

    /* Chip */
    .card-chip {
        width: 36px; height: 26px; border-radius: 5px;
        background: linear-gradient(135deg, #c9a84c, #b8941f, #d4af37);
        display: flex; flex-direction: column; justify-content: center; gap: 3px; padding: 4px 5px;
        box-shadow: 0 2px 8px rgba(201,168,76,0.3);
    }
    .chip-line { height: 1.5px; background: rgba(0,0,0,0.15); border-radius: 1px; }

    .card-body-section { margin-bottom: 18px; }
    .card-uid { font-family: 'Courier New', monospace; font-size: 1rem; color: #fff; letter-spacing: 2px; margin-bottom: 6px; text-shadow: 0 0 6px rgba(255,255,255,0.1); }
    .card-holder-name { font-size: 1.2rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .card-department { font-size: 0.82rem; color: var(--ss-text-2); margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    .card-footer-row { display: flex; justify-content: space-between; align-items: flex-end; }
    .card-label { font-size: 0.55rem; color: var(--ss-text-3); text-transform: uppercase; letter-spacing: 1px; }
    .card-valid-date { font-size: 0.85rem; color: #fff; font-weight: 600; margin-top: 2px; }

    .card-status-badge {
        font-size: 0.68rem; font-weight: 700; padding: 4px 14px; border-radius: 20px;
        letter-spacing: 0.5px;
    }
    .card-status-badge.active { background: var(--ss-cyan); color: #000; box-shadow: 0 0 14px rgba(0,212,255,0.3); }
    .card-status-badge.expired { background: rgba(100,100,100,0.5); color: #aaa; }
    .card-status-badge.revoked { background: var(--ss-rose); color: #fff; box-shadow: 0 0 14px rgba(244,63,94,0.3); }

    /* Tilt states */
    .premium-id-card.is-tilting { transition: none; }
    .premium-id-card.is-resetting { transition: transform 0.55s cubic-bezier(.16,1,.3,1); }
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const card = document.getElementById('profileCard');
    if (!card) return;

    let tx = 0, ty = 0, cx = 0, cy = 0, raf = null;

    function lerp(a, b, t) { return a + (b - a) * t; }

    function tick() {
        cx = lerp(cx, tx, 0.08);
        cy = lerp(cy, ty, 0.08);
        card.style.transform = `perspective(800px) rotateY(${cx}deg) rotateX(${cy}deg)`;
        if (Math.abs(cx - tx) > 0.01 || Math.abs(cy - ty) > 0.01) {
            raf = requestAnimationFrame(tick);
        } else {
            raf = null;
        }
    }

    card.addEventListener('mouseenter', function() {
        card.classList.add('is-tilting');
        card.classList.remove('is-resetting');
    });

    card.addEventListener('mousemove', function(e) {
        const r = card.getBoundingClientRect();
        const px = (e.clientX - r.left) / r.width;
        const py = (e.clientY - r.top) / r.height;
        tx = (px - 0.5) * 18;
        ty = (0.5 - py) * 12;
        if (!raf) raf = requestAnimationFrame(tick);
    });

    card.addEventListener('mouseleave', function() {
        tx = 0; ty = 0;
        card.classList.remove('is-tilting');
        card.classList.add('is-resetting');
        if (!raf) raf = requestAnimationFrame(tick);
    });
});
</script>

</x-user-layout>