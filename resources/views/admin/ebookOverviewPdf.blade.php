<!DOCTYPE html>
<html>
<head>
    <title>Ebook Overview PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        .section { margin-bottom: 20px; }
        .section h3 { border-bottom: 1px solid #333; padding-bottom: 5px; }
        .item { margin-left: 15px; }
    </style>
</head>
<body>
    <h2>Ebook Overview</h2>

    <div class="section">
        <h3>Overall Ebooks Count:</h3>
        <p>{{ $overallCount }}</p>
    </div>

    <div class="section">
        <h3>Ebooks Added Year</h3>
        @foreach($addedYearCounts as $year => $count)
            <p class="item">{{ $year }}: {{ $count }}</p>
        @endforeach
    </div>

    <div class="section">
        <h3>Ebooks Updated Year</h3>
        @foreach($updatedYearCounts as $year => $count)
            <p class="item">{{ $year }}: {{ $count }}</p>
        @endforeach
    </div>

    <div class="section">
        <h3>Ebooks Per Category</h3>
        @foreach($categoryCounts as $category => $count)
            <p class="item">{{ $category }}: {{ $count }}</p>
        @endforeach
    </div>

    <div class="section">
        <h3>Ebooks Per Location</h3>
        @foreach($locationCounts as $location => $count)
            <p class="item">{{ $location }}: {{ $count }}</p>
        @endforeach
    </div>
</body>
</html>
