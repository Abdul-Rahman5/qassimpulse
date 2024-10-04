@extends('admin.layout')
@section('body')
    <div class="container mt-5">
        <div class="test w-100">
            @include('admin.errors')
            @include('admin.success')
        </div>

        <div class="card mb-3 ms-5 mt-5">
            <img class="card-img-top mt-5" src={{ asset("storage/$product->image") }} alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <div class="butt d-flex">
                    <p class="card-text me-5"> <a class="btn btn-success" href="{{ url("div/edit/$product->id") }}">Edit</a>
                    </p>
                    <p class="card-text">
                    <form action="{{ url("div/delete/$product->id") }}" method="post">
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
