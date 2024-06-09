@extends('layouts/admin')
@section('title') Approve Member @endsection
@section('main_content')
@section('heading') Approve Member @endsection

<div class="member-details management-section">
    <table>
        <tr>
            <th>Sr.No.</th> <th>Member ID</th> <th>Member Name</th> <th>Contact</th> <th>Action</th>
        </tr>
        @for ($i = 1; $i <= 30; $i++)
            <tr>
                <td>{{$i}}</td> <td>1814021</td> <td>Md. Nazmul Hossain</td> <td>019400000000</td> <td>Approve</td>
            </tr> 
        @endfor
    </table>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('css/admin-details-and-management-section.min.css') }}">
@endpush