@extends('layouts.category_app')

@section('title', 'Ebook Categories')

@section('content')
    <h1>Programs</h1>

    <a href="{{ route('admin.program_user.create') }}" class="btn">Add New Program</a>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <ul class="list">
        @foreach($programs as $program)
            <li style="display: flex; justify-content: space-between; align-items: center;">
                {{ $program->program }}
                <form action="{{ route('admin.program_user.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this program?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background-color: #dc2626;">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
