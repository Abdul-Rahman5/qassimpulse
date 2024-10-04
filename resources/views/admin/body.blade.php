<div class="main-panel">
    <div class="content-wrapper">



      <div class="row ">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Users</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check form-check-muted m-0">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                        </div>
                      </th>
                      <th> Client Name </th>
                      <th>Email </th>
                      <th> Phone </th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($users as $user)
                    <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td>
                          <img src="{{asset('admin/assets')}}/images/faces/user.png" alt="image" />
                          <span class="ps-2"> {{$user->name}} </span>
                        </td>
                        <td> {{$user->email}} </td>
                        <td> {{$user->phone}} </td>


                      </tr>

                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Qassimpulse</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> qassimpulse.com</span>
      </div>
    </footer>
    <!-- partial -->
  </div>