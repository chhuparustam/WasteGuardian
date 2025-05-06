<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Login Type - WasteGuardian</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/select-login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="selection-panel">
            <h2>Welcome to WasteGuardian</h2>
            <p>Choose your login type to access the platform</p>

            <div class="button-group">
                <a href="{{ route('login') }}" class="select-btn user-btn">
                    <i class="fas fa-user-circle"></i>
                    User Login
                </a>

                <a href="{{ route('driver.login') }}" class="select-btn driver-btn">
                    <i class="fas fa-truck-moving"></i>
                    Driver Login
                </a>

                <a href="{{ route('worker.login') }}" class="select-btn worker-btn">
                    <i class="fas fa-hard-hat"></i>
                    Worker Login
                </a>
            </div>
        </div>
    </div>
</body>

</html>