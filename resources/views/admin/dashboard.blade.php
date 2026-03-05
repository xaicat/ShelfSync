<x-admin-layout>
    <style>
        /* Modern Hero Section */
        .admin-hero {
            background: linear-gradient(135deg, rgba(30, 144, 255, 0.15), rgba(10, 26, 46, 0.8));
            border-radius: 20px;
            padding: 50px 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease-out;
        }

        .admin-hero h1 {
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, var(--primary-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Statistic Tiles */
        .stat-tile {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: 0.3s;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        /* Management Cards */
        .mgmt-card {
            background: rgba(8, 22, 39, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 35px 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .mgmt-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary-blue);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.5);
            background: rgba(12, 30, 54, 0.9);
        }

        .mgmt-card i {
            transition: 0.4s;
            margin-bottom: 20px;
        }

        .mgmt-card:hover i {
            transform: scale(1.2) rotate(-10deg);
        }

        .btn-modern-admin {
            background: var(--primary-blue);
            color: white;
            border-radius: 30px;
            padding: 10px 30px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            border: none;
            transition: 0.3s;
        }

        .btn-modern-admin:hover {
            background: #fff;
            color: var(--dark-blue);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="admin-hero text-center">
                <h1 class="display-4">System Overview</h1>
                <p class="lead text-light opacity-75">Welcome back, <strong>{{ Auth::user()->name }}</strong>. You have full control over the library ecosystem.</p>
                <div class="d-flex justify-content-center mt-3">
                    <span class="badge badge-pill badge-primary px-4 py-2">Administrator Mode</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-tile">
                <div class="stat-icon bg-primary-soft text-primary" style="background: rgba(30, 144, 255, 0.1);">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-white font-weight-bold">Inventory</h5>
                    <small class="text-muted">Books Managed</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-tile">
                <div class="stat-icon text-success" style="background: rgba(40, 167, 69, 0.1);">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-white font-weight-bold">Rentals</h5>
                    <small class="text-muted">Active Loans</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-tile">
                <div class="stat-icon text-info" style="background: rgba(23, 162, 184, 0.1);">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-white font-weight-bold">Members</h5>
                    <small class="text-muted">Verified Students</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="mgmt-card text-center">
                <div class="mb-4">
                    <i class="fas fa-layer-group fa-4x text-primary"></i>
                </div>
                <h4 class="text-white font-weight-bold">Categories</h4>
                <p class="text-muted small mb-4">Organize your library collections by departments, genres, or academic years.</p>
                <a href="{{ route('admin.categories') }}" class="btn btn-modern-admin">Manage Section</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="mgmt-card text-center">
                <div class="mb-4">
                    <i class="fas fa-book-open fa-4x text-success"></i>
                </div>
                <h4 class="text-white font-weight-bold">Books Inventory</h4>
                <p class="text-muted small mb-4">Add new arrivals, update stock quantities, and manage book details/previews.</p>
                <a href="{{ route('admin.books') }}" class="btn btn-modern-admin">Manage Stock</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="mgmt-card text-center">
                <div class="mb-4">
                    <i class="fas fa-users-cog fa-4x text-info"></i>
                </div>
                <h4 class="text-white font-weight-bold">Member Control</h4>
                <p class="text-muted small mb-4">Monitor student registrations, view residential addresses, and track member IDs.</p>
                <a href="{{ route('admin.members') }}" class="btn btn-modern-admin">Manage Members</a>
            </div>
        </div>
    </div>

</x-admin-layout>