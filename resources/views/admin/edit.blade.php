<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit ebook</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .Editting_form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .left_side, .right_side {
            display: inline-block;
            width: 45%;
            vertical-align: top;
            margin-right: 5%;
        }

        .right_side {
            margin-right: 0;
        }

        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 220px;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            padding-left: 20px;
            color: red;
        }

        p {
            color: green;
        }

        /* Responsive design for smaller screens */
        @media screen and (max-width: 768px) {
            .left_side, .right_side {
                width: 100%;
                margin-right: 0;
            }
        }

        .Editting_form .del {
            background-color: #ff0000;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .Editting_form .del:hover {
            background-color: #b30000;
        }
    </style>
</head>
<body>
    <div class="Editting_form">
        <h2>Edit eBook</h2>

        <form action="{{ route('admin.ebook.update', $ebook->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="left_side">
                <input type="text" name="title" placeholder="Title" value="{{ old('title', $ebook->title) }}"><br>
        
                <textarea name="description" placeholder="Description">{{ old('description', $ebook->description) }}</textarea><br>
        
                <input type="text" name="author" placeholder="Author" value="{{ old('author', $ebook->author) }}"><br>
        
                <select name="status" required>
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status', $ebook->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $ebook->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select><br>
        
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Filipiniana" {{ old('category', $ebook->category) == 'Filipiniana' ? 'selected' : '' }}>Filipiniana</option>
                    <option value="Fiction" {{ old('category', $ebook->category) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                    <option value="General Reference" {{ old('category', $ebook->category) == 'General Reference' ? 'selected' : '' }}>General Reference</option>
                    <option value="Encyclopedia" {{ old('category', $ebook->category) == 'Encyclopedia' ? 'selected' : '' }}>Encyclopedia</option>
                    <option value="Senior High School" {{ old('category', $ebook->category) == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                    <option value="Undergraduate" {{ old('category', $ebook->category) == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                    <option value="Graduate School" {{ old('category', $ebook->category) == 'Graduate School' ? 'selected' : '' }}>Graduate School</option>
                </select><br>
                <input type="text" name="edition" placeholder="Edition" value="{{ old('edition', $ebook->edition) }}"><br>
        
                <input type="text" name="publisher" placeholder="Publisher" value="{{ old('publisher', $ebook->publisher) }}"><br>
            </div>
        
            <div class="right_side">
                <label for="coverage">Current Cover Photo:</label><br>
                @if ($ebook->coverage)
                    <img src="{{ asset('storage/' . $ebook->coverage) }}" alt="Cover" width="100" style="margin-bottom: 10px;"><br>
                @else
                    <p>No cover uploaded.</p>
                @endif
        
                <label for="coverage">Upload New Photo Cover:</label><br>
                <input type="file" name="coverage" accept="image/*"><br>
        
                <label for="pdf">Current PDF File:</label><br>
                @if ($ebook->pdf)
                    <a href="{{ asset('storage/' . $ebook->pdf) }}" target="_blank">View Current PDF</a><br>
                @else
                    <p>No PDF uploaded.</p>
                @endif
        
                <label for="pdf">Upload New PDF file:</label><br>
                <input type="file" name="pdf" accept="application/pdf"><br>
        
                
                <input type="number" name="copyrightyear" placeholder="Copyright Year" value="{{ old('copyrightyear', $ebook->copyrightyear) }}"><br>
        
                <input type="text" name="location" placeholder="Location" value="{{ old('location', $ebook->location) }}"><br>
        
                <button type="submit">Update eBook</button>

            </form>

            <!-- Delete Button -->
            <form action="{{ route('admin.ebook.destroy', $ebook->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="del">Delete eBook</button>
            </form>
            </div>
           
        
    </div>
</body>

</html>