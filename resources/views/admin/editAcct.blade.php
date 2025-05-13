<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-update {
            background-color: #007bff;
            color: white;
            margin-right: 10px;
        }

        .btn-update:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        form + form {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Edit Admin Account</h2>

        <form action="{{ route('admin.accounts.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Username:</label>
            <input type="text" name="username" value="{{ $user->username }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}" required>

            <label>Password (leave blank to keep current):</label>
            <input type="password" name="password">

            <button type="submit" class="btn btn-update">Update Account</button>
        </form>

        <form action="{{ route('admin.accounts.delete', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this account?')">Delete Account</button>
        </form>
    </div>

</body>
</html>