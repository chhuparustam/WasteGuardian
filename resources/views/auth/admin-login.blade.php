<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - WasteGuardian</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Login Header -->
            <div class="login-header">
                <div class="brand">
                    <i class="fas fa-leaf logo-icon"></i>
                    <h1>WasteGuardian</h1>
                </div>
                <p class="subtitle">Admin Portal Access</p>
            </div>

            <!-- Error Alert -->
            @if(session('failed'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('failed') }}</span>
                    <button type="button" class="close-alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="admin_email">Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" 
                               name="email" 
                               id="admin_email" 
                               placeholder="Enter your email"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="admin_password">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               id="admin_password" 
                               placeholder="Enter your password"
                               required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        // Password Toggle
        document.querySelector('.toggle-password').addEventListener('click', function(e) {
            e.preventDefault();
            const passwordInput = document.querySelector('#admin_password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });

        // Alert Close
        const alertClose = document.querySelector('.close-alert');
        if (alertClose) {
            alertClose.addEventListener('click', function() {
                this.closest('.alert').remove();
            });
        }
    </script>
</body>
</html>
