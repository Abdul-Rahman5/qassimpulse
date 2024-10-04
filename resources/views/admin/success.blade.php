
@if (session()->has("success"))
<div class="alert w-100 text-center lead  alert-success">
{{session()->get('success')}}

</div>

@endif