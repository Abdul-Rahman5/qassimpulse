@include('admin.head')
    <div class="container-scroller">

     @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        @include('admin.navbar')
        <!-- partial -->
        @include('admin.body')
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.footer')