<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Accounts</title>
</head>
<body>
    <form method="GET" action="{{ route('admin.accounts') }}">
        <input type="text" name="search" placeholder="Search username..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
    

    <a href="{{ route('register') }}"><button type="button">Add New Admin</button></a>

    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <!-- You can add edit/delete routes here -->
                <a href="#">Edit</a> | <a href="#">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    
</body>
</html>