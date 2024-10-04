@extends('admin.layout')
@section('body')
    <div class="container mt-5">
        <div class="test w-100">
            @include('admin.errors')
            @include('admin.success')
        </div>
        <table class="table mt-5 pt-5">



            <thead class="mt-5 pt-5">

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">Show</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($divides as $product)
                    <tr class="mt-5 pt-5">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset("storage/$product->image") }}" width="100px" alt="test" srcset=""></td>
                        <td>
                            <h1>
                                <a class="btn btn-success" href="{{ url("showSection/$product->id") }}">Show</a>
                            </h1>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
