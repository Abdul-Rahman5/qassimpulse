@extends('admin.layout')
@section('body')
    <div class="container mt-5">
        <div class="test w-100">
            @include('admin.errors')
            @include('admin.success')
        </div>
        <div class="card mb-3 ms-5 mt-5 text-center">
            <img class="card-img-top mt-5 " src={{ asset("storage/$place->images") }} alt="Card image cap">
            <div class="card-body ">
                <h5 class="card-title">{{ $place->name }}</h5>
                <h5 class="card-title">{{ $place->type }}</h5>
                <h5 class="card-title">{{ $place->data }}</h5>
                <h5 class="card-title">{{ $place->link }}</h5>
                <h5 class="card-title">{{ $place->evaluation }}</h5>
                <h5 class="card-title">{{ $place->contact }}</h5>
                <h5 class="card-title">{{ $place->timeVisit }}</h5>
                <div class="butt d-flex  justify-content-center">
                    <p class="card-text me-5"> <a class="btn btn-success" href="{{ url("Place/edit/$place->id") }}">Edit</a></p>
                    <p class="card-text">
                    <form action="{{ url("Placedelete/$place->id") }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                    </p>
                </div>

            </div>
        </div>
    </div>

@endsection
