<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | Library Portal</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body { background-color: #f4f7f6; height: 100vh; display: flex; align-items: center; }
        .container { width: 100%; }
        .card { border: none; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .btn-primary { background-color: #2c3e50; border: none; }
        .btn-primary:hover { background-color: #34495e; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>