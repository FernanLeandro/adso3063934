@extends('layouts.dashboard')

@section('title', 'Module Users: Larapets 🐶')

@section('content')
    @foreach ($users as $user)
    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>id</th>
                    <th>Document</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)

               <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->document }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="">Show</a>
                        <a href="">Edit</a>
                        <a href="">Delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">{{ $users->links() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endsection