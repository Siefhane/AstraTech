
@extends('layouts.app')

@section('content')
<div class="container">

<form method="post" action="{{route('employee.update' , $employee->id)}}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')

    <div class="form-floating mb-3">
    <input name="full_name" type="text" class="form-control" id="floatingInput" required value="{{$employee->full_name}}">
    <label for="floatingInput">name</label>
    </div>
    <div class="form-floating mb-3">
    <input name="email" type="email" class="form-control" id="floatingInput" required value="{{$employee->email}}">
    <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
    <input name="phone_number" type="text" class="form-control" id="floatingInput" required value="{{$employee->phone_number}}">
    <label for="floatingInput">Phone</label>
    </div>
    <button type="submit" class="btn btn-success mb-3">Update</button>
</form>
</div>
@endsection