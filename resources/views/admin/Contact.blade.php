@extends('admin.layout')
@section('body')
@include('admin.errors');
@include('admin.success')

<table class="table m-auto  w-75 text-center">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Message</th>
        <th scope="col">subject </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$message->fullName}}</td>
        <td>{{$message->topic}}</td>
        <td>{{$message->subject}}</td>
    </tr>
    @endforeach

    </tbody>
  </table>


@endsection