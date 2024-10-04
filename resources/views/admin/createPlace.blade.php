@extends('admin.layout')
@section('body')


<form method="post" class="w-75 mt-5 pt-5 m-auto" action="{{url('storePlace')}}" enctype="multipart/form-data">
    @csrf
   @include('admin.errors')
   @include('admin.success')
    <div class="form-group mt-5">
      <label for="exampleInputEmail1"> Name</label>
      <input type="text" name="name" class="form-control text-white rounded-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>
    <div class="form-group">
      <label for="exampleInputtype">Type </label>
      <input type="text" name="type" class="form-control text-white rounded-3" id="exampleInputtype" aria-describedby="typeHelp" placeholder="Enter type">
    </div>
    <div class="form-group">
      <label for="exampleInputdata">Data</label>
      <input type="text" name="data" class="form-control text-white rounded-3" id="exampleInputdata" aria-describedby="dataHelp" placeholder="Enter data">
    </div>
    <div class="form-group">
      <label for="exampleInputevaluation">Evaluation</label>
      <input type="text" name="evaluation" class="form-control text-white rounded-3" id="exampleInputevaluation" aria-describedby="evaluationHelp" placeholder="Enter evaluation">
    </div>
    <div class="form-group">
      <label for="exampleInputcontact">Contact</label>
      <input type="text" name="contact" class="form-control text-white rounded-3" id="exampleInputcontact" aria-describedby="contactHelp" placeholder="Enter contact">
    </div>
    <div class="form-group">
      <label for="exampleInputtimeVisit">Time Visit</label>
      <input type="text" name="timeVisit" class="form-control text-white rounded-3" id="exampleInputtimeVisit" aria-describedby="timeVisitHelp" placeholder="Enter timeVisit">
    </div>
    <div class="form-group">
      <label for="exampleInputlink">Link</label>
      <input type="link" name="link" class="form-control text-white rounded-3" id="exampleInputlink" aria-describedby="linkHelp" placeholder="Enter link">
    </div>


      <div class="form-group">
        <label for="exampleInputEmail1"> Image</label>
        <input type="file" name="images" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

    <button type="submit" class="btn btn-primary mb-5">Submit</button>
</form>


@endsection