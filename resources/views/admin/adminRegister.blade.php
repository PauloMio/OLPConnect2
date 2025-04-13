<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .Register {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .Register h2 {
            margin-bottom: 20px;
        }

        .Register input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .Register button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .Register button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="Register">
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <h2>Admin Registration</h2>
            <input type="text" name="username" placeholder="Username...">
            <input type="text" name="email" placeholder="Email...">
            <input type="password" name="password" placeholder="Password...">
            <button type="submit">Save User</button>
        </form>        
    </div>
</body>
</html>