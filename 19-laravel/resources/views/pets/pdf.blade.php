<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pets PDF</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Kind</th>
                <th>Breed</th>
                <th>Weight</th>
                <th>Age</th>
                <th>Location</th>
                <th>Adopted</th>
                <th>Active</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
                <tr>
                    <td>{{$pet->id}}</td>
                    <td>{{$pet->name}}</td>
                    <td>{{ucfirst($pet->kind)}}</td>
                    <td>{{$pet->breed}}</td>
                    <td>{{$pet->weight}} kg</td>
                    <td>{{$pet->age}} yrs</td>
                    <td>{{$pet->location}}</td>
                    <td>
                        @if ($pet->adopted == 1)
                            Adopted
                        @else
                            Available
                        @endif
                    </td>
                    <td>
                        @if ($pet->active == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @php
                            $extension = strtolower(pathinfo($pet->image, PATHINFO_EXTENSION));
                        @endphp
                        @if ($extension != 'webp' && $extension != 'svg')
                        <img src="{{public_path().'/images/pets/'.$pet->image}}" width="96px">
                        @else
                            Webp|SVG
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
