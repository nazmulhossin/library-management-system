@extends('layouts/admin')
@section('title') Member List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Member List</h1>

        <div class="mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Session</th>
                            <th>Contact No</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Member ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Session</th>
                            <th>Contact No</th>
                            <th>Email</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($members as $user)
                            <tr>
                                <td>{{ $user->registration_number }}</td>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" /></div></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->session }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection