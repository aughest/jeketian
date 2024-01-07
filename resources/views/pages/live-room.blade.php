@extends('layouts.app')


@section('main')
<main>
  <div class="container-fluid px-4">
      <h1 class="mt-4">Room</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Room</li>
      </ol>
      <div class="row">
        @foreach ($roomList as $room)
        <div class="col-xl-3 col-md-6 mb-2">
          <div class="card" style="">
              <img src="{{ $room->image_url }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $room->name }}</h5>
                {{-- <p class="card-text">{{ $room->description }}</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
              </div>
            </div>
        </div>
        @endforeach
      </div>
  </div>
</main>
@endsection