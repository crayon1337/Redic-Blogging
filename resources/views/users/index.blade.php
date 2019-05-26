@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>User ID</th>
            <th>Name</th>
            <th>EMail</th>
            <th>isAdmin</th>
            <th>Created At</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td> {{ $user->id }}</td>
                    <td> {{ $user->name }}</td>
                    <td> {{ $user->email }}</td>
                    <td> {{ $user->isAdmin }}</td>
                    <td> {{ $user->created_at }}</td>
                    <td>
                        <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('roleForm-{{ $user->id }}').submit();">{{ $user->isAdmin == 0 ? 'Admin' : 'User' }}</a> 

                        <form id="roleForm-{{ $user->id }}" method="POST" action="{{  route('changeRole', ['id' => $user->id, 'type' => $user->isAdmin == 0 ? 'admin' : 'user' ]) }}">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection