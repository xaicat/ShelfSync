<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e90ff;
            --dark-blue: #0a1a2e;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark-blue) url('{{ asset('images/diuBG.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            background: rgba(8, 22, 39, 0.9);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1) !important;
            border: none !important;
            color: #fff !important;
            height: 48px;
        }
        .form-control:focus {
            box-shadow: 0 0 8px var(--primary-blue) !important;
            background: rgba(255, 255, 255, 0.15) !important;
        }
        .label-text {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }
        .btn-login {
            background: var(--primary-blue);
            color: #fff;
            border-radius: 25px;
            font-weight: 600;
            padding: 12px;
            text-transform: uppercase;
            border: none;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #187bcd;
            transform: translateY(-2px);
            color: #fff;
        }
        .error-text { color: #ff4d4d; font-size: 0.85rem; text-align: left; margin-top: 5px; }
        .custom-control-label { cursor: pointer; color: #d3d3d3; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <a href="/">
                <img src="{{ asset('img/shelfsync.svg') }}" width="180" alt="{{ config('app.name') }} Logo">
            </a>
            <h3 class="mt-4 font-weight-bold">User Login</h3>
        </div>

        @if (session('status'))
            <div class="alert alert-success small mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group mb-4">
                <label class="label-text">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" placeholder="Email*">
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group mb-4">
                <label class="label-text">Password</label>
                <input type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Password*">
                @error('password') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                    <label class="custom-control-label small" for="remember_me">Remember me</label>
                </div>
            </div>

            <div class="text-center mb-4 small">
                Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-blue); font-weight: 600;">Register here</a>
            </div>

            <button type="submit" class="btn btn-login btn-block shadow-sm">
                Login
            </button>
        </form>
    </div>

</body>
</html>