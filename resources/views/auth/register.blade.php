<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS file link -->
</head>
<body>
<div class="result">
                @if(session('success')) 
                    <div class="alert alert-success"> 
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('failed')) 
                    <div class="alert alert-danger"> 
                        {{ session('failed') }}
                    </div>
                @endif
            </div>

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container">
        <h2>Register</h2>
        <form action="{{ route('auth.create') }}" method="post"> 
            @csrf
            
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required placeholder="Enter your full name" value="{{ old('fullName') }}"> <!-- Corrected the old() function -->
                <span class="text-danger">@error('fullName'){{ $message }}@enderror</span> <!-- Corrected error key -->
            </div><br><br>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}"> <!-- Corrected the old() function -->
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div><br><br>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password" value="{{ old('password') }}">
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div><br><br>

            <!-- <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm your password">
            </div><br><br> -->

            <div class="form-group">
                <button type="submit">Register</button>
            </div><br><br>

        </form>

        <p>Already have an account? <a href="/login">Login here</a></p>
    </div>

</body>
</html>
