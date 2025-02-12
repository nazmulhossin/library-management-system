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
                            <th>Action</th>
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
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($members as $user)
                            <tr>
                                <td>{{ $user->registration_number }}</td>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" /></div></td>
                                <td>{{ $user->name }} <br> <strong><small>{{ $user->title }}</small></strong></td>
                                <td>{{ $user->session }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="table-col-center">
                                        <a class="btn btn-primary me-2" role="button" href="{{ route('admin/edit-member', $user->user_id) }}">Edit</a>
                                        <a class="btn btn-danger" role="button" href="{{ route('admin/delete-member', $user->user_id) }}" onclick="return confirm('Are you sure you want to delete the member?');">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection