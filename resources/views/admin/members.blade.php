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
                            <th>Name</th>
                            <th>Session</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @for ($i = 1; $i <= 30; $i++)
                            <tr>
                                <td>1814021</td> <td>Md. Nazmul Hossain</td> <td>2018-19</td> <td>019411xxxxx</td> <td>mdnazmul@gmail.com</td> <td>Edit | Delete</td>
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