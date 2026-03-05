<x-user-layout>
    <style>
        .payment-form h2 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }
        /* Styling the input fields for the Dark Theme */
        .payment-form .form-control {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border-radius: 8px;
            padding: 12px;
        }
        .payment-form .form-control:focus {
            background: rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 0 8px var(--primary-blue) !important;
            outline: none;
        }
        .payment-form .form-control::placeholder {
            color: #bbb !important;
        }
        /* Fix for the Date Picker icon color in some browsers */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
        /* Read-only and Select specific styling */
        .payment-form .form-control[readonly], 
        .payment-form select.form-control {
            background: rgba(0, 0, 0, 0.3) !important;
            color: var(--light-blue) !important;
        }
        .payment-form select option {
            background: var(--dark-blue);
            color: #fff;
        }
    </style>

    <div class="container-fostrap mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="payment-form" style="background: rgba(8, 22, 39, 0.8); border-radius: 15px; padding: 30px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <h2>Rental Information</h2>
                        <p class="body-text text-center text-light mb-4">Confirming rental for: <strong class="text-white">{{ $book->name }}</strong></p>
                        
                        <form action="{{ route('user.rent.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="text-white small">First Name*</label>
                                    <input type="text" name="first-name" placeholder="First Name*" value="{{ Auth::user()->name }}" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-white small">Surname*</label>
                                    <input type="text" name="last-name" placeholder="Surname*" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-white small">Student ID*</label>
                                <input type="text" name="student_number" placeholder="Enter Student ID*" required class="form-control">
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="text-white small">Return Date*</label>
                                    <input type="date" name="return_date" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="text-white small">Quantity*</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $book->quantity }}" required class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="card-wrapper mb-3" style="background: rgba(255, 255, 255, 0.05); border-radius: 10px; padding: 20px; height: 180px; border: 1px dashed rgba(255,255,255,0.2);"></div>
                            </div>

                            <div class="form-group">
                                <label class="text-white small">Selected Book</label>
                                <input type="text" readonly value="{{ $book->name }}" class="form-control">
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="text-white small">Request Type</label>
                                    <select name="status" class="form-control">
                                        <option value="Online">Online Request</option>
                                        <option value="Offline">Offline Pickup</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-white small">Book Reference</label>
                                    <input type="text" readonly value="ID: {{ $book->id }}" class="form-control">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-modern btn-block mt-4 py-3">Confirm Rental</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-card/2.2.0/jquery.card.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').card({
                container: '.card-wrapper',
                width: 280,
                formSelectors: {
                    nameInput: 'input[name="first-name"], input[name="last-name"]',
                    numberInput: 'input[name="student_number"]',
                    expiryInput: 'input[name="return_date"]'
                },
                // Custom colors for the JS Card to match theme
                formatting: true,
                debug: false
            });
        });
    </script>
</x-user-layout>