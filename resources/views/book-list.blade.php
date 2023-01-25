@extends('layouts.mainlayout')

@section('title', 'Books')
@section('content')
<form action="" method="get">
  <div class="row">
    <div class="col-12 col-sm-6">
      <select name="category" id="category" class="form-control">
        <option value="">Select Category</option>
        @foreach ($categories as $item)
        <option value="{{ $item->id }}">{{$item->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-12 col-sm-6">
      {{-- <input type="text" name="title" class="form-control" placeholder="title book's search "> --}}
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="title" placeholder="Search Book's Title">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </div>
  </div>
</form>
<div class="my-5">
  <div class="row">
    @foreach ($books as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
      <div class="card h-100">
        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/cover-not-found.png') }}" class="card-img-top images" draggable="false">
        <div class="card-body">
          <h5 class="card-title">{{$item->book_code}}</h5>
          <p class="card-text">{{$item->title}}</p>
          <p class="card-text text-end fw-bold {{$item->status =='in stock' ? 'text-success' : 'text-danger'}}">
            {{$item->status}}
          </p>
          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection