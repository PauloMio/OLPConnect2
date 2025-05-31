@extends('layouts.category_app')

@section('title', 'Add Category')

@section('content')
    <h1>Add New Location</h1>

    <form method="POST" action="{{ route('admin.ebook_locations.store') }}">
        @csrf

        <label for="location">Location Name:</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}">
        @error('location')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Add Location</button>
    </form>

    <a href="{{ route('admin.ebook_locations.index') }}">Back to Locations</a>
@endsection
