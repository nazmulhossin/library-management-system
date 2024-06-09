@extends('layouts/admin')
@section('title') Book List @endsection
@section('main_content')
@section('heading') Book List @endsection

<div class="books-details management-section">
    <table>
        <tr>
            <th>Sr.No.</th> <th>Book Code</th> <th>Book Name</th> <th>Authors</th> <th>Action</th>
        </tr>
        @for ($i = 1; $i <= 30; $i++)
            <tr>
                <td>{{$i}}</td> <td>3242221</td> <td>Introduction to Algorithms</td> <td>Thomas H. Cormen, Charles E. Leiserson, Ronald Rivest, Clifford Stein</td> <td>Edit | Delete</td>
            </tr> 
        @endfor
    </table>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('css/admin-details-and-management-section.min.css') }}">
@endpush