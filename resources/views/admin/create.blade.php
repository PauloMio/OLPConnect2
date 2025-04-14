<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload eBook</title>
</head>
<body>
    <div class="Adding_form">
        <h2>Upload New eBook</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('ebook.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Title"><br>
            <textarea name="description" placeholder="Description"></textarea><br>
            <input type="text" name="author" placeholder="Author"><br>
            <select name="status" required>
                <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select><br>
            
            <select name="category" required>
                <option value="">Select Category</option>
                <option value="Filipiniana">Filipiniana</option>
                <option value="Fiction">Fiction</option>
                <option value="General Reference">General Reference</option>
                <option value="Encyclopedia">Encyclopedia</option>
                <option value="Senior High School">Senior High School</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Graduate School">Graduate School</option>
            </select><br>
            
            <label for="coverage">Upload Photo Cover</label><br>
            <input type="file" name="coverage" accept="image/*"><br>
            
            <label for="pdf">Upload PDF file</label><br>
            <input type="file" name="pdf" accept="application/pdf"><br>

            <input type="text" name="edition" placeholder="Edition"><br>
            <input type="text" name="publisher" placeholder="Publisher"><br>
            <input type="number" name="copyrightyear" placeholder="Copyright Year"><br>
            <input type="text" name="location" placeholder="Location"><br>
            <button type="submit">Upload eBook</button>
        </form>
    </div>
</body>
</html>