<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Diu Library Portal</title>
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

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark-blue);
            color: var(--text-color);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, var(--dark-blue), #1c2f4f);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 15px 0;
        }

        .navbar-brand img { margin-right: 10px; }

        .nav-link {
            color: var(--white) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover { color: var(--primary-blue) !important; }

        /* Jumbotron */
        .admin-jumbotron {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 40px;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
        }

        /* Cards */
        .card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            transition: transform 0.3s ease;
            color: var(--white);
            margin-bottom: 20px;
        }

        .card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.3); }

        .btn-modern {
            background: var(--primary-blue);
            color: var(--white);
            border-radius: 25px;
            padding: 10px 25px;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        
        .btn-modern:hover { color: #fff; background: #187bcd; }

        /* Table Styles for Sub-pages */
        .table { color: var(--text-color); }
        .table thead th { border-bottom: 2px solid var(--primary-blue); color: var(--white); }
        .table td { border-top: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="https://i.imgur.com/xnfrPes.png" width="160" height="42" alt="Diu Library Portal">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="text-decoration: none;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        {{ $slot }}
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>