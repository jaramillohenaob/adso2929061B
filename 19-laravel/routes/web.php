<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return "<h1>Hello Laravel 🚀</h1>";
});

Route::get('sayhello/{name}', function() {
    return "<h1>Hello: ".request()->name."</h1>";
});

Route::get('getall/pets', function() {
    $pets = App\Models\Pet::all();
    dd($pets->toArray());
});

Route::get('show/pet/{id}', function() {
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray());
});

Route::get('challenge', function() {
    $users = App\Models\User::take(20)->get();
    $styleTable = "<style>
table {
    border-collapse: collapse;
    width: 80%;
    margin: 0 auto;
}

th, td {
    border: 1px solid #ccc;
    padding: 0.5rem 1rem;
    text-align: center;
}

th {
    background: #4d8076;
    color: white;
}
    </style>";
    $table = "<table>";
    $table .= "<tr><th>ID</th><th>Document</th><th>Fullname</th><th>Gender</th><th>Birthdate</th><th>Phone</th><th>Email</th><th>Photo</th></tr>";
    foreach ($users as $user) {
        $table .= "<tr>";
        $table .= "<td>" . $user->id . "</td>";
        $table .= "<td>" . $user->document . "</td>";
        $table .= "<td>" . $user->fullname . "</td>";
        $table .= "<td>" . $user->gender . "</td>";
        $table .= "<td>" . $user->birthdate . "</td>";
        $table .= "<td>" . $user->phone . "</td>";
        $table .= "<td>" . $user->email . "</td>";
        $table .= "<td>" . $user->photo . "</td>";
        $table .= "</tr>";
    }
    $table .= "</table>";
    return $styleTable . $table;
});