@extends('layouts.category_app')

@section('title', 'Add Category')

@section('content')
    <h1>Add New Program</h1>

    <form method="POST" action="{{ route('admin.program_user.store') }}">
        @csrf

        <label for="program">Location Name:</label>
        <input type="text" id="program" name="program" value="{{ old('program') }}">
        @error('program')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Add Program</button>
    </form>

    <a href="{{ route('admin.program_user.index') }}">Back to Programs</a>
@endsection
