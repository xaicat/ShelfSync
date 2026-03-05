<x-user-layout>
    <div class="container-fostrap mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="hero-wrapper" style="position: relative; padding: 0 40px;">
                        <div class="product-slider overflow-hidden" style="border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.5);">
                            
                            <div class="slider-item active" style="background: linear-gradient(135deg, rgba(30, 144, 255, 0.2), rgba(10, 26, 46, 0.9)); backdrop-filter: blur(15px); padding: 50px;">
                                <div class="row align-items-center">
                                    <div class="col-md-6 text-center">
                                        <img src="https://images.unsplash.com/photo-1519163219899-21d2bb723b3e?w=600" class="img-fluid rounded-lg shadow-lg floating-img" alt="Academic Books">
                                    </div>
                                    <div class="col-md-6 slider-details text-left">
                                        <h1 class="display-4 text-white font-weight-bold">Academic Books</h1>
                                        <p class="lead text-light">Premium resources for SWE & CSE students. Rent the latest editions today!</p>
                                        <div class="rating mb-3">
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                                            <span class="text-white ml-2">(Top Rated)</span>
                                        </div>
                                        <h3 class="text-info mb-4">{{ $bookCount }} Copies Currently in Stock</h3>
                                        <div class="mb-4">
                                            <span class="badge badge-primary px-3 py-2">Software Engineering</span>
                                            <span class="badge badge-info px-3 py-2">Computer Science</span>
                                        </div>
                                        <a href="{{ route('user.books') }}" class="btn btn-modern btn-lg">Explore Library</a>
                                    </div>
                                </div>
                            </div>

                            <div class="slider-item" style="background: linear-gradient(135deg, rgba(77, 168, 218, 0.2), rgba(10, 26, 46, 0.9)); backdrop-filter: blur(15px); padding: 50px;">
                                <div class="row align-items-center">
                                    <div class="col-md-6 text-center">
                                        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600" class="img-fluid rounded-lg shadow-lg floating-img" alt="Digital Library">
                                    </div>
                                    <div class="col-md-6 slider-details text-left">
                                        <h1 class="display-4 text-white font-weight-bold">Research Papers</h1>
                                        <p class="lead text-light">Access a wide range of IEEE journals and research publications locally.</p>
                                        <div class="rating mb-3">
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star-half text-warning"></i>
                                        </div>
                                        <h3 class="text-success mb-4">New Additions Weekly</h3>
                                        <a href="{{ route('user.books') }}" class="btn btn-modern btn-lg">View Collections</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
                        <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5 pt-4">
                <div class="col-lg-5 mb-4">
                    <div class="action-card h-100">
                        <div class="card-img-container">
                            <img src="https://i.imgur.com/BQde9wf.jpeg" class="card-img-top" alt="Books List">
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-white">Books Inventory</h3>
                            <p class="text-muted">Browse through thousands of titles across all engineering departments.</p>
                            <a href="{{ route('user.books') }}" class="btn btn-outline-primary btn-rounded px-5">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-4">
                    <div class="action-card h-100">
                        <div class="card-img-container">
                            <img src="https://i.imgur.com/ayRIKNL.jpeg" class="card-img-top" alt="Contact Librarian">
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-white">Direct Support</h3>
                            <p class="text-muted">Have a specific request? Contact our librarians for personalized assistance.</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-info btn-rounded px-5">Get Help</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Hero Styling */
        .hero-wrapper { perspective: 1000px; }
        .slider-item { display: none; animation: fadeIn 0.8s ease-in-out; }
        .slider-item.active { display: block; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .floating-img {
            animation: float 6s ease-in-out infinite;
            border: 4px solid rgba(255,255,255,0.1);
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Arrow Styling */
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: rgba(30, 144, 255, 0.8);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.5rem;
            transition: 0.3s;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .slider-arrow:hover { background: var(--primary-blue); transform: translateY(-50%) scale(1.1); box-shadow: 0 0 20px var(--primary-blue); }
        .prev { left: 10px; }
        .next { right: 10px; }

        /* Action Cards */
        .action-card {
            background: rgba(10, 26, 46, 0.8);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            overflow: hidden;
            transition: 0.4s;
        }
        .action-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-blue);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .card-img-container { position: relative; height: 200px; overflow: hidden; }
        .img-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(10, 26, 46, 1));
        }
        .btn-rounded { border-radius: 30px; border-width: 2px; font-weight: 600; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let current = 0;
            const items = document.querySelectorAll('.slider-item');
            
            const showNext = () => {
                items[current].classList.remove('active');
                current = (current + 1) % items.length;
                items[current].classList.add('active');
            };

            const showPrev = () => {
                items[current].classList.remove('active');
                current = (current - 1 + items.length) % items.length;
                items[current].classList.add('active');
            };

            document.querySelector('.next').addEventListener('click', showNext);
            document.querySelector('.prev').addEventListener('click', showPrev);

            // Auto-play feature
            setInterval(showNext, 8000);
        });
    </script>
</x-user-layout>