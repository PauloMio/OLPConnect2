<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Research Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @include('tab.userSidebar')

<div style="margin-left: 80px;" id="main-content">
    @yield('content')

    <div class="container mt-4">
        <h3 class="mb-4">Research Records</h3>

        <!-- Filter and Search Form -->
        <form method="GET" action="{{ route('user.research') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <select name="category" onchange="this.form.submit()" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or author" class="form-control" />
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">Search</button>
            </div>
        </form>

        <!-- Research Table -->
        <table class="table table-bordered table-striped">
            <thead>
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
                    <td colspan="6" class="text-center">No research records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $researches->appends(request()->query())->links() }}
        </div>
    </div>
</div>
    

    <script>
        // Adjust margin based on sidebar width
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            const resizeObserver = new ResizeObserver(() => {
                const width = sidebar.offsetWidth;
                mainContent.style.marginLeft = width + 'px';
            });

            resizeObserver.observe(sidebar);
    </script>
</body>
</html>
