<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Favorites</title>
    <style>
        body { font-family: Arial; background: #f0f2f5; padding: 20px; }
        .card { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 30px; }
        .card1 { display: flex; gap: 20px; align-items: flex-start; }
        .cover-photo { width: 300px; height: 400px; object-fit: cover; border-radius: 8px; }
        .details { flex: 1; }
        .details h2 { margin-top: 0; }
        .star-btn { background: none; border: none; font-size: 24px; cursor: pointer; color: gold; }
    </style>
</head>
<body>

    @include('tab.userSidebar')

    <div style="margin-left: 80px;" id="main-content">
        @yield('content')

        <h1>Your Favorite eBooks</h1>

    @foreach($favorites as $ebook)
        <div class="card card1">
            @if($ebook->coverage)
                <img src="{{ asset('storage/' . $ebook->coverage) }}" alt="Cover Photo" class="cover-photo">
            @else
                <img src="{{ asset('storage/icons/defaultcover.png') }}" alt="Default Cover" class="cover-photo">
            @endif

            <div class="details">
                <h2>{{ $ebook->title }}</h2>
                <p><strong>Description:</strong> {{ $ebook->description }}</p>
                <p><strong>Edition:</strong> {{ $ebook->edition }}</p>
                <p><strong>Category:</strong> {{ $ebook->category }}</p>
                <p><strong>Publisher:</strong> {{ $ebook->publisher }}</p>
                <p><strong>Copyright Year:</strong> {{ $ebook->copyrightyear }}</p>
                <p><strong>Location:</strong> {{ $ebook->location }}</p>

                <div style="margin-top: 20px;">
                    <a href="{{ route('user.ebooks.show', $ebook->id) }}" class="btn-read" target="_blank">📖 Read More</a>

                    <form action="{{ route('user.ebooks.favorite', $ebook->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="star-btn" title="Remove from favorites">⭐ Remove</button>
                    </form>
                </div>

            </div>
        </div>
    @endforeach

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
