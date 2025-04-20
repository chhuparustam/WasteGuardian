<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield('title','WasteGuardian Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-driver.css') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .admin-dash{
            display: flex;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #34495e;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #1abc9c;
        }

        .content {
            flex: 1;
            padding: 40px;
            background-color: #fff;
            box-sizing: border-box;
        }

        h2 {
            margin-top: 0;
        }

        form {
            max-width: 500px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #1abc9c;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        button:hover {
            background-color: #16a085;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .sidebar a {
                margin: 5px;
                flex: 1 1 40%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        WasteGuardian Admin Panel
    </div>
    <div class="admin-dash">

        @include('admin.sidebar')
        <div class="container">
            
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
