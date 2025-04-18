<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS file link -->
</head>
<body>
            @if(session('success'))
                <p style="color: green">{{ session('success') }}</p>
            @endif

            @if(session('failed'))
                 <p style="color: red">{{ session('failed') }}</p>
            @endif


    <div class="container">
        <h2>Login</h2>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div><br><br>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div><br><br>

            <div class="form-group">
                <button type="submit">Login</button>
            </div><br><br>

        </form>

        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>

</body>
</html>
