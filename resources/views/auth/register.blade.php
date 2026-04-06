<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- ShelfSync Global Design System -->
    <link rel="stylesheet" href="{{ asset('css/shelfsync.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 30px 16px;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(0, 191, 255, 0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(139, 92, 246, 0.05) 0%, transparent 60%),
                var(--ss-deep);
        }

        .register-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(40px) saturate(1.8);
            -webkit-backdrop-filter: blur(40px) saturate(1.8);
            border: 1px solid var(--ss-rim-strong);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .register-logo {
            display: block;
            max-width: 160px;
            margin: 0 auto 22px;
        }

        .register-title {
            font-family: var(--ss-font-display) !important;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            color: #fff;
            margin-bottom: 4px;
        }
        .register-subtitle {
            text-align: center;
            color: var(--ss-muted);
            font-size: 0.85rem;
            margin-bottom: 26px;
        }

        textarea.form-control { height: auto !important; resize: none; }

        .btn-register {
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
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 36px var(--ss-azure-glow);
            color: #fff;
        }

        .error-text { color: var(--ss-rose); font-size: 0.82rem; margin-top: 5px; }
        .custom-control-label { color: var(--ss-text-soft) !important; cursor: pointer; font-size: 0.85rem; }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/shelfsync.svg') }}" class="register-logo" alt="{{ config('app.name') }} Logo">
            </a>
            <h1 class="register-title">Create Account</h1>
            <p class="register-subtitle">Join {{ config('app.name') }} to start borrowing books</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="form-control" placeholder="Your full name">
                @error('name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="form-control" placeholder="you@example.com">
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password" id="password" required
                            class="form-control" placeholder="••••••••">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label>Confirm</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="form-control" placeholder="••••••••">
                    </div>
                </div>
            </div>
            @error('password') <div class="error-text mb-2">{{ $message }}</div> @enderror

            <div class="text-left mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="showPass" onclick="togglePass()">
                    <label class="custom-control-label small" for="showPass">Show Passwords</label>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Address <span style="color: var(--ss-muted); font-weight: 400;">(optional)</span></label>
                <textarea name="address" class="form-control" rows="2"
                    placeholder="Enter your address">{{ old('address') }}</textarea>
            </div>

            <div class="mb-3 small" style="color: var(--ss-text-soft);">
                Already have an account?
                <a href="{{ route('login') }}" style="color: var(--ss-azure); font-weight: 600;">Sign in here</a>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus mr-2"></i> Create Account
            </button>
        </form>
    </div>

    <script>
        function togglePass() {
            var p = document.getElementById("password");
            var c = document.getElementById("password_confirmation");
            p.type = p.type === "password" ? "text" : "password";
            c.type = c.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>