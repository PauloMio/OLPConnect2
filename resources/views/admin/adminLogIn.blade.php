<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
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

        .Log_in {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .Log_in h2 {
            margin-bottom: 20px;
        }

        .Log_in input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .Log_in button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        .Log_in button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="Log_in">
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <h2>Admin Log-In</h2>
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Log-In</button>
        </form>        
    </div>
</body>
</html>
