<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- ShelfSync Global Design System -->
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(0, 191, 255, 0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(139, 92, 246, 0.05) 0%, transparent 60%),
                var(--ss-deep);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(40px) saturate(1.8);
            -webkit-backdrop-filter: blur(40px) saturate(1.8);
            border: 1px solid var(--ss-rim-strong);
            border-radius: 20px;
            padding: 44px 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .login-logo {
            display: block;
            max-width: 180px;
            margin: 0 auto 28px;
        }

        .login-title {
            font-family: var(--ss-font-display) !important;
            font-size: 1.6rem;
            font-weight: 700;
            text-align: center;
            color: #fff;
            margin-bottom: 6px;
        }
        .login-subtitle {
            text-align: center;
            color: var(--ss-muted);
            font-size: 0.85rem;
            margin-bottom: 28px;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            border-radius: var(--ss-radius-btn);
            background: linear-gradient(135deg, var(--ss-azure), var(--ss-violet));
            color: #fff;
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 6px 24px var(--ss-azure-glow);
            margin-top: 8px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 36px var(--ss-azure-glow);
            color: #fff;
        }

        .error-text { color: var(--ss-rose); font-size: 0.82rem; margin-top: 5px; }
        .custom-control-label { color: var(--ss-text-soft) !important; cursor: pointer; font-size: 0.85rem; }

        .divider-text {
            display: flex; align-items: center; color: var(--ss-muted); font-size: 0.78rem; margin: 20px 0;
        }
        .divider-text::before, .divider-text::after {
            content: ''; flex: 1; height: 1px; background: var(--ss-rim); margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/shelfsync.svg') }}" class="login-logo" alt="{{ config('app.name') }} Logo">
            </a>
            <h1 class="login-title">Welcome back</h1>
            <p class="login-subtitle">Sign in to your {{ config('app.name') }} account</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success small mb-4">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger small mb-4">
                <i class="fas fa-exclamation-circle mr-1"></i> Invalid credentials. Please try again.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group mb-3">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="form-control" placeholder="you@example.com">
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group mb-4">
                <label>Password</label>
                <input type="password" name="password" required autocomplete="current-password"
                    class="form-control" placeholder="••••••••">
                @error('password') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                    <label class="custom-control-label" for="remember_me">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt mr-2"></i> Sign In
            </button>
        </form>

        <div class="divider-text">or</div>

        <div class="text-center" style="font-size: 0.85rem; color: var(--ss-text-soft);">
            Don't have an account?
            <a href="{{ route('register') }}" style="color: var(--ss-azure); font-weight: 600;">Create one here</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>