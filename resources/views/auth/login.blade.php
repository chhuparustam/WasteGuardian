<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WasteGuardian</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h2>Welcome !</h2>
            <p>Together, we can make a cleaner, greener world. Please enter your details to join our WasteGuardian community and take the first step towards a more sustainable future</p>
            <a href="{{ route('register') }}">
                <button class="switch-btn">SIGN UP</button>
            </a>
        </div>

        <div class="right-panel">
            <h2>Sign In</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('failed'))
                <div class="alert alert-danger">{{ session('failed') }}</div>
            @endif

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf

                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <button type="submit" class="login-btn">SIGN IN</button>
            </form>
        </div>
    </div>
</body>
</html>
