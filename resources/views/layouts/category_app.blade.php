<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #2563eb;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #1e40af;
        }

        .list {
            list-style: none;
            padding: 0;
        }

        .list li {
            background: #f1f5f9;
            margin-bottom: 10px;
            padding: 12px;
            border-radius: 6px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            margin-top: 5px;
        }

        .alert {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        a.back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: underline;
            color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
