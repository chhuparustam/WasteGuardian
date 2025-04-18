<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - WasteGuardian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- same CSS as user form -->
    <style>
        .admin-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            max-width: 450px;
            margin: 50px auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .admin-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        button[type="submit"] {
            width: 100%;
            background: #2b8eff;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background: #1c6fd9;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="admin-box">
    <h2>Admin Login</h2>

    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Admin email" value="{{ old('email') }}">
            @error('email') <span style="color:red;">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Admin password">
            @error('password') <span style="color:red;">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
