<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteGuardian- Driver Login</title>
    <link rel="stylesheet" href="{{ asset('css/driver-login.css') }}">
   
</head>
<body>


    <div class="container">
        <div class="right-panel">
            <h2>Driver Login</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('failed'))
                <div class="alert alert-danger">{{ session('failed') }}</div>
            @endif

            <form action="{{ route('driver.login') }}" method="POST">
                @csrf

                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <button type="submit" class="login-btn">login</button>
            </form>
        </div>
    </div>
</body>
</html>
