<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Home' }} - {{ config('app.name') }}</title>
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
            background: #f3f4f6;
            color: var(--text-color);
            /* background-image: url('{{ asset('images/diuBG.jpg') }}'); */ /* Ensure this image is in public/images/ */
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

        .nav-link { font-weight: 500; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand mx-auto" href="{{ route('home') }}">
                <img src="{{ asset('img/shelfsync.svg') }}" height="42" alt="{{ config('app.name') }}">
                <!--<img src="" width="160" height="42" alt="{{ config('app.name') }}">-->
                
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#userNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="userNavbar">
                @auth
                    <h4 class="text-white mx-auto d-none d-lg-block" style="font-size: 1rem; font-family:'Syne', sans-serif; background: linear-gradient(135deg, #fff 30%, #06d6a0 70%, #3b82f6) !important; background-clip: text !important; -webkit-background-clip: text !important;-webkit-text-fill-color: transparent !important; line-height: 1 !important; margin: 0;padding: 0;box-sizing: border-box;">User: {{ Auth::user()->name }}</h4>
                @endauth
                
                <ul class="navbar-nav ml-auto d-flex align-items-center">
                    <li class="nav-item mr-4">
                        <button id="nav-search-btn" class="nav-link bg-transparent border-0 d-flex align-items-center" aria-label="Search" style="padding: 0; box-shadow: none; outline: none; cursor: pointer;">
                            <i class="fas fa-search text-white" style="font-size: 1.1rem; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'"></i>
                        </button>
                    </li>
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