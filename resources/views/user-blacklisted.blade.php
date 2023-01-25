@extends('layouts.mainlayout')

@section('title', 'Blacklisted User')
@section('content')
<h1>Blacklisted User</h1>
{{-- <div class="mt-5 d-flex justify-content-end">
  <a href="/registered-user" class="btn btn-primary me-3">New Registered User</a>
  <a href="/user-blacklisted" class="btn btn-secondary">View Blacklist User</a>
</div> --}}
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
      @foreach($blacklistedUser as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->username }}</td>
        <td>{{ $item->phone }}</td>
        <td>
          <a href="/user-restore/{{$item->slug}}">Restore</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
