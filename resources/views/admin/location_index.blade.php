@extends('layouts.category_app')

@section('title', 'Ebook Categories')

@section('content')
    <h1>Ebook Locations</h1>

    <a href="{{ route('admin.ebook_locations.create') }}" class="btn">Add New Location</a>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <ul class="list">
        @foreach($locations as $location)
            <li style="display: flex; justify-content: space-between; align-items: center;">
                {{ $location->location }}
                <form action="{{ route('admin.ebook_locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this location?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #dc2626;">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
