<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WasteGuardian</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="welcome-content">
                <i class="fas fa-leaf welcome-icon"></i>
                <h2>Welcome Back!</h2>
                <p>Already have an account? Sign in to continue your journey towards a sustainable future.</p>
                <a href="{{ route('login') }}" class="switch-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </a>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-header">
                <h2>Create Account</h2>
                <p>Join our community of eco-conscious individuals</p>
            </div>

            @if(session('success')) 
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('failed')) 
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('failed') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.create') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" 
                               name="fullName" 
                               placeholder="Full Name" 
                               value="{{ old('fullName') }}" 
                               required>
                    </div>
                    @error('fullName')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" 
                               name="email" 
                               placeholder="Email Address" 
                               value="{{ old('email') }}" 
                               required>
                    </div>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <input type="text" 
                               name="address" 
                               placeholder="Address" 
                               value="{{ old('address') }}" 
                               required>
                    </div>
                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               id="password"
                               placeholder="Password" 
                               required>
                        <i class="fas fa-eye-slash toggle-password"></i>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               placeholder="Confirm Password" 
                               required>
                        <i class="fas fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <button type="submit" class="signup-btn">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('select-register') }}">
                    <i class="fas fa-arrow-left"></i>
                    Back to Selection
                </a>
            </div>
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
