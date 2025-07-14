<!DOCTYPE html>
<html>
<head>
    <title>eBook Overview Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }
        h1, h2 {
            text-align: center;
        }
        .summary {
            margin-top: 30px;
        }
        .section {
            margin-top: 20px;
        }
        .section h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #888;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

    <h1>eBook Dashboard Summary</h1>

    @if($startDate && $endDate)
        <p style="text-align: center;">From <strong>{{ \Carbon\Carbon::parse($startDate)->toFormattedDateString() }}</strong> 
            to <strong>{{ \Carbon\Carbon::parse($endDate)->toFormattedDateString() }}</strong></p>
    @endif

    <div class="summary">
        <h2>Summary Stats</h2>
        <table>
            <tr>
                <th>Overall eBooks</th>
                <td>{{ $overallCount }}</td>
            </tr>
            <tr>
                <th>Registered Users</th>
                <td>{{ $usersCount }}</td>
            </tr>
            <tr>
                <th>Guest Visitors</th>
                <td>{{ $guestsCount }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>eBook Categories</h3>
        <table>
            <tr>
                <th>Category</th>
                <th>Count</th>
            </tr>
            @foreach($categoryCounts as $category => $count)
                <tr>
                    <td>{{ $category ?? 'Uncategorized' }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h3>eBook Locations</h3>
        <table>
            <tr>
                <th>Location</th>
                <th>Count</th>
            </tr>
            @foreach($locationCounts as $location => $count)
                <tr>
                    <td>{{ $location ?? 'Unknown' }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h3>Research Count by Department</h3>
        <table>
            <tr>
                <th>Department</th>
                <th>Count</th>
            </tr>
            @foreach($departmentCounts as $dept => $count)
                <tr>
                    <td>{{ $dept ?? 'N/A' }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h3>Research Count per Category</h3>
        <table>
            <tr>
                <th>Category</th>
                <th>Count</th>
            </tr>
            @foreach($researchCategoryCounts as $cat => $count)
                <tr>
                    <td>{{ $cat ?? 'Uncategorized' }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </table>
    </div>

</body>
</html>
