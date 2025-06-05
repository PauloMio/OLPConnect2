@extends('layouts.category_app')

@section('title', 'Ebook Categories')

@section('content')


{{-- Sidebar --}}
@include('tab.AdminSidebar')

<div style="margin-left: 80px;" id="main-content" class="container mt-4">
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

</div>

<script>
    // Adjust margin based on sidebar open/closed
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    const resizeObserver = new ResizeObserver(() => {
        const width = sidebar.offsetWidth;
        mainContent.style.marginLeft = width + 'px';
    });

    resizeObserver.observe(sidebar);
</script>