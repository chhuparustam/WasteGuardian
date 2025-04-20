<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WasteGuardian</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h2>Welcome Back!</h2>
            <p>Let’s take a step toward a cleaner, greener tomorrow log in to continue</p>
            <a href="{{ route('login') }}">
                <button class="switch-btn">SIGN IN</button>
            </a>
        </div>

        <div class="right-panel">
            <h2>Create Account</h2>

            @if(session('success')) 
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('failed')) 
                <div class="alert alert-danger">{{ session('failed') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.create') }}" method="POST">
                @csrf

                <input type="text" name="fullName" placeholder="Full Name" value="{{ old('fullName') }}" required>
                <span class="text-danger">@error('fullName'){{ $message }}@enderror</span>

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>

                <input type="text" name="address" placeholder="Address" value="{{ old('address') }}" required>
                <span class="text-danger">@error('address'){{ $message }}@enderror</span>

                <input type="password" name="password" placeholder="Password" required>
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>

                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit" class="signup-btn">SIGN UP</button>
            </form>
        </div>
    </div>
</body>
</html>
