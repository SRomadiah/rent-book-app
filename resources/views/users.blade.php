@extends('layouts.mainlayout')

@section('title', 'User')
@section('content')
<h1>User List</h1>
<div class="mt-5 d-flex justify-content-end">
  <a href="/registered-user" class="btn btn-primary me-3">New Registered User</a>
  <a href="/user-blacklisted" class="btn btn-secondary">View Blacklist User</a>
</div>
<div class="mt-5">
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
</div>
<div class="my-5">
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Username</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->username }}</td>
        <td>{{ $item->phone }}</td>
        <td>
          <a href="/user-detail/{{$item->slug}}">Detail</a>
          <a href="/user-blacklist/{{$item->slug}}">Blacklist</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
