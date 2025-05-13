<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Accounts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header strong {
            display: block;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 16px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .logout-button {
            background-color: #dc3545;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .add-button {
            margin-bottom: 20px;
        }

        .add-button button {
            background-color: #28a745;
        }

        .add-button button:hover {
            background-color: #218838;
        }

        .adminTable {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td a {
            color: white;
            text-decoration: none;
        }

        td button {
            background-color: #17a2b8;
        }

        td button:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>

    <div class="header">
        <strong>Logged in as: {{ Auth::user()->username }}</strong>

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">Log Out</button>
        </form>
    </div>

    <h2>Admin Accounts</h2>

    <div class="add-button" style="text-align: center;">
        <a href="{{ route('register') }}">
            <button type="button">Add New Admin</button>
        </a>
    </div>

    <div class="adminTable">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.accounts.edit', $user->id) }}">
                                <button type="button">Edit</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
