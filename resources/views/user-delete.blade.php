@extends('layouts.mainlayout')

@section('title', 'Delete User')

@section('content')
<h2>Are you sure you want to Blacklist {{$user->username}}?</h2>
<div class="mt-5">
  <a href="/users" class="btn btn-info me-5">Cancel</a>
  <a href="/user-destroy/{{$user->slug}}" class="btn btn-danger">Sure</a>
</div>
@endsection