<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

    @yield('content')

    <script src={{ url('js/bootstrap.bundle.min.js') }}></script>
</body>
</html>



