<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Ebook</title>
</head>
<body>
    <h2>Update eBook</h2>
    <div class="eBookSearch">
        <input type="text" placeholder="Search eBook">
        <button>Search</button>
    </div>
    
    <div class="eBookSort">
        <label for="">Sort By:</label>
        <select name="" id=""></select>
            <option value="">Created At</option>
            <option value="">Updated At</option>

        <select name="" id=""></select>
            <option value="">Ascending</option>
            <option value="">Descending</option>
    </div>

    <div>
        <label for="">Filter by Category:</label>
        <select name="" id=""></select>
            <option value="">All Categories</option>
            <option value="">General Collection</option>
            <option value="">Graduate School</option>
            <option value="">Filipiniana</option>
            <option value="">General Reference</option>
        <button>Apply Filters</button>
    </div>
    
    <div class="dataTable">
        <table border="1" cellpadding="10" cellspacing="0">
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