<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ebook Overview</title>
    {{-- Bootstrap 5.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 220px;
            background-color: #f0f0f0;
            border-right: 1px solid #ddd;
            height: 100vh;
            overflow-y: auto;
            padding: 20px 10px;
            box-sizing: border-box;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px 40px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }
        .card {
            min-height: 180px;
        }
        h2 {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        @include('tab.AdminSidebar')
    </div>

    {{-- Main Content --}}
    <div class="main-content container py-4">
        <h2 class="mb-4">eBook Dashboard</h2>
        
        <a href="{{ route('admin.ebook-overview.pdf') }}" class="btn btn-secondary mb-4" target="_blank">
            Print Overview (Download PDF)
        </a>

        <form method="GET" action="{{ route('admin.dashboard') }}" id="filterForm">
            <div class="row g-4">
                {{-- Card 1: Overall Count --}}
                <div class="col-md-4">
                    <div class="card text-white bg-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Overall eBooks</h5>
                            <p class="fs-3">{{ $overallCount }}</p>
                        </div>
                    </div>
                </div>

                {{-- Added Year --}}
                <div class="col-md-4">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">eBooks Added by Year</h5>
                            <select name="added_year" class="form-select mb-2" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Select Year</option>
                                @foreach($addedYears as $year)
                                    <option value="{{ $year }}" {{ $addedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                            <p class="fs-3">{{ $addedYearCount !== null ? $addedYearCount : '--' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Updated Year --}}
                <div class="col-md-4">
                    <div class="card text-dark bg-warning shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">eBooks Updated by Year</h5>
                            <select name="updated_year" class="form-select mb-2" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Select Year</option>
                                @foreach($updatedYears as $year)
                                    <option value="{{ $year }}" {{ $updatedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                            <p class="fs-3">{{ $updatedYearCount !== null ? $updatedYearCount : '--' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Category --}}
                <div class="col-md-6">
                    <div class="card text-white bg-info shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">eBooks by Category</h5>
                            <select name="category" class="form-select mb-2" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $selectedCategory == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            <p class="fs-3">{{ $categoryCount !== null ? $categoryCount : '--' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Location --}}
                <div class="col-md-6">
                    <div class="card text-white bg-secondary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">eBooks by Location</h5>
                            <select name="location" class="form-select mb-2" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Select Location</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ $selectedLocation == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            </select>
                            <p class="fs-3">{{ $locationCount !== null ? $locationCount : '--' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
