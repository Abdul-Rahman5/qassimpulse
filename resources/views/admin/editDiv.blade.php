@extends('admin.layout')
@section('body')

<form method="POST" class="mt-5 w-75 m-auto" action="{{url("div/update/$product->id")}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group mt-3">
      <label for="exampleInputEmail1" class="mt-5 mb-3 ">Section Name :</label>
      <input type="text" name="name" class="form-control text-white mb-5" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->name}}">
    </div>
      <div class="form-group">
        <label for="exampleInputEmail1">old image</label>
        <img src="{{asset("storage/$product->image")}}" class="w-100" alt="" srcset="">
        <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


@endsection