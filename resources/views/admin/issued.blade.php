@extends('layouts/admin')
@section('title') Issued Book List @endsection
@section('main_content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-5">Issued Book List</h1>

        <div class="mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Member Id</th>
                            <th>Member Name</th>
                            <th>Book Code</th>
                            <th>Book Name</th>
                            <th>Issued Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Member Id</th>
                            <th>Member Name</th>
                            <th>Book Code</th>
                            <th>Book Name</th>
                            <th>Issued Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i = 1; $i <= 30; $i++)
                            <tr>
                                <td>1814025</td> <td>Rabbani Islam Refat</td> <td>3242221</td> <td>Introduction to Algorithms</td> <td>20-10-2024</td>
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