@extends('admin.layout')
@section('body')
<div class="container mt-5">

    <div class="test w-100">
        @include('admin.errors')
        @include('admin.success')
    </div>


    <form method="POST" class="mt-5 w-75 m-auto" action="{{ url("PlaceUpdate/$place->id") }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="exampleInputEmail1" class="  ">place Name :</label>
            <input type="text" name="name" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->name }}">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1" class="  ">place Type :</label>
            <input type="text" name="type" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->type }}">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1" class="  ">place Evaluation :</label>
            <input type="text" name="evaluation" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->evaluation }}">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1" class="  ">place Contact :</label>
            <input type="text" name="contact" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->contact }}">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1" class="  "> Date :</label>
            <input type="text" name="data" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->data  }}">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1" class="  ">place time Visit :</label>
            <input type="text" name="timeVisit" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->timeVisit }}">
        </div>
        <div class="form-group ">
            <label for="exampleInputEmail1" class="  ">place link  :</label>
            <input type="text" name="link" class="form-control text-white mb-4" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $place->link  }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">old image</label>
            <img src="{{ asset("storage/$place->images") }}" class="w-100" alt="" srcset="">
            <input type="file" name="images" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
