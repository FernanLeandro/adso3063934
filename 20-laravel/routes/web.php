<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return "This is a entry point: 👍";
    return view('welcome');
});

Route::get('hello', function() {
    return "<h1>Hello folks, have a nice day ❤️</h1>";
});

Route::get('hello/{name}', function() {
    return "<h1>Hello: ".request()->name."</h1>";
});

Route::get('show/pets', function() {
    $pets = App\Models\Pet::all();
    dd($pets->toArray()); //Dump & Die
});

Route::get('show/pets/{id}', function() {
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray()); //Dump & Die
});

Route::get('challenge', function(){
    $users = App\Models\User::take(20)->get();
    
    $html = '<table border="1">';
    $html .= '<thead><tr>';
    $html .= '<th>ID</th>';
    $html .= '<th>Name</th>';
    $html .= '<th>Image</th>';
    $html .= '<th>Birthdate</th>';
    $html .= '<th>Created At</th>';
    $html .= '</tr></thead>';
    
    $html .= '<tbody>';
    foreach($users as $user) {
        $html .= '<tr>';
        $html .= '<td>'.$user->id.'</td>';
        $html .= '<td>'.$user->fullname.'</td>';
        $html .= '<th><img src="'.asset("images/".$user->photo).'" width="70px"></th>';
        $html .= '<td>' . Carbon\Carbon::parse($user->birthdate)->age . '</td>';
        $html .= '<td>'.$user->created_at->diffforhumans().'</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';
    
    return $html;
});

Route::get('view/pets', function() {
    $pets = App\Models\Pet::all();
    return view('view-pets')->with('pets', $pets);
});



