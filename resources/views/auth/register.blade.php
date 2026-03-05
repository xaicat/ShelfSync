<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Diu Library Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #0a1a2e url('{{ asset('images/diuBG.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-card {
            background: rgba(8, 22, 39, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1) !important;
            border: none !important;
            color: #fff !important;
            height: 45px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px #1e90ff !important;
            background: rgba(255, 255, 255, 0.15) !important;
        }
        .label-text {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }
        .btn-register {
            background: #1e90ff;
            color: #fff;
            border-radius: 25px;
            font-weight: 600;
            padding: 12px;
            text-transform: uppercase;
            border: none;
            width: 150px;
            margin-top: 15px;
        }
        .btn-register:hover {
            background: #187bcd;
            color: #fff;
        }
        .error-text { color: #ff4d4d; font-size: 0.8rem; text-align: left; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="text-center mb-4">
            <img src="https://i.imgur.com/xnfrPes.png" width="160" alt="Logo">
            <h4 class="mt-3 font-weight-bold">Sign Up Now</h4>
            <p class="text-muted small">Please fill out this form to register</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="label-text">Username</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-control" placeholder="Your Username*">
                @error('name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="label-text">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Email*">
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="label-text">Password</label>
                        <input type="password" name="password" id="password" required class="form-control" placeholder="Password*">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="label-text">Confirm</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control" placeholder="Confirm*">
                    </div>
                </div>
            </div>
            @error('password') <div class="error-text">{{ $message }}</div> @enderror

            <div class="text-left mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="showPass" onclick="togglePass()">
                    <label class="custom-control-label small" for="showPass">Show Passwords</label>
                </div>
            </div>

            <div class="form-group">
                <label class="label-text">Address</label>
                <textarea name="address" class="form-control" rows="2" style="height: auto !important;" placeholder="Enter Your Address">{{ old('address') }}</textarea>
            </div>

            <div class="text-left mb-3 small">
                Already have an account? <a href="{{ route('login') }}" style="color: #1e90ff;">Login here</a>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-register shadow-sm">Register</button>
            </div>
        </form>
    </div>

    <script>
        function togglePass() {
            var p = document.getElementById("password");
            var c = document.getElementById("password_confirmation");
            if (p.type === "password") {
                p.type = "text"; c.type = "text";
            } else {
                p.type = "password"; c.type = "password";
            }
        }
    </script>
</body>
</html>