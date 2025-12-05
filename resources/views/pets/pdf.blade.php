<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Pets</title>
    <style>
        table {
            border: 2px solid #aaa;
            border-collapse: collapse
        }
        table th, table td {
            font-family: sans-serif;
            font-size: 10px;
            border: 2px solid #ccc;
            padding: 4px;
        }
        table tr:nth-child(odd) {
            background-color: #eee;
        }
        table th {
            background-color: #666;
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Kind</th>
                <th>Weight</th>
                <th>Age</th>
                <th>Breed</th>
                <th>Description</th>
                <th>Active</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet->id }}</td>
                <td>{{ $pet->name }}</td>

                {{-- IMAGE --}}
                <td>
                    @php
                        $extension = substr($pet->image, -4);
                    @endphp
                    @if ($extension != 'webp' && $extension != '.svg')
                        <img src="{{ public_path().'/images/'.$pet->image }}" width="70px">
                    @else
                        Webp|SVG
                    @endif
                </td>

                <td>{{ $pet->kind }}</td>
                <td>{{ $pet->weight }} kg</td>
                <td>{{ $pet->age }} years</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ $pet->description }}</td>

                <td>
                    @if ($pet->active == 1)
                        Active
                    @else
                        Inactive
                    @endif
                </td>

                <td>{{ $pet->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
