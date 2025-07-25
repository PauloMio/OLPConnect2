<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Research Repository - Guest View</title>
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navigation</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.ebooks') }}">eBook Collection</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container mt-5">
    <h2 class="mb-4">Research Repository (Guest View)</h2>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('guest.research') }}" class="row g-3 align-items-center mb-4">
        <div class="col-auto">
            <select name="category" onchange="this.form.submit()" class="form-select">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="col-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or author" class="form-control">
        </div>

        <div class="col-auto">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Research Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Category</th>
                    <th>Program</th>
                    <th>Department</th>
                    <th>Accession No</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($researches as $research)
                    <tr>
                        <td>{{ $research->title }}</td>
                        <td>{{ $research->author }}</td>
                        <td>{{ $research->year }}</td>
                        <td>{{ $research->category }}</td>
                        <td>{{ $research->program }}</td>
                        <td>{{ $research->Department }}</td>
                        <td>{{ $research->accession_no }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No research found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div>
        {{ $researches->appends(request()->query())->links() }}
    </div>
</div>

</body>
</html>
