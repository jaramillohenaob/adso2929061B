<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Active</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if ($user->active == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @php
                            $extension = substr($user->photo, -4);
                        @endphp
                        @if ($extension != 'webp' && $extension != '.svg')
                        <img src="{{public_path().'/images/users/'.$user->photo}}" width="96px">
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