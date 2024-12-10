@extends('layouts/admin')
@section('title') Book List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Book List</h1>

        <div class="mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Book Code</th>
                            <th>Book Name</th>
                            <th>Authors</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Book Code</th>
                            <th>Book Name</th>
                            <th>Authors</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i = 1; $i <= 30; $i++)
                            <tr>
                                <td>3242221</td> <td>Introduction to Algorithms</td> <td>Thomas H. Cormen, Charles E. Leiserson, Ronald Rivest, Clifford Stein</td> <td>Edit | Delete</td>
                            </tr> 
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('style')
    {{-- <link rel="stylesheet" href="{{ asset('css/admin-members.min.css') }}"> --}}
@endpush