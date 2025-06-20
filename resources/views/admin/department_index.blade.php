@extends('layouts.category_app')

@section('title', 'Ebook Categories')

@section('content')

{{-- Sidebar --}}
@include('tab.AdminSidebar')

<div style="margin-left: 80px;" id="main-content" class="container mt-4">
    <h1>Department</h1>

    <a href="{{ route('admin.department.create') }}" class="btn">Add New Department</a>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <ul class="list">
        @foreach($department as $dept)
            <li style="display: flex; justify-content: space-between; align-items: center;">
                {{ $dept->department }}
                <form action="{{ route('admin.department.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #dc2626;">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
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
    