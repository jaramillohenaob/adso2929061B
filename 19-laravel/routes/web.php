<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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

    $createAt = function($created_at) {
        return Carbon::parse($created_at)->diffForHumans();
    };

    $table = "<table>";
    $table .= "<tr><th>ID</th><th>Photo</th><th>Fullname</th><th>Age</th><th>Create At</th></tr>";
    foreach ($users as $user) {
        $table .= "<tr>";
        $table .= "<td>" . $user->id . "</td>";
        $table .= "<td><img src='" . asset('images/' . $user->photo) . "' width='50'></td>";
        $table .= "<td>" . $user->fullname . "</td>";
        $table .= "<td>" . Carbon::parse($user->birthdate)->age . " Years old" . "</td>";
        $table .= "<td>" . $createAt($user->created_at) . "</td>";
        $table .= "</tr>";
    }
    $table .= "</table>";
    return $styleTable . $table;
});

Route::get('getall/pets', function() {
    $pets = App\Models\Pet::all();
    return view('getallpets')->with('pets', $pets);
});

Route::get('showpet/{id}', function() {
    $pet = App\Models\Pet::find(request()->id);
    return view('showpet')->with('pet', $pet);
});