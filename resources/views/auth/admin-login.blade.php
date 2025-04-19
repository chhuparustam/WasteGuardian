<!-- resources/views/admin/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - WasteGuardian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body>

    <div class="login-box">
        <h2>Admin Login</h2>

        @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="admin_email">Email</label>  
                <input type="email" name="email" id="admin_email" placeholder="Enter admin email" required>
            </div>

            <div class="form-group">
                <label for="admin_password">Password</label>
                <input type="password" name="password" id="admin_password" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>
</html>
