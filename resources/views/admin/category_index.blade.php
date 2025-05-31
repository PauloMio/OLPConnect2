@extends('layouts.category_app')

@section('title', 'Ebook Categories')

@section('content')
    <h1>Ebook Categories</h1>

    <a href="{{ route('admin.ebook_categories.create') }}" class="btn">Add New Category</a>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <ul class="list">
        @foreach($categories as $category)
            <li style="display: flex; justify-content: space-between; align-items: center;">
                {{ $category->category }}
                <form action="{{ route('admin.ebook_categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #dc2626;">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection