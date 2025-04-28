<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ebook Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        .card1 {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .cover-photo {
            width: 300px;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
        .details {
            flex: 1;
        }
        .details h2 {
            margin-top: 0;
        }
        iframe {
            width: 100%;
            height: 800px;
            border: none;
            border-radius: 8px;
        }
        .download-btn, .print-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }
        .download-btn:hover, .print-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="card card1">
        @if($ebook->coverage)
            <img src="{{ asset('storage/' . $ebook->coverage) }}" alt="Cover Photo" class="cover-photo">
        @else
            <img src="{{ asset('default_cover.jpg') }}" alt="Default Cover" class="cover-photo">
        @endif

        <div class="details">
            <h2>{{ $ebook->title }}</h2>
            <p><strong>Description:</strong> {{ $ebook->description }}</p>
            <p><strong>Edition:</strong> {{ $ebook->edition }}</p>
            <p><strong>Category:</strong> {{ $ebook->category }}</p>
            <p><strong>Publisher:</strong> {{ $ebook->publisher }}</p>
            <p><strong>Copyright Year:</strong> {{ $ebook->copyrightyear }}</p>
            <p><strong>Location:</strong> {{ $ebook->location }}</p>
        </div>
    </div>

    <div class="card">
        @if($ebook->pdf)
            <iframe src="{{ asset('storage/' . $ebook->pdf) }}"></iframe>
            <br>
            <a href="{{ asset('storage/' . $ebook->pdf) }}" download class="download-btn">Download PDF</a>
            <button onclick="document.querySelector('iframe').contentWindow.print()" class="print-btn">Print PDF</button>
        @else
            <p>No PDF available.</p>
        @endif
    </div>

</body>
</html>
