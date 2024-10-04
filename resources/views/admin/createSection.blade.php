@extends('admin.layout')
@section('body')

<form method="POST" class="w-75 m-auto" action="{{url('storeSection')}}" enctype="multipart/form-data">
    @csrf
@include('admin.errors')
@include('admin.success')


    <div class="form-group">
      <label for="exampleInputEmail1">Section Name</label>
      <input type="text" name="name" class="form-control text-white rounded-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>




      <div class="form-group">
        <label for="exampleInputEmail1"> image</label>
        <input type="file" name="image" class="form-control text-white rounded-3 " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

    <button type="submit" class="btn btn-primary ">Submit</button>
</form>

@endsection