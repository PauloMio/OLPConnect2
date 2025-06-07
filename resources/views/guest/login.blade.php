<!DOCTYPE html>
<html>
<head>
    <title>Guest Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px 40px;
            width: 100%;
            max-width: 500px;
        }

        .login-card h1 {
            margin-bottom: 20px;
            font-size: 28px;
            text-align: center;
            color: #333;
        }

        .login-card label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .login-card input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .login-card button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>Guest Login</h1>

        <form action="{{ route('guest.login.submit') }}" method="POST">
            @csrf

            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="school">School:</label>
            <input type="text" name="school">

            <label for="id_num">ID Number:</label>
            <input type="text" name="id_num">

            <label for="course">Course:</label>
            <input type="text" name="course">

            <label for="purpose">Purpose:</label>
            <input type="text" name="purpose" required>

            <button type="submit">Login as Guest</button>
        </form>
    </div>

</body>
</html>