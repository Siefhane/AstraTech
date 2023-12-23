<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\User;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()) {
            $employee = employee::all();
            return view('employee.index',['employee'=>$employee]);
            }
            return  abort(403);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        employee::create($request_data);
        return to_route('employee.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        return view('employee.edit', ['employee'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, employee $employee)
    {
        $request_data = $request->all();
        $employee->update($request_data);
        return to_route('employee.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        $employee->delete();
        return to_route('employee.index');

    }
    public function import(){
        Excel::import(new EmployeeImport, request()->file('file'));
        return redirect()->back();
    }
    public function export(Request $request){
        if ($request->has('myCheckboxes')) {
            $checkboxValues = $request->input('myCheckboxes');
            $export = new EmployeeExport($checkboxValues);
            return Excel::download($export, 'employees.xlsx');

        }


    }


}




