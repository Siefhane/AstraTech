
@extends('layouts.app')

@section('content')
<div class="container">

<form method="post" action="{{route('employee.store')}}" enctype="multipart/form-data" >
    @csrf
    <div class="form-floating mb-3">
    <input name="full_name" type="text" class="form-control" id="floatingInput" required>
    <label for="floatingInput">name</label>
    </div>
    <div class="form-floating mb-3">
    <input name="email" type="email" class="form-control" id="floatingInput" required>
    <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
    <input name="phone_number" type="text" class="form-control" id="floatingInput" required>
    <label for="floatingInput">Phone</label>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Confirm</button>
</form>
</div>
@endsection