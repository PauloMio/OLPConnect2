@extends('layouts.category_app')

@section('title', 'Add Category')

@section('content')
    <h1>Add New Department</h1>

    <form method="POST" action="{{ route('admin.department.store') }}">
        @csrf

        <label for="category">Department Name:</label>
        <input type="text" id="department" name="department" value="{{ old('department') }}">
        @error('department')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Add Category</button>
    </form>

    <a href="{{ route('admin.department.index') }}">Back to Department</a>
@endsection
