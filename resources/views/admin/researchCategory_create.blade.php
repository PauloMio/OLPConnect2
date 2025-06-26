@extends('layouts.category_app')

@section('title', 'Add Category')

@section('content')
    <h1>Add New Category</h1>

    <form method="POST" action="{{ route('admin.research-category.store') }}">
        @csrf

        <label for="program">Category Name:</label>
        <input type="text" id="category" name="category" value="{{ old('category') }}">
        @error('program')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Add Category</button>
    </form>

    <a href="{{ route('admin.research-category.index') }}">Back to Categories</a>
@endsection
