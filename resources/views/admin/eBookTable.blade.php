<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Ebook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar styles */
        .sidebar {
            width: 220px;
            background-color: #f0f0f0;
            border-right: 1px solid #ddd;
            height: 100vh;
            overflow-y: auto;
            padding: 20px 10px;
            box-sizing: border-box;
        }

        /* Main content container */
        .main-content {
            flex-grow: 1;
            padding: 20px 40px;
            overflow-y: auto;
            background-color: #f8f9fa;
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

    {{-- Sidebar --}}
    <div class="sidebar">
        @include('tab.AdminSidebar')
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <h2>Update eBook</h2>

        <form method="GET" action="{{ route('admin.ebook.list') }}">
            <div class="eBookSearch">
                <input type="text" name="search" placeholder="Search Title..." value="{{ request('search') }}">
                
                <button type="submit">Search</button>

                <label for="sortField">Sort By:</label>
                <select name="sortField" id="sortField">
                    <option value="created_at" {{ request('sortField') == 'created_at' ? 'selected' : '' }}>Created At</option>
                    <option value="updated_at" {{ request('sortField') == 'updated_at' ? 'selected' : '' }}>Updated At</option>
                </select>
        
                <select name="sortOrder" id="sortOrder">
                    <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
        
            <div class="eBookFilter">
                <label for="category">Filter by Category:</label>
                <select name="category" id="category">
                    <option value="">Select Category</option>
                    @foreach(['Filipiniana', 'Fiction', 'General Reference', 'Encyclopedia', 'Senior High School', 'Undergraduate', 'Graduate School'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <button type="submit">Apply Filters</button>
            </div>
        </form>    
        
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
    </div>

</body>
</html>
