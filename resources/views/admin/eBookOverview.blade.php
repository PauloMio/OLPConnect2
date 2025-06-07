<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eBook Dashboard</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        .card-body h5 {
            font-weight: 600;
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .date-inputs {
            max-width: 400px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1 class="mb-4">eBook Dashboard</h1>

    {{-- Date Range Filter --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-5 d-flex gap-3 align-items-end date-inputs">
        <div class="form-group flex-grow-1">
            <label for="start_date" class="form-label">Starting Date</label>
            <input 
                type="date" 
                id="start_date" 
                name="start_date" 
                class="form-control" 
                value="{{ request()->input('start_date') ?? '' }}" />
        </div>

        <div class="form-group flex-grow-1">
            <label for="end_date" class="form-label">Ending Date</label>
            <input 
                type="date" 
                id="end_date" 
                name="end_date" 
                class="form-control" 
                value="{{ request()->input('end_date') ?? '' }}" />
        </div>

        <button type="submit" class="btn btn-primary px-4">Filter</button>
    </form>

    {{-- Stats --}}
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="card p-4">
                <h5>Overall eBooks</h5>
                <div class="stats-number text-primary">{{ $overallCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h5>Users (Accounts)</h5>
                <div class="stats-number text-success">{{ $usersCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h5>Guests (Guest Logs)</h5>
                <div class="stats-number text-warning">{{ $guestsCount }}</div>
            </div>
        </div>
    </div>

    {{-- Pie Charts --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="mb-3">eBook Categories</h5>
                <canvas id="categoryChart" height="300"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h5 class="mb-3">eBook Locations</h5>
                <canvas id="locationChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Prepare data for charts from PHP variables
    const categoryData = @json($categoryCounts);
    const locationData = @json($locationCounts);

    // Convert objects to arrays for Chart.js labels and values
    function parseData(dataObj) {
        return {
            labels: Object.keys(dataObj),
            counts: Object.values(dataObj),
        };
    }

    const categoryParsed = parseData(categoryData);
    const locationParsed = parseData(locationData);

    // Generate random colors for charts
    function generateColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            colors.push(`hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`);
        }
        return colors;
    }

    // Category Pie Chart
    new Chart(document.getElementById('categoryChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: categoryParsed.labels,
            datasets: [{
                data: categoryParsed.counts,
                backgroundColor: generateColors(categoryParsed.labels.length),
                borderWidth: 1,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false,
                }
            }
        }
    });

    // Location Pie Chart
    new Chart(document.getElementById('locationChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: locationParsed.labels,
            datasets: [{
                data: locationParsed.counts,
                backgroundColor: generateColors(locationParsed.labels.length),
                borderWidth: 1,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false,
                }
            }
        }
    });
</script>

{{-- Bootstrap JS Bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
