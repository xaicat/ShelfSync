<x-user-layout>
    <style>
        /* Themed Contact Header */
        .contact-header {
            position: relative;
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1350') no-repeat center center;
            background-size: cover;
            border-radius: 15px 15px 0 0;
            height: 220px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: none;
        }

        /* Themed Contact Form Container */
        .contact-form-card {
            background: rgba(8, 22, 39, 0.8) !important;
            border-radius: 0 0 15px 15px;
            padding: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Dark Mode Input Fields */
        .contact-form-card .form-control {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: #fff !important;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .contact-form-card .form-control:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: var(--primary-blue) !important;
            box-shadow: 0 0 10px rgba(30, 144, 255, 0.3) !important;
            outline: none;
        }

        .contact-form-card .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        /* Labels */
        .contact-form-card label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #e0e0e0 !important;
        }

        .btn-modern {
            background: var(--primary-blue);
            color: white;
            border-radius: 30px;
            font-weight: 600;
            padding: 12px 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            border: none;
        }

        .btn-modern:hover {
            background: #187bcd;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.4);
            color: white;
        }
    </style>

    <div class="container-fostrap mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <header class="contact-header">
                        <div class="overlay" style="width: 100%; height: 100%; background: linear-gradient(135deg, rgba(30, 144, 255, 0.4), rgba(10, 26, 46, 0.8)); display: flex; align-items: center; justify-content: center;">
                            <div class="text-center">
                                <h2 class="text-white" style="font-size: 2.8rem; font-weight: 700; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">Admin Contact Form</h2>
                                <p class="text-light">Have a question? We're here to help.</p>
                            </div>
                        </div>
                    </header>

                    <div class="contact-form-card">
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #fff;">
                                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label><i class="fas fa-tag mr-2"></i>Product Name / Subject</label>
                                        <input type="text" name="productName" class="form-control" required placeholder="e.g. Physics Book Query">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label><i class="fas fa-phone mr-2"></i>Contact No.</label>
                                        <input type="text" name="Number" maxlength="11" class="form-control" required placeholder="017XXXXXXXX">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label><i class="fas fa-envelope mr-2"></i>Email ID</label>
                                        <input type="email" name="Email" class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}" required placeholder="your-email@diu.edu.bd">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label><i class="fas fa-layer-group mr-2"></i>Category</label>
                                        <input type="text" name="category" class="form-control" required placeholder="e.g. Science / Engineering">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-left mt-2">
                                <label><i class="fas fa-comment-alt mr-2"></i>Description / Message</label>
                                <textarea name="Message" rows="5" class="form-control" required placeholder="Describe your query in detail..."></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-modern">
                                    <i class="fas fa-paper-plane mr-2"></i> Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>