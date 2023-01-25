@extends('layouts.mainlayout')

@section('title', 'Delete Book')

@section('content')
<h2>Are you sure you want to delete {{$book->title}}?</h2>
<div class="mt-5">
  <a href="/books" class="btn btn-info me-5">Cancel</a>
  <a href="/book-destroy/{{$book->slug}}" class="btn btn-danger">Sure</a>
</div>
@endsection