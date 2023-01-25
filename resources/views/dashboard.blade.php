@extends('layouts.mainlayout')

@section('title', 'Dashboard')
@section('content')

<h1>Hi, Welcome {{Auth::user()->username}}</h1>

<div class="row mt-5">
    <div class="col-lg-4">
        <div class="card-data book">
            <div class="row align-items-center">
                <div class="col-6">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-desc">Book</div>
                    <div class="card-count">{{$book_count}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-data categories">
            <div class="row align-items-center">
                <div class="col-6">
                    <i class="bi bi-list-task"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-desc">Categories</div>
                    <div class="card-count">{{$categories_count}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-data users">
            <div class="row align-items-center">
                <div class="col-6">
                    <i class="bi bi-person-vcard"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                    <div class="card-desc">User</div>
                    <div class="card-count">{{$users_count}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    {{-- <h2>#Rent Log</h2> --}}
    <table class="table">
        {{-- <thead>
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Book Title</th>
                <th>Rent Date</th>
                <th>Rent Return</th>
                <th>Actual Return</th>
                <th>Status</th>
            </tr>
        </thead> --}}
        <tbody>
           {{-- <tr>
            {{-- <td colspan="7">No Data</td> --}}
           </tr> --}}
        </tbody>
    </table>
</div>
@endsection