@extends('Auth.layout')

@section('content')

<section class="vh-100 bg-image sh"
style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
<div class="mask d-flex align-items-center h-100 gradient-custom-3">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-5">
            <h2 class="text-uppercase text-center mb-5">Login Admin</h2>

            <form action="{{url('login')}}" method="POST">
                @csrf
                @include('admin.errors')

              <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password</label>
                <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
              </div>


              <div class="d-flex justify-content-center">
                <button type="submit"
                  class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
              </div>



            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

@endsection