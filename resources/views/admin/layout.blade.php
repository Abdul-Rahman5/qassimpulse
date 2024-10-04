@include('admin.head')
    <div class="container-scroller">

     @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper mt-5">
        @include('admin.navbar')
        <!-- partial -->
        {{-- @include('admin.body') --}}
        @yield('body')
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.footer')