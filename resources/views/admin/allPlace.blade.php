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
                    <th scope="col">type</th>
                    <th scope="col">evaluation</th>
                    <th scope="col">images</th>
                    <th scope="col">Show</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $place)
                    <tr class="mt-5 pt-5">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $place->name }}</td>
                        <td>{{ $place->type }}</td>
                        <td>{{ $place->evaluation }}</td>
                        <td><img src="{{ asset("storage/$place->images") }}" width="100px" alt="test" srcset=""></td>
                        <td>
                            <h1>
                                <a class="btn btn-success" href="{{ url("showPlace/$place->id") }}">Show</a>
                            </h1>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
