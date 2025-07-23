@extends('layouts.category_app')

@section('title', 'Ebook Categories')

@section('content')

{{-- Sidebar --}}
@include('tab.AdminSidebar')

<style>
    .container {
        max-width: 900px;
        margin: auto;
        padding: 30px 20px;
        font-family: 'Arial', sans-serif;
    }

    h2, h3 {
        color: #333;
        margin-bottom: 20px;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 25px;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    input[type="file"] {
        padding: 8px;
        font-size: 16px;
    }

    .btn-blue {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-blue:hover {
        background-color: #0056b3;
    }

    .btn-red {
        background-color: #dc3545;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-red:hover {
        background-color: #c82333;
    }

    ul.announcement-list {
        list-style: none;
        padding: 0;
    }

    ul.announcement-list li {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        background: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
    }

    ul.announcement-list img {
        border-radius: 6px;
        margin-right: 15px;
        max-height: 80px;
    }

    ul.announcement-list form {
        margin-left: auto;
    }

    .success-message {
        color: green;
        margin-bottom: 15px;
        font-weight: bold;
    }
</style>

<div style="margin-left: 80px;" id="main-content" class="container mt-4">

    <div class="card">
        <h2>Upload Announcement Image</h2>

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="image" required>
            </div>
            <button type="submit" class="btn-blue">Upload</button>
        </form>
    </div>

    <div class="card">
        <h3>All Announcements</h3>

        <ul class="announcement-list">
            @foreach($announcements as $announcement)
                <li>
                    <img src="{{ url('storage/' . $announcement->image_path) }}" alt="Announcement Image" width="100">
                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-red">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    const resizeObserver = new ResizeObserver(() => {
        const width = sidebar.offsetWidth;
        mainContent.style.marginLeft = width + 'px';
    });

    resizeObserver.observe(sidebar);
</script>
@endsection
