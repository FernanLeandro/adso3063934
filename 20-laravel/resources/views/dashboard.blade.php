@extends('layouts.dashboard')
@section('title', 'Dashboard ADMIN: Larapets 🐶')

@section('content')

 <h1>Dashboard</h1>
 <h2>{{ Auth::user()->fullname }}</h2>
 <h3>You're logged in!</h3>
 <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="javascript:;"
            onclick="event.preventDefault();
            this.closest('form').submit();">
        log Out
    </a>

 </form>

 @endsection