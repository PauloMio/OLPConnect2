<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest eBooks View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }
        .search-form {
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .search-form input, .search-form select, .search-form button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .search-form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search-form button:hover {
            background-color: #0056b3;
        }
        .ebook-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 10px;
            width: 20%;
            display: inline-block;
            vertical-align: top;
            text-align: center;
        }
        .ebook-card h3 {
            margin-top: 10px;
        }
        .read-more-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .read-more-btn:hover {
            background-color: #0056b3;
        }
        .cover-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <h1>Available eBooks for Guests</h1>

    <a href="{{ route('guest.research') }}">Rsearch List</a>

    <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
        @foreach($ebooks as $ebook)
            <div class="ebook-card">
                @if($ebook->coverage)
                    <img src="{{ asset('storage/' . $ebook->coverage) }}" alt="Cover Image" class="cover-image">
                @else
                    <img src="{{ asset('storage/icons/defaultcover.png') }}" alt="Default Cover" class="cover-image">
                @endif

                <h3>{{ $ebook->title }}</h3>
                <p><strong>Author:</strong> {{ $ebook->author }}</p>
                <p><strong>Publisher:</strong> {{ $ebook->publisher }}</p>
                <p><strong>Year:</strong> {{ $ebook->copyrightyear }}</p>
                <p><strong>Location:</strong> {{ $ebook->location }}</p>

                <a href="{{ route('guest.ebooks.show', $ebook->id) }}" class="read-more-btn">Read More</a>
            </div>
        @endforeach
    </div>

</body>
</html>
