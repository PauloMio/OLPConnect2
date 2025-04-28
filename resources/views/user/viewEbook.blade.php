<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Ebook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }
        .ebook-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
            text-align: center;
        }
        .ebook-card h3 {
            margin-top: 10px;
        }
        .favorite-toggle {
            float: right;
            cursor: pointer;
            color: gold;
            font-size: 24px;
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

    <h1>eBooks</h1>

    @foreach($ebooks as $ebook)
        <div class="ebook-card">
            <div>
                <span class="favorite-toggle">&#9734;</span> <!-- Star icon -->
            </div>

            @if($ebook->coverage)
                <img src="{{ asset('storage/' . $ebook->coverage) }}" alt="Cover Image" class="cover-image">
            @else
                <img src="{{ asset('default_cover.jpg') }}" alt="Default Cover" class="cover-image">
            @endif

            <h3>{{ $ebook->title }}</h3>
            <p><strong>Author:</strong> {{ $ebook->author }}</p>
            <p><strong>Publisher:</strong> {{ $ebook->publisher }}</p>
            <p><strong>Copyright Year:</strong> {{ $ebook->copyrightyear }}</p>
            <p><strong>Location:</strong> {{ $ebook->location }}</p>

            <button class="read-more-btn">Read More</button>
        </div>
    @endforeach

</body>
</html>
