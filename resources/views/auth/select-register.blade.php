<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Registration Type - WasteGuardian</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/select-register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="selection-panel">
            <h2>Join WasteGuardian</h2>
            <p>Choose your registration type to become part of our community</p>

            <div class="button-group">
                <a href="{{ route('register') }}" class="select-btn user-btn">
                    <i class="fas fa-user-circle"></i>
                    Register as User
                </a>

                <a href="{{ route('worker.register') }}" class="select-btn worker-btn">
                    <i class="fas fa-hard-hat"></i>
                    Register as Worker
                </a>

                <div class="login-link">
                    <p>Already have an account? <a href="{{ route('select-login') }}">Sign In</a></p>
                </div>

                
            </div>
        </div>
    </div>
</body>

</html>