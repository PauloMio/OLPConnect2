<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest Logs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            padding: 2rem;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
@include('tab.AdminSidebar')

<div style="margin-left: 80px;" id="main-content">
        @yield('content')

        <div class="container">
            <h1 class="mb-4">Guest Logs</h1>

            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by Name...">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>School</th>
                        <th>ID Number</th>
                        <th>Course</th>
                        <th>Purpose</th>
                        <th>Logged At</th>
                    </tr>
                </thead>
                <tbody id="guestLogTable">
                    @foreach($guestLogs as $log)
                        <tr>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->school }}</td>
                            <td>{{ $log->id_num }}</td>
                            <td>{{ $log->course }}</td>
                            <td>{{ $log->purpose }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>


<script>
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#guestLogTable tr');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const name = row.children[0].textContent.toLowerCase();
            row.style.display = name.includes(searchTerm) ? '' : 'none';
        });
    });

    // Adjust margin based on sidebar open/closed
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
