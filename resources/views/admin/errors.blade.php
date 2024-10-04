@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert text-center lead  alert-danger">
 {{$error}} </div>
 
@endforeach

@endif