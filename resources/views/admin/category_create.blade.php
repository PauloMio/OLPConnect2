@extends('layouts.category_app')

@section('title', 'Add Category')

@section('content')
    <h1>Add New Category</h1>

    <form method="POST" action="{{ route('admin.ebook_categories.store') }}">
        @csrf

        <label for="category">Category Name:</label>
        <input type="text" id="category" name="category" value="{{ old('category') }}">
        @error('category')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Add Category</button>
    </form>

    <a href="{{ route('admin.ebook_categories.index') }}">Back to Categories</a>
@endsection
