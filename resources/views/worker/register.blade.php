<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Registration - WasteGuardian</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/worker-register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="welcome-content">
                <i class="fas fa-leaf welcome-icon"></i>
                <h2>Welcome Back!</h2>
                <p>Already have an account? Sign in to continue your journey with WasteGuardian.</p>
                <a href="{{ asset('worker/login') }}" class="switch-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </a>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-header">
                <h2>Create Worker Account</h2>
                <p>Join our team of eco-warriors</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('worker.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-briefcase input-icon"></i>
                        <select name="specialization" required>
                            <option value="" disabled selected>Select Specialization</option>
                            <option value="office cleaning" {{ old('specialization') == 'office cleaning' ? 'selected' : '' }}>Office Cleaning</option>
                            <option value="kitchen cleaning" {{ old('specialization') == 'kitchen cleaning' ? 'selected' : '' }}>Kitchen Cleaning</option>
                            <option value="car washing" {{ old('specialization') == 'car washing' ? 'selected' : '' }}>Car Washing</option>
                            <option value="factory cleaning" {{ old('specialization') == 'factory cleaning' ? 'selected' : '' }}>Factory Cleaning</option>
                            <option value="house cleaning" {{ old('specialization') == 'house cleaning' ? 'selected' : '' }}>House Cleaning</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group file-input">
                        <i class="fas fa-image input-icon"></i>
                        <input type="file" name="profile_picture" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="fas fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <i class="fas fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <button type="submit" class="signup-btn">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
