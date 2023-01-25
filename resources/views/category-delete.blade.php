@extends('layouts.mainlayout')

@section('title', 'Delete Category')

@section('content')
<h2>Are you sure you want to delete {{$category->name}}?</h2>
<div class="mt-5">
  <a href="/categories" class="btn btn-info me-5">Cancel</a>
  <a href="/category-destroy/{{$category->slug}}" class="btn btn-danger">Sure</a>
</div>
@endsection