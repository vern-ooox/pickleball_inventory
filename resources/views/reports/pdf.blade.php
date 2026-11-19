<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { font-size: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #777; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Availability Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td>{{ $item->equipment_name }}</td>
                <td>{{ ucfirst($item->category) }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ ucfirst($item->availability_status) }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No equipment records match the selected filters.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
