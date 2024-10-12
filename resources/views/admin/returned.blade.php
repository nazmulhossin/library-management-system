@extends('layouts/admin')
@section('title') Returned Book List @endsection
@section('main_content')
    @section('heading') Returned Book List @endsection
    <div class="books-details management-section">
        <table>
            <tr>
                <th>Sr.No.</th> <th>Member Id</th> <th>Member Name</th> <th>Book Code</th> <th>Book Name</th>
            </tr>
            @for ($i = 1; $i <= 30; $i++)
                <tr>
                    <td>{{$i}}</td> <td>1814021</td> <td>Rabbani Islam Refat</td> <td>3242221</td> <td>Introduction to Algorithms</td>
                </tr> 
            @endfor
        </table>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/admin-details-and-management-section.min.css') }}">
@endpush