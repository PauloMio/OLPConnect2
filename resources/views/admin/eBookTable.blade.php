<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Ebook</title>
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

        .eBookSearch, .eBookSort, .eBookFilter {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        input[type="text"], select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
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

        .dataTable {
            margin-top: 30px;
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

        a button {
            background-color: #28a745;
        }

        a button:hover {
            background-color: #218838;
        }

        td a {
            color: #007bff;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    @if($user)
        <div style="text-align: center; margin-bottom: 20px;">
            <strong>Logged in as:</strong> {{ $user->username }} ({{ $user->email }})

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="margin-left: 20px; background-color: #dc3545;">Log Out</button>
            </form>
        </div>
    @endif




    <h2>Update eBook</h2>

    <div class="eBookSearch">
        <input type="text" placeholder="Search eBook">
        <button>Search</button>
    </div>

    <div class="eBookSort">
        <label for="sortField">Sort By:</label>
        <select name="sortField" id="sortField">
            <option value="created_at">Created At</option>
            <option value="updated_at">Updated At</option>
        </select>

        <select name="sortOrder" id="sortOrder">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </div>

    <div class="eBookFilter">
        <label for="category">Filter by Category:</label>
        <select name="category" id="category">
            <option value="">Select Category</option>
                <option value="Filipiniana">Filipiniana</option>
                <option value="Fiction">Fiction</option>
                <option value="General Reference">General Reference</option>
                <option value="Encyclopedia">Encyclopedia</option>
                <option value="Senior High School">Senior High School</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Graduate School">Graduate School</option>
        </select>
        <button>Apply Filters</button>
    </div>

    <div class="dataTable">
        <a href="{{ route('admin.create') }}">
            <button type="button">Add New eBook</button>
        </a>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ebooks as $ebook)
                <tr>
                    <td>{{ $ebook->title }}</td>
                    <td>{{ $ebook->author }}</td>
                    <td>{{ $ebook->category }}</td>
                    <td>
                        <a href="{{ route('admin.ebook.edit', $ebook->id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
