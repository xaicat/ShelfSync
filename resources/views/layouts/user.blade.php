<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Home' }} - Diu Library Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e90ff;
            --dark-blue: #0a1a2e;
            --light-blue: #4da8da;
            --white: #fff;
            --text-color: #d3d3d3;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark-blue);
            color: var(--text-color);
            background-image: url('{{ asset('images/diuBG.jpg') }}'); /* Ensure this image is in public/images/ */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            text-align: center;
        }
        .navbar { background: linear-gradient(90deg, var(--dark-blue), #1c2f4f); box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .btn-modern { background: var(--primary-blue); color: var(--white); border-radius: 25px; transition: all 0.3s ease; border:none; padding: 10px 25px; text-transform: uppercase; }
        .btn-modern:hover { background: #187bcd; transform: translateY(-2px); color: white; }
        #back-to-top { position: fixed; bottom: 20px; right: 20px; width: 50px; height: 50px; background: var(--primary-blue); border: none; border-radius: 50%; color: var(--white); opacity: 0; transition: 0.3s; z-index: 1000; }
        #back-to-top.visible { opacity: 1; }
        body::after { content: ''; position: fixed; width: 20px; height: 20px; background: radial-gradient(circle, rgba(30, 144, 255, 0.3), transparent); border-radius: 50%; pointer-events: none; transform: translate(-50%, -50%); z-index: 9999; }
        .nav-link { font-weight: 500; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand mx-auto" href="{{ route('home') }}">
                <img src="https://i.imgur.com/xnfrPes.png" width="160" height="42" alt="Diu Library Portal">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#userNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="userNavbar">
                @auth
                    <h4 class="text-white mx-auto d-none d-lg-block" style="font-size: 1rem;">Welcome, {{ Auth::user()->name }}</h4>
                @endauth
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.books') }}">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.my_rents') }}">My Rents</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="nav-link btn btn-link py-2" type="submit" style="text-decoration: none;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <button id="back-to-top"><i class="fas fa-arrow-up"></i></button>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('mousemove', (e) => {
            const cursor = document.body.querySelector(':after');
            if(cursor) {
                cursor.style.left = `${e.clientX}px`;
                cursor.style.top = `${e.clientY}px`;
            }
        });
        window.addEventListener('scroll', () => {
            document.getElementById('back-to-top').classList.toggle('visible', window.scrollY > 300);
        });
        document.getElementById('back-to-top').addEventListener('click', () => window.scrollTo({top: 0, behavior: 'smooth'}));
    </script>
</body>
</html>