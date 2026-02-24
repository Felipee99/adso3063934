<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Pets</title>
</head>
<body>

    <table border="1" cellpadding="6" cellspacing="0">
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

                <td>
                    <img src="{{ asset('images/'.$pet->image) }}" width="50px">
                </td>

                <td>{{ $pet->kind }}</td>
                <td>{{ $pet->weight }}</td>
                <td>{{ $pet->age }}</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ $pet->description }}</td>

                <td>
                    {{ $pet->active == 1 ? 'Yes' : 'No' }}
                </td>

                <td>{{ $pet->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
