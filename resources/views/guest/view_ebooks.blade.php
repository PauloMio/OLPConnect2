<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest eBooks View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            flex: 1 1 calc(25% - 40px);
            max-width: calc(25% - 40px);
            min-width: 200px;
            box-sizing: border-box;
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
            display: inline-block;
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

    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Navigation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.research') }}">Research List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>Available eBooks for Guests</h1>

    <form action="{{ route('guest.ebooks') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Title or Author..." value="{{ request('search') }}">
        <select name="category">
            <option value="">All Categories</option>
            <option value="Filipiniana" {{ request('category') == 'Filipiniana' ? 'selected' : '' }}>Filipiniana</option>
            <option value="Fiction" {{ request('category') == 'Fiction' ? 'selected' : '' }}>Fiction</option>
            <option value="General Reference" {{ request('category') == 'General Reference' ? 'selected' : '' }}>General Reference</option>
            <option value="Encyclopedia" {{ request('category') == 'Encyclopedia' ? 'selected' : '' }}>Encyclopedia</option>
            <option value="Senior High School" {{ request('category') == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
            <option value="Undergraduate" {{ request('category') == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
            <option value="Graduate School" {{ request('category') == 'Graduate School' ? 'selected' : '' }}>Graduate School</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
