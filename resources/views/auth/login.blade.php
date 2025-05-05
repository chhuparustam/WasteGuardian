<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WasteGuardian</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="welcome-content">
                <i class="fas fa-leaf welcome-icon"></i>
                <h2>Welcome to WasteGuardian!</h2>
                <p>Together, we can make a cleaner, greener world. Join our community and take the first step towards a more sustainable future.</p>
                <a href="{{ route('register') }}" class="switch-btn">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </a>
            </div>
        </div>

        <div class="right-panel">
            <div class="login-header">
                <h2>Sign In</h2>
                <p>Welcome back! Please enter your details</p>
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

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <i class="fas fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>
        </div>
    </div>
            <script>
                        document.querySelector('.toggle-password').addEventListener('click', function() {
                    const password = document.querySelector('#password');
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                    });
            </script>
</body>
</html>
