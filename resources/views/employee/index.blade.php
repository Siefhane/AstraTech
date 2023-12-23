@extends('layouts.app')

@section('content')
<div class="container"  >
<a class="btn btn-success" href="{{route('employee.create')}}"> Add employee</a>
<form class="row" action="{{route('employee.import')}}" method="post"  enctype="multipart/form-data">

@csrf
<input type="file" class="form-control w-50" name="file">
<button style="width:20%" class="ms-5 btn btn-success"type="submit"> Import Excel</button>
</form>
<form action="{{route('employee.export')}}">
    <table class="table table-striped">
        <tr>
            <th><input id="AllCheck" type="checkbox" ></th>
            <th>ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach($employee as $employee)
        <tr>
            <td><input name="myCheckboxes[]" type="checkbox" class="row-checkbox" value="{{ $employee->id }}"></td>
            <td>{{$employee->id}}</td>
            <td>{{$employee->full_name}}</td>
            <td>{{$employee->phone_number}}</td>
            <td>{{$employee->email}}</td>
            <td class="d-flex">
                <a href="{{route('employee.edit' , $employee->id )}}" class="btn btn-primary me-3">Edit</a>
                <div>
                <form  action="{{route('employee.destroy',$employee->id)}}" method="post">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-danger" >Delete</button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
   </table>
   <button class="btn btn-success" type="submit">Export Excel</button>
</form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const AllCheck = document.getElementById('AllCheck');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    function toggleCheckboxes() {
        const isChecked = AllCheck.checked;
        rowCheckboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    }

    AllCheck.addEventListener('change', function() {
        toggleCheckboxes();
    });

    rowCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                AllCheck.checked = false;
            } else {
                const allChecked = Array.from(rowCheckboxes).every(function(cb) {
                    return cb.checked;
                });
                AllCheck.checked = allChecked;
            }
        });
    });
});

</script>
@endsection

