<!DOCTYPE html>
<html>
<head>
    <title>Announcements</title>
</head>
<body>
    <h2>Upload Announcement Image</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>

    <h3>All Announcements</h3>
    <ul>
        @foreach($announcements as $announcement)
            <li>
                <img src="{{ asset('storage/' . $announcement->image_path) }}" alt="Announcement Image" width="100">
                <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this image?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
