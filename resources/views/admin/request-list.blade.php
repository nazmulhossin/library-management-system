@extends('layouts/admin')
@section('title') Requested Book List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Requested Book List</h1>

        <div class="mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Book's Image</th>
                            <th>Book's Info</th>
                            <th>User's Image</th>
                            <th>User's Info</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Book's Image</th>
                            <th>Book's Info</th>
                            <th>User's Image</th>
                            <th>User's Info</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($borrowRequests as $request)
                            <tr>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $request->book_cover_image) }}" alt="{{ $request->book_title }}" /></div></td>
                                <td>
                                    <strong>Book ID:</strong> {{ $request->book_id }} <br> 
                                    <strong>Title:</strong> {{ $request->book_title }} <br> 
                                    <strong>Author:</strong> {{ $request->book_author }} <br> 
                                    <strong>Available Copies:</strong> {{ $request->books_available_copies }}
                                </td>
                                <td><div class="table-col-center"><img src="{{ asset('storage/' . $request->user_image) }}" alt="{{ $request->user_name }}" /></div></td>
                                <td>
                                    <strong>Name:</strong> {{ $request->user_name}} <br> 
                                    <strong>Reg. No:</strong> {{ $request->user_reg_number }}
                                </td>
                                <td>{{ $request->request_date }}</td>
                                <td>
                                    <form action="{{ route('admin/approveRequest', $request->request_id) }}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center">
                                            <label for="days" class="me-2">Days: </label>
                                            <input type="number" name="days" min="1" value="7" required class="form-control me-2" style="width: 80px;">
                                            <button type="submit" class="btn btn-success">Confirm</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection