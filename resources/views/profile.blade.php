@extends('layouts.mainlayout')

@section('title', 'Profile')
@section('content')
<div class="mt-3">
    <h3>User's Rent Log</h3>
    <x-rent-log-table :rentlog='$rent_logs'/>
  </div>
@endsection