<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ebook</title>
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

    @if(isset($account))
        <div style="margin-bottom: 20px;">
            <strong>Logged in as:</strong> {{ $account->firstname }} {{ $account->lastname }}
        </div>
    @endif

    <form method="POST" action="{{ route('account.logout') }}">
        @csrf
        <button type="submit" style="padding: 6px 12px; background: crimson; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Logout
        </button>
    </form>
    

    <h1>eBooks</h1>

    <form action="{{ route('user.ebooks') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search title..." value="{{ request('search') }}">
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

            <a href="{{ route('user.ebooks.show', $ebook->id) }}" class="read-more-btn">Read More</a>
        </div>
    @endforeach

</body>
</html>
