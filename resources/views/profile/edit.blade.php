<x-user-layout>
    <style>
        .form-section h2, .form-section h4 {
            color: #fff;
            font-weight: 600;
        }
        /* Themed Input Fields for Dark Mode */
        .form-section .form-control {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .form-section .form-control:focus {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: var(--primary-blue) !important;
            box-shadow: 0 0 10px rgba(30, 144, 255, 0.3) !important;
            outline: none;
        }
        .form-section .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
        }
        /* Label Styling */
        .form-section label {
            color: #e0e0e0;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-text.text-muted {
            color: rgba(255, 255, 255, 0.5) !important;
        }
    </style>

    <div class="container-fostrap mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="form-section" style="background: rgba(8, 22, 39, 0.8); border-radius: 15px; padding: 40px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <div class="text-center mb-4">
                            <h2>User Profile</h2>
                            <p class="text-light small">Manage your account details and security</p>
                        </div>
                        
                        @if(session('status') === 'profile-updated')
                            <div class="alert alert-success mb-3" style="background: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #fff;">
                                <i class="fas fa-check-circle mr-2"></i> Profile Updated Successfully!
                            </div>
                        @endif

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="form-group text-left">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name" required placeholder="Your Username*" value="{{ old('name', Auth::user()->name) }}" class="form-control">
                                <x-input-error class="mt-2 text-danger small" :messages="$errors->get('name')" />
                            </div>

                            <div class="form-group text-left">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" required placeholder="Email*" value="{{ old('email', Auth::user()->email) }}" name="email" id="email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                <x-input-error class="mt-2 text-danger small" :messages="$errors->get('email')" />
                            </div>

                            <div class="form-group text-left">
                                <label for="address">Address</label>
                                <textarea class="form-control" rows="3" placeholder="Enter Your Address" name="address">{{ old('address', Auth::user()->address) }}</textarea>
                                <x-input-error class="mt-2 text-danger small" :messages="$errors->get('address')" />
                            </div>

                            <input type="submit" value="Update Profile" class="btn btn-modern btn-block py-3">
                        </form>

                        <hr class="my-5" style="border-top: 1px solid rgba(255,255,255,0.1);">

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            <h4 class="mb-4"><i class="fas fa-lock mr-2"></i>Change Password</h4>
                            
                            <div class="form-group text-left">
                                <label class="small">Current Password</label>
                                <input type="password" name="current_password" placeholder="Current Password" class="form-control mb-3">
                                <x-input-error class="mt-2 text-danger small" :messages="$errors->updatePassword->get('current_password')" />

                                <label class="small">New Password</label>
                                <input type="password" id="password" name="password" required placeholder="New Password*" class="form-control" 
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[!@#$%^&*]).{8,}" 
                                       title="Must contain: at least one number, one uppercase, one lowercase, one special character, and 8+ characters">
                                
                                <div class="show-password mt-2 d-flex align-items-center">
                                    <input type="checkbox" onclick="showPassword()" id="checkPass" class="mr-2"> 
                                    <label for="checkPass" class="text-white small mb-0" style="cursor: pointer;">Show Password</label>
                                </div>
                                <x-input-error class="mt-2 text-danger small" :messages="$errors->updatePassword->get('password')" />
                            </div>

                            <button type="submit" class="btn btn-secondary btn-block py-2" style="border-radius: 20px; font-weight: 600;">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPassword() {
            var x = document.getElementById("password");
            x.type = (x.type === "password") ? "text" : "password";
        }
    </script>
</x-user-layout>