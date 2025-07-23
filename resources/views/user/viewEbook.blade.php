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
            position: relative;
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 10px;
            flex: 1 1 calc(25% - 40px); /* 25% width minus margins */
            max-width: calc(25% - 40px);
            min-width: 200px; /* Ensure a decent min width for small screens */
            box-sizing: border-box;
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
        .favorite-toggle-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 24px;
            color: gold;
            cursor: pointer;
            z-index: 1;
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


@include('tab.userSidebar')

<div style="margin-left: 80px;" id="main-content">
    @yield('content')

    <h1>eBooks</h1>

    <form action="{{ route('user.ebooks') }}" method="GET" class="search-form">
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
                <form action="{{ route('user.ebooks.favorite', $ebook->id) }}" method="POST" class="favorite-toggle-form">
                    @csrf
                    <button type="submit" class="favorite-toggle-btn">
                        @if($account && $account->favorites->contains($ebook->id))
                            ⭐
                        @else
                            ☆
                        @endif
                    </button>
                </form>



                @if($ebook->coverage)
                    <img src="{{ url('storage/' . $ebook->coverage) }}" alt="Cover Image" class="cover-image">
                @else
                    <img src="{{ url('icons/defaultcover.png') }}" alt="Default Cover" class="cover-image">
                @endif

                <h3>{{ $ebook->title }}</h3>
                <p><strong>Author:</strong> {{ $ebook->author }}</p>
                <p><strong>Publisher:</strong> {{ $ebook->publisher }}</p>
                <p><strong>Copyright Year:</strong> {{ $ebook->copyrightyear }}</p>
                <p><strong>Location:</strong> {{ $ebook->location }}</p>

                <a href="{{ route('user.ebooks.show', $ebook->id) }}" class="read-more-btn">Read More</a>
            </div>
        @endforeach
    </div>
    


    <script>
        // Adjust margin based on sidebar width
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        const resizeObserver = new ResizeObserver(() => {
            const width = sidebar.offsetWidth;
            mainContent.style.marginLeft = width + 'px';
        });

        resizeObserver.observe(sidebar);
    </script>
</div>
    

    

</body>
</html>
